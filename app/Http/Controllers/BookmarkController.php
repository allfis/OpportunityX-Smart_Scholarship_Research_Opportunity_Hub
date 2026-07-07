<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $bookmarks = Bookmark::where('user_id', session('user_id'))
            ->with(['opportunity.type', 'opportunity.field', 'opportunity.country'])
            ->orderByDesc('created_at')
            ->get()
            ->pluck('opportunity');

        return $this->success($bookmarks);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'opportunity_id' => 'required|exists:opportunities,id',
        ]);

        $exists = Bookmark::where('user_id', session('user_id'))
            ->where('opportunity_id', $request->opportunity_id)
            ->first();

        if ($exists) {
            $exists->delete();
            return $this->success(['bookmarked' => false], 'Removed from bookmarks');
        }

        Bookmark::create([
            'user_id' => session('user_id'),
            'opportunity_id' => $request->opportunity_id,
        ]);

        return $this->success(['bookmarked' => true], 'Added to bookmarks');
    }
}