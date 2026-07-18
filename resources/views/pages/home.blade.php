@extends('layouts.app')
@section('title', 'Home')
@section('content')

{{-- ═══ HERO — Canvas Network + Glass Cards ═══ --}}
<section class="hero">
    <canvas id="networkCanvas"></canvas>

    <div class="max-w-7xl mx-auto px-5 lg:px-8 w-full flex flex-col lg:flex-row items-center gap-12 lg:gap-0">
               {{-- LEFT: Content --}}
        <div class="hero-content max-w-2xl flex-1">
            <div class="hero-badge fade-up">
                <span class="hero-badge-dot"></span>
                Smart Scholarship Hub
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-[3.4rem] leading-[1.12] mt-7 mb-6 fade-up fade-up-delay-1" style="color:#ffffff">
                Find Your Perfect<br>
                <span class="gradient-text" id="heroText">Academic Opportunity</span><span class="type-cursor"></span>
            </h1>
            <p class="text-lg leading-relaxed mb-10 max-w-xl fade-up fade-up-delay-2" style="color:rgba(191,219,254,0.7)">
                Scholarships, research grants, internships, fellowships — intelligently matched to your academic profile. Never miss a deadline again.
            </p>
            <div class="flex flex-wrap gap-4 fade-up fade-up-delay-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg"><i class="fas fa-rocket"></i> Get Started Free</a>
                <a href="{{ route('opportunities.index') }}" class="btn btn-glass btn-lg"><i class="fas fa-search"></i> Browse All</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 sm:gap-10 mt-16 pt-10 border-t border-white/10 fade-up fade-up-delay-4">
                <div><p class="stat-number" data-count="2500">0</p><p class="text-xs mt-2 font-semibold uppercase tracking-wider" style="color:rgba(147,197,253,0.5)">Opportunities</p></div>
                <div><p class="stat-number" data-count="50">0</p><p class="text-xs mt-2 font-semibold uppercase tracking-wider" style="color:rgba(147,197,253,0.5)">Countries</p></div>
                <div><p class="stat-number" data-count="10000">0</p><p class="text-xs mt-2 font-semibold uppercase tracking-wider" style="color:rgba(147,197,253,0.5)">Students</p></div>
                <div><p class="stat-number" data-count="95">0</p><p class="text-xs mt-2 font-semibold uppercase tracking-wider" style="color:rgba(147,197,253,0.5)">Success Rate %</p></div>
            </div>
        </div>

        {{-- RIGHT: Floating Glass Cards --}}
        <div class="hero-cards hidden lg:flex flex-col gap-5 flex-1 justify-center items-end pr-8" style="min-height:420px">
            <div class="glass-card w-[340px]" style="animation:floatCard 16s ease-in-out infinite">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-2xl">🇩🇪</span>
                    <div><p class="text-sm font-semibold text-white/90">DAAD Scholarship</p><p class="text-xs text-blue-300/50">Germany • Fully Funded</p></div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs bg-emerald-400/15 text-emerald-300 px-3 py-1 rounded-full font-medium">Open</span>
                    <span class="text-xs text-blue-300/40">Deadline: Mar 2026</span>
                </div>
            </div>
            <div class="glass-card w-[280px] ml-16" style="animation:floatCard 20s ease-in-out infinite;animation-delay:-5s">
                <p class="text-xs text-blue-300/40 mb-1">Funding Amount</p>
                <p class="text-2xl font-bold text-white font-display">$5,000<span class="text-sm text-blue-300/40 font-sans font-normal">/year</span></p>
            </div>
            <div class="glass-card w-[300px] -ml-4" style="animation:floatCard 18s ease-in-out infinite;animation-delay:-10s">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-400/15 flex items-center justify-center"><i class="fas fa-check text-emerald-300 text-sm"></i></div>
                    <div><p class="text-xs text-blue-300/40">Application Status</p><p class="text-sm font-semibold text-emerald-300">Accepted!</p></div>
                </div>
            </div>
            <div class="glass-card w-[260px] ml-20" style="animation:floatCard 22s ease-in-out infinite;animation-delay:-3s">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-400/15 flex items-center justify-center"><i class="fas fa-graduation-cap text-blue-300 text-sm"></i></div>
                    <div><p class="text-xs text-blue-300/40">New Match</p><p class="text-sm font-semibold text-blue-200">AI Research Grant</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ CATEGORIES ═══ --}}
<section class="py-24 bg-white relative overflow-hidden">
    <div class="section-deco bg-blue-50" style="top:-60px;right:-40px;width:200px;height:200px"></div>
    <div class="section-deco bg-blue-50" style="bottom:-40px;left:-30px;width:150px;height:150px"></div>
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">Explore</span>
            <h2 class="section-title mt-2">Opportunity Categories</h2>
            <p class="text-gray-400 mt-3 max-w-lg mx-auto text-[15px]">Discover opportunities tailored to your academic journey and career goals</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $cats=[['icon'=>'fa-graduation-cap','title'=>'Scholarships','desc'=>'Fully funded, partial, and merit-based scholarships from top universities worldwide','route'=>'scholarships.index','bg'=>'bg-blue-50','ic'=>'text-blue-600','badge'=>'Most Popular','bc'=>'badge-blue'],['icon'=>'fa-flask','title'=>'Research Grants','desc'=>'Funding for undergraduate, masters, and PhD research projects across all fields','route'=>'research-grants.index','bg'=>'bg-emerald-50','ic'=>'text-emerald-600','badge'=>'Funded','bc'=>'badge-green'],['icon'=>'fa-building','title'=>'Internships','desc'=>'Industry internships at Google, Microsoft, and leading companies globally','route'=>'internships.index','bg'=>'bg-violet-50','ic'=>'text-violet-600','badge'=>'Paid & Unpaid','bc'=>'badge-violet'],['icon'=>'fa-award','title'=>'Fellowships','desc'=>'Prestigious fellowships — DAAD, Erasmus, Fulbright, and more','route'=>'fellowships.index','bg'=>'bg-amber-50','ic'=>'text-amber-600','badge'=>'Prestigious','bc'=>'badge-amber'],['icon'=>'fa-trophy','title'=>'Competitions','desc'=>'Hackathons, olympiads, debates, and academic competitions with prizes','route'=>'competitions.index','bg'=>'bg-rose-50','ic'=>'text-rose-600','badge'=>'Exciting','bc'=>'badge-rose'],['icon'=>'fa-globe','title'=>'All Opportunities','desc'=>'Browse the complete database filtered by country, degree, and funding type','route'=>'opportunities.index','bg'=>'bg-cyan-50','ic'=>'text-cyan-600','badge'=>'View All','bc'=>'badge-cyan']]; @endphp
            @foreach($cats as $i => $c)
                <a href="{{ route($c['route']) }}" class="cat-card fade-up fade-up-delay-{{ $i<6?$i+1:6 }}">
                    <div class="flex items-center justify-between mb-5">
                        <div class="cat-icon {{ $c['bg'] }}"><div class="cat-icon-ring"></div><i class="fas {{ $c['icon'] }} {{ $c['ic'] }}"></i></div>
                        <span class="badge {{ $c['bc'] }}">{{ $c['badge'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $c['title'] }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-5">{{ $c['desc'] }}</p>
                    <div class="flex items-center gap-2 text-sm font-semibold text-blue-600">Explore <i class="fas fa-arrow-right text-xs"></i></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ HOW IT WORKS ═══ --}}
<section class="py-24 bg-[var(--blue-25)] relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-16 fade-up"><span class="section-label">Process</span><h2 class="section-title mt-2">How It Works</h2><p class="text-gray-400 mt-3 max-w-lg mx-auto text-[15px]">Three simple steps to find and apply to your dream opportunity</p></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-6 relative">
            <div class="hidden md:block step-connector"><div class="step-connector-inner"></div></div>
            <div class="hidden md:block step-connector" style="left:calc(50% + 36px)"><div class="step-connector-inner"></div></div>
            <div class="text-center fade-up fade-up-delay-1"><div class="step-number">1</div><h3 class="text-lg font-bold text-gray-900 mb-2">Create Profile</h3><p class="text-sm text-gray-400 leading-relaxed">Fill in your academic details — university, CGPA, skills, and research interests</p></div>
            <div class="text-center fade-up fade-up-delay-2"><div class="step-number">2</div><h3 class="text-lg font-bold text-gray-900 mb-2">Get Matches</h3><p class="text-sm text-gray-400 leading-relaxed">Our system recommends scholarships and opportunities perfectly suited to your profile</p></div>
            <div class="text-center fade-up fade-up-delay-3"><div class="step-number">3</div><h3 class="text-lg font-bold text-gray-900 mb-2">Apply & Track</h3><p class="text-sm text-gray-400 leading-relaxed">Apply with one click and track your application status in real-time</p></div>
        </div>
    </div>
</section>

{{-- ═══ FEATURES ═══ --}}
<section class="py-24 bg-white relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-16 fade-up"><span class="section-label">Features</span><h2 class="section-title mt-2">Why Students Love Us</h2></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php $feats=[['icon'=>'fa-brain','c'=>'text-blue-600','b'=>'bg-blue-50','t'=>'Smart Matching','d'=>'AI-powered recommendations based on your unique academic profile'],['icon'=>'fa-bell','c'=>'text-amber-600','b'=>'bg-amber-50','t'=>'Deadline Alerts','d'=>'Never miss an application deadline with smart notifications'],['icon'=>'fa-shield-halved','c'=>'text-emerald-600','b'=>'bg-emerald-50','t'=>'Eligibility Check','d'=>'Auto-verify if you meet all requirements before applying'],['icon'=>'fa-chart-line','c'=>'text-violet-600','b'=>'bg-violet-50','t'=>'Track Progress','d'=>'Monitor every application from submission to final decision']]; @endphp
            @foreach($feats as $i => $f)
                <div class="feat-card fade-up fade-up-delay-{{ $i+1 }}">
                    <div class="feat-icon {{ $f['b'] }}"><i class="fas {{ $f['icon'] }} {{ $f['c'] }} text-lg"></i></div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $f['t'] }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">{{ $f['d'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ TRUSTED BY ═══ --}}
<section class="py-20 bg-[var(--blue-25)] relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-12 fade-up"><span class="section-label">Trusted By</span><h2 class="section-title mt-2">Students From Top Universities</h2></div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5 fade-up fade-up-delay-1">
            @php $unis=[['n'=>'BUET','i'=>'fa-landmark'],['n'=>'DU','i'=>'fa-university'],['n'=>'NU','i'=>'fa-building-columns'],['n'=>'KUET','i'=>'fa-flask'],['n'=>'CUET','i'=>'fa-microchip'],['n'=>'RUET','i'=>'fa-gears']]; @endphp
            @foreach($unis as $u)
                <div class="bg-white rounded-2xl p-6 border border-blue-50 flex flex-col items-center gap-3 hover:shadow-lg hover:shadow-blue-100/50 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center"><i class="fas {{ $u['i'] }} text-blue-400"></i></div>
                    <span class="text-sm font-bold text-gray-700">{{ $u['n'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="cta-section py-24 relative overflow-hidden">
    <canvas id="ctaCanvas" class="absolute inset-0 w-full h-full" style="opacity:.12;pointer-events:none"></canvas>
    <div class="relative max-w-3xl mx-auto px-5 lg:px-8 text-center fade-up">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-blue-300 text-xs font-semibold uppercase tracking-wider mb-6"><i class="fas fa-graduation-cap"></i> Join 10,000+ Students</div>
        <h2 class="text-3xl sm:text-4xl font-display text-white mt-2 mb-5 leading-tight">Ready to Find Your<br><span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-300 bg-clip-text text-transparent">Dream Opportunity?</span></h2>
        <p class="text-slate-400 mb-10 max-w-lg mx-auto">Join thousands of students discovering and applying to scholarships, research grants, and internships through OpportunityX.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="btn btn-white btn-lg"><i class="fas fa-user-plus text-blue-500"></i> Create Free Account</a>
            <a href="{{ route('about') }}" class="btn btn-glass btn-lg">Learn More <i class="fas fa-arrow-right text-xs"></i></a>
        </div>
        <div class="flex flex-wrap justify-center gap-8 mt-14 pt-8 border-t border-white/8">
            <div class="flex items-center gap-2.5 text-sm text-slate-400"><i class="fas fa-check-circle text-emerald-400"></i> 100% Free</div>
            <div class="flex items-center gap-2.5 text-sm text-slate-400"><i class="fas fa-check-circle text-emerald-400"></i> No Spam</div>
            <div class="flex items-center gap-2.5 text-sm text-slate-400"><i class="fas fa-check-circle text-emerald-400"></i> Instant Access</div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// ═══ CANVAS NETWORK ANIMATION ═══
function initNetwork(canvasId,particleColor,lineColor,maxDist,particleCount){
    const c=document.getElementById(canvasId);if(!c)return;
    const ctx=c.getContext('2d');let ps=[];let mouse={x:null,y:null,r:150};
    function resize(){c.width=c.parentElement.offsetWidth;c.height=c.parentElement.offsetHeight}
    class P{constructor(){this.x=Math.random()*c.width;this.y=Math.random()*c.height;this.vx=(Math.random()-.5)*.4;this.vy=(Math.random()-.5)*.4;this.r=Math.random()*2+.8}
    update(){this.x+=this.vx;this.y+=this.vy;if(this.x<0||this.x>c.width)this.vx*=-1;if(this.y<0||this.y>c.height)this.vy*=-1;
    if(mouse.x){let dx=mouse.x-this.x,dy=mouse.y-this.y,d=Math.sqrt(dx*dx+dy*dy);if(d<mouse.r){let f=(mouse.r-d)/mouse.r;this.x-=dx*f*.015;this.y-=dy*f*.015}}}
    draw(){ctx.beginPath();ctx.arc(this.x,this.y,this.r,0,Math.PI*2);ctx.fillStyle=particleColor;ctx.fill()}}
    function init(){ps=[];let n=Math.min(particleCount,Math.floor(c.width*c.height/10000));for(let i=0;i<n;i++)ps.push(new P)}
    function connect(){for(let a=0;a<ps.length;a++)for(let b=a+1;b<ps.length;b++){let dx=ps[a].x-ps[b].x,dy=ps[a].y-ps[b].y,d=Math.sqrt(dx*dx+dy*dy);if(d<maxDist){ctx.beginPath();ctx.strokeStyle=lineColor.replace('OPACITY',(0.18*(1-d/maxDist)).toFixed(3));ctx.lineWidth=.8;ctx.moveTo(ps[a].x,ps[a].y);ctx.lineTo(ps[b].x,ps[b].y);ctx.stroke()}}}
    function animate(){ctx.clearRect(0,0,c.width,c.height);ps.forEach(p=>{p.update();p.draw()});connect();requestAnimationFrame(animate)}
    c.addEventListener('mousemove',e=>{let r=c.getBoundingClientRect();mouse.x=e.clientX-r.left;mouse.y=e.clientY-r.top});
    c.addEventListener('mouseleave',()=>{mouse.x=null;mouse.y=null});
    window.addEventListener('resize',()=>{resize();init()});resize();init();animate();
}
// Hero network — light particles on dark bg
initNetwork('networkCanvas','rgba(147,197,253,0.5)','rgba(147,197,253,OPACITY)',140,80);
// CTA network — subtle
initNetwork('ctaCanvas','rgba(147,197,253,0.6)','rgba(147,197,253,OPACITY)',120,50);

// ═══ DYNAMIC TEXT TYPING ═══
const words=['Academic Opportunity','Research Grant','Scholarship','Internship','Fellowship'];
let wi=0;const ht=document.getElementById('heroText');
function typeW(w,i){if(i<=w.length){ht.textContent=w.substring(0,i);setTimeout(()=>typeW(w,i+1),55)}else setTimeout(eraseW,2200)}
function eraseW(){const c=ht.textContent;if(c.length>0){ht.textContent=c.substring(0,c.length-1);setTimeout(eraseW,25)}else{wi=(wi+1)%words.length;setTimeout(()=>typeW(words[wi],0),350)}}
setTimeout(()=>typeW(words[0],0),1200);

// ═══ COUNTER ANIMATION ═══
function animateCounters(){document.querySelectorAll('.stat-number[data-count]').forEach(el=>{const t=parseInt(el.dataset.count),dur=2200,s=performance.now();
function u(now){const p=Math.min((now-s)/dur,1),e=1-Math.pow(1-p,3),v=Math.round(e*t);
if(t>=10000)el.textContent=(v/1000).toFixed(v>=t?0:1)+'K+';else if(t===95)el.textContent=v+'%';else el.textContent=v.toLocaleString()+'+';if(p<1)requestAnimationFrame(u)}requestAnimationFrame(u)})}
const sO=new IntersectionObserver(e=>{e.forEach(en=>{if(en.isIntersecting){animateCounters();sO.disconnect()}})},{threshold:.5});
const sE=document.querySelector('.stat-number');if(sE)sO.observe(sE.closest('.grid'));
</script>
@endpush