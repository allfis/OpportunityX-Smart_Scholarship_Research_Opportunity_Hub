{{-- Notification dropdown — shows latest notifications for logged-in user --}}
<div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden">
    <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
        <h4 class="text-sm font-bold text-gray-800">Notifications</h4>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <form method="POST" action="{{ route('notifications.mark-read') }}">
                @csrf
                <button type="submit" class="text-xs text-[var(--blue-600)] hover:underline font-medium">
                    Mark all read
                </button>
            </form>
        @endif
    </div>

    <div class="max-h-72 overflow-y-auto">
        @if(auth()->user()->notifications->count() > 0)
            @foreach(auth()->user()->notifications->take(5) as $notification)
                <div class="px-4 py-3 border-b border-gray-50 hover:bg-blue-50/50 transition-colors {{ $notification->read_at ? '' : 'bg-blue-50/30' }}">
                    <p class="text-sm text-gray-700">{{ $notification->data['message'] ?? 'New notification' }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @else
            <div class="px-4 py-8 text-center">
                <i class="fas fa-bell-slash text-2xl text-gray-300 mb-2"></i>
                <p class="text-sm text-gray-400">No notifications yet</p>
            </div>
        @endif
    </div>
</div>