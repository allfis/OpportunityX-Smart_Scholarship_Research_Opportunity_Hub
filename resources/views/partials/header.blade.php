<nav id="mainNav" class="navbar at-top">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex items-center justify-between h-[68px]">
            <a href="{{ route('home') }}" class="nav-logo">
                <div class="w-9 h-9 rounded-[10px] bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center shadow-lg shadow-blue-500/25">
                    <i class="fas fa-graduation-cap text-white text-sm"></i>
                </div>
                Opportunity<span>X</span>
            </a>
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link px-3.5 py-2 rounded-lg">Home</a>
                <a href="{{ route('opportunities.index') }}" class="nav-link px-3.5 py-2 rounded-lg">Opportunities</a>
                <a href="{{ route('scholarships.index') }}" class="nav-link px-3.5 py-2 rounded-lg">Scholarships</a>
                <a href="{{ route('about') }}" class="nav-link px-3.5 py-2 rounded-lg">About</a>
                <a href="{{ route('contact') }}" class="nav-link px-3.5 py-2 rounded-lg">Contact</a>
            </div>
            <div class="flex items-center gap-2.5">
                @auth
                    <div class="relative">
                        <button onclick="toggleDropdown('notifDrop')" class="nav-icon-btn relative p-2.5 rounded-xl transition-all" style="color:rgba(255,255,255,.7)">
                            <i class="fas fa-bell text-[15px]"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)<span class="notif-dot"></span>@endif
                        </button>
                        <div id="notifDrop" class="dropdown" style="display:none;width:320px">
                            <div class="px-4 py-3 border-b border-blue-50 flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-800">Notifications</span>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form method="POST" action="{{ route('notifications.mark-read') }}" class="inline">@csrf<button class="text-xs text-blue-600 hover:underline font-semibold">Mark all read</button></form>
                                @endif
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse(auth()->user()->notifications->take(5) as $n)
                                    <div class="px-4 py-3 border-b border-blue-25 hover:bg-blue-50/50 transition-colors {{ $n->read_at ? '' : 'bg-blue-50/30' }}">
                                        <p class="text-[13px] text-gray-700 leading-snug">{{ $n->data['message'] ?? 'New notification' }}</p>
                                        <p class="text-[11px] text-gray-400 mt-1">{{ $n->created_at->diffForHumans() }}</p>
                                    </div>
                                @empty
                                    <div class="px-4 py-8 text-center"><i class="fas fa-bell-slash text-xl text-blue-200 mb-2"></i><p class="text-xs text-gray-400">No notifications yet</p></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <button onclick="toggleDropdown('userDrop')" class="flex items-center gap-2.5 py-1.5 px-2 rounded-xl hover:bg-white/10 transition-all nav-icon-btn">
                            <div class="avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="hidden sm:block text-sm font-medium nav-text-color">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-[9px] nav-text-color opacity-50 hidden sm:block"></i>
                        </button>
                        <div id="userDrop" class="dropdown" style="display:none;width:240px">
                            <div class="px-4 py-3 border-b border-blue-50">
                                <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ auth()->user()->email }}</p>
                                <span class="badge badge-blue mt-2">{{ auth()->user()->role }}</span>
                            </div>
                            @if(auth()->user()->role === 'student')
                                <a href="{{ route('student.dashboard') }}" class="dropdown-item"><i class="fas fa-th-large w-4 text-center text-gray-400"></i> Dashboard</a>
                                <a href="{{ route('student.profile.edit') }}" class="dropdown-item"><i class="fas fa-user w-4 text-center text-gray-400"></i> My Profile</a>
                                <a href="{{ route('student.bookmarks.index') }}" class="dropdown-item"><i class="fas fa-heart w-4 text-center text-gray-400"></i> Bookmarks</a>
                                <a href="{{ route('student.applications.index') }}" class="dropdown-item"><i class="fas fa-file-alt w-4 text-center text-gray-400"></i> Applications</a>
                            @elseif(auth()->user()->role === 'faculty')
                                <a href="{{ route('faculty.dashboard') }}" class="dropdown-item"><i class="fas fa-th-large w-4 text-center text-gray-400"></i> Dashboard</a>
                                <a href="{{ route('faculty.opportunities.index') }}" class="dropdown-item"><i class="fas fa-plus-circle w-4 text-center text-gray-400"></i> My Opportunities</a>
                            @elseif(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item"><i class="fas fa-shield-halved w-4 text-center text-gray-400"></i> Admin Panel</a>
                            @endif
                            <div class="border-t border-blue-50">
                                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="dropdown-item w-full text-left text-rose-600 hover:bg-rose-50"><i class="fas fa-sign-out-alt w-4 text-center"></i> Logout</button></form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-glass btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Get Started</a>
                @endauth
                <button onclick="toggleMobile()" class="lg:hidden p-2.5 rounded-xl transition-all nav-icon-btn" style="color:rgba(255,255,255,.7)">
                    <i class="fas fa-bars text-[15px]" id="mobileIcon"></i>
                </button>
            </div>
        </div>
        <div id="mobileMenu" class="hidden lg:hidden pb-5 border-t border-white/10 mt-2 pt-4">
            <div class="flex flex-col gap-0.5">
                <a href="{{ route('home') }}" class="px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-xl transition-all">Home</a>
                <a href="{{ route('opportunities.index') }}" class="px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-xl transition-all">Opportunities</a>
                <a href="{{ route('scholarships.index') }}" class="px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-xl transition-all">Scholarships</a>
                <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-xl transition-all">About</a>
                <a href="{{ route('contact') }}" class="px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 rounded-xl transition-all">Contact</a>
            </div>
        </div>
    </div>
</nav>
<div class="h-[68px]"></div>

<script>
// Swap nav icon/text colors on scroll
function swapNavColors(){
    const s=nav.classList.contains('scrolled');
    document.querySelectorAll('.nav-icon-btn').forEach(b=>{b.style.color=s?'var(--gray-500)':'rgba(255,255,255,.7)'});
    document.querySelectorAll('.nav-text-color').forEach(t=>{t.style.color=s?'var(--gray-700)':'rgba(255,255,255,.9)'});
    const mb=document.getElementById('mobileBtn')||document.querySelector('[onclick*="toggleMobile"]');
    if(mb)mb.style.color=s?'var(--gray-500)':'rgba(255,255,255,.7)';
}
window.addEventListener('scroll',swapNavColors);swapNavColors();
</script>