<footer class="bg-[var(--navy-900)] relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent"></div>
    <div class="absolute inset-0 opacity-[.04] pointer-events-none" style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22><circle cx=%2230%22 cy=%2230%22 r=%221.5%22 fill=%22%2360a5fa%22/><line x1=%2230%22 y1=%2230%22 x2=%2260%22 y2=%2230%22 stroke=%22%2360a5fa%22 stroke-width=%220.5%22/><line x1=%2230%22 y1=%2230%22 x2=%2230%22 y2=%220%22 stroke=%22%2360a5fa%22 stroke-width=%220.5%22/></svg>')"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-5 no-underline">
                    <div class="w-9 h-9 rounded-[10px] bg-gradient-to-br from-blue-500 to-blue-400 flex items-center justify-center"><i class="fas fa-graduation-cap text-white text-sm"></i></div>
                    <span class="font-display text-xl text-white">Opportunity<span class="text-blue-400">X</span></span>
                </a>
                <p class="text-sm text-slate-400 leading-relaxed max-w-xs">Connecting students with scholarships, research grants, internships, and academic opportunities worldwide.</p>
                <div class="flex gap-2.5 mt-6">
                    <a href="#" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-500/20 hover:border-blue-400/30 transition-all"><i class="fab fa-facebook-f text-xs"></i></a>
                    <a href="#" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-500/20 hover:border-blue-400/30 transition-all"><i class="fab fa-twitter text-xs"></i></a>
                    <a href="#" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-500/20 hover:border-blue-400/30 transition-all"><i class="fab fa-linkedin-in text-xs"></i></a>
                    <a href="#" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-500/20 hover:border-blue-400/30 transition-all"><i class="fab fa-youtube text-xs"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-5">Opportunities</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('scholarships.index') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Scholarships</a></li>
                    <li><a href="{{ route('research-grants.index') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Research Grants</a></li>
                    <li><a href="{{ route('internships.index') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Internships</a></li>
                    <li><a href="{{ route('fellowships.index') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Fellowships</a></li>
                    <li><a href="{{ route('competitions.index') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Competitions</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-5">Resources</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">About Us</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">How It Works</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Success Stories</a></li>
                    <li><a href="#" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-5">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-blue-400 mt-1 text-xs"></i><span class="text-sm text-slate-400">Dhaka, Bangladesh</span></li>
                    <li class="flex items-center gap-3"><i class="fas fa-envelope text-blue-400 text-xs"></i><span class="text-sm text-slate-400">info@opportunityx.com</span></li>
                    <li class="flex items-center gap-3"><i class="fas fa-phone text-blue-400 text-xs"></i><span class="text-sm text-slate-400">+880 1XXX-XXXXXX</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-white/5">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} OpportunityX. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="text-xs text-slate-500 hover:text-slate-300 transition-colors">Privacy Policy</a>
                <a href="#" class="text-xs text-slate-500 hover:text-slate-300 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>