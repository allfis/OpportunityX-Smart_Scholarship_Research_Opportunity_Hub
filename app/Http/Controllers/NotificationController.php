<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Traits\ApiResponse;

class NotificationController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $notifs = Notification::where('user_id', session('user_id'))
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();

        $unread = Notification::where('user_id', session('user_id'))
            ->where('is_read', false)
            ->count();

        return $this->success([
            'data' => $notifs,
            'unread' => $unread,
        ]);
    }

    public function markRead()
    {
        Notification::where('user_id', session('user_id'))
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return $this->success(null, 'All marked as read');
    }
}