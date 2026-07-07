<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $apps = Application::where('user_id', session('user_id'))
            ->with(['opportunity.type', 'status'])
            ->orderByDesc('updated_at')
            ->get();

        $grouped = [
            'applied' => [],
            'review' => [],
            'shortlist' => [],
            'accepted' => [],
            'rejected' => [],
        ];

        foreach ($apps as $app) {
            $slug = $app->status->slug;
            if (isset($grouped[$slug])) {
                $grouped[$slug][] = $app;
            }
        }

        return $this->success([
            'data' => ApplicationResource::collection($apps),
            'grouped' => $grouped,
        ]);
    }

    public function apply(Request $request)
    {
        $request->validate([
            'opportunity_id' => 'required|exists:opportunities,id',
        ]);

        $exists = Application::where('user_id', session('user_id'))
            ->where('opportunity_id', $request->opportunity_id)
            ->exists();

        if ($exists) {
            return $this->error('Already applied', 409);
        }

        Application::create([
            'user_id' => session('user_id'),
            'opportunity_id' => $request->opportunity_id,
            'status_id' => 1,
            'applied_date' => now()->toDateString(),
        ]);

        return $this->success(null, 'Application submitted');
    }

    public function moveStatus(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id,user_id,' . session('user_id'),
            'status_slug' => 'required|string',
        ]);

        $app = Application::find($request->application_id);
        $allowed = [
            'applied' => 'review',
            'review' => 'shortlist',
            'shortlist' => 'accepted',
        ];

        if (!isset($allowed[$app->status->slug]) || $allowed[$app->status->slug] !== $request->status_slug) {
            return $this->error('Invalid status transition', 400);
        }

        $newStatus = ApplicationStatus::where('slug', $request->status_slug)->first();
        $app->update(['status_id' => $newStatus->id]);

        return $this->success(null, "Status updated to {$newStatus->name}");
    }
}