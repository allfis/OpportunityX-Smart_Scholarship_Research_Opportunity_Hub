<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Bookmark;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\University;
use App\Services\EligibilityService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponse;

    public function stats()
    {
        return $this->success([
            'total_scholarships' => Opportunity::active()->where('type_id', 1)->count(),
            'total_grants' => Opportunity::active()->where('type_id', 2)->count(),
            'total_fellowships_internships' => Opportunity::active()->whereIn('type_id', [3, 4])->count(),
            'total_students' => User::where('role', 'student')->where('is_active', 1)->count(),
            'total_applications' => Application::count(),
            'total_accepted' => Application::where('status_id', 4)->count(),
            'total_bookmarks' => Bookmark::count(),
            'total_universities' => University::where('is_active', 1)->count(),
            'today_applications' => Application::whereDate('applied_date', today())->count(),
        ]);
    }

    public function recommendations(Request $request)
    {
        $user = User::find(session('user_id'));
        if (!$user || !$user->fields_of_interest) {
            return $this->success([]);
        }

        $fields = array_map('trim', explode(',', $user->fields_of_interest));
        $appliedIds = Application::where('user_id', $user->id)->pluck('opportunity_id');

        $recs = Opportunity::active()
            ->whereHas('field', fn($q) => $q->whereIn('name', $fields))
            ->whereNotIn('id', $appliedIds)
            ->with(['type', 'field', 'country'])
            ->orderBy('deadline')
            ->limit(10)
            ->get();

        return $this->success($recs);
    }

    public function trending()
    {
        $opps = Opportunity::active()
            ->with(['type', 'field', 'country'])
            ->orderByDesc('applications_count')
            ->orderByDesc('views_count')
            ->limit(10)
            ->get();

        return $this->success($opps);
    }

    public function checkEligibility(Request $request)
    {
        $request->validate([
            'education_level' => 'required|string',
            'cgpa' => 'required|numeric|between:0,4',
            'field' => 'required|string',
            'experience' => 'nullable|integer|min:0',
        ]);

        $service = new EligibilityService();
        $result = $service->check(
            $request->education_level,
            (float) $request->cgpa,
            $request->field,
            $request->get('experience', 0)
        );

        return $this->success($result);
    }

    public function universities()
    {
        return $this->success(
            University::where('is_active', 1)->orderBy('type')->orderBy('name')->get()
        );
    }
}