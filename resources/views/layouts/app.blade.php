<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OpportunityX') — Smart Scholarship & Research Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy-950:#060e1a;--navy-900:#0b1a2e;--navy-800:#112240;--navy-700:#1a3358;
            --navy-600:#234578;--blue-700:#1d4ed8;--blue-600:#2563eb;--blue-500:#3b82f6;
            --blue-400:#60a5fa;--blue-300:#93c5fd;--blue-200:#bfdbfe;--blue-100:#dbeafe;
            --blue-50:#eff6ff;--blue-25:#f5f9ff;--cyan-400:#22d3ee;--cyan-300:#67e8f9;
            --emerald-500:#10b981;--amber-500:#f59e0b;--rose-500:#f43f5e;--violet-500:#8b5cf6;
            --white:#ffffff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;
            --gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;
            --gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;
        }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',system-ui,sans-serif;color:var(--gray-800);background:var(--white);line-height:1.7;-webkit-font-smoothing:antialiased;overflow-x:hidden}
        h1,h2,h3,.font-display{font-family:'Playfair Display',Georgia,serif;font-weight:700}
        ::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:var(--gray-100)}::-webkit-scrollbar-thumb{background:var(--blue-300);border-radius:10px}

        /* NAVBAR */
        .navbar{position:fixed;top:0;left:0;right:0;z-index:1000;transition:all .4s cubic-bezier(.4,0,.2,1)}
        .navbar.at-top{background:transparent}
        .navbar.scrolled{background:rgba(255,255,255,.96);backdrop-filter:blur(20px) saturate(180%);border-bottom:1px solid var(--blue-100);box-shadow:0 1px 24px rgba(11,26,46,.06)}
        .nav-link{font-size:.8125rem;font-weight:500;transition:all .2s;position:relative;text-decoration:none;letter-spacing:.01em}
        .navbar.at-top .nav-link{color:rgba(255,255,255,.75)}
        .navbar.at-top .nav-link:hover{color:#fff}
        .navbar.scrolled .nav-link{color:var(--navy-800)}
        .navbar.scrolled .nav-link:hover{color:var(--blue-600)}
        .nav-link::after{content:'';position:absolute;bottom:-2px;left:50%;width:0;height:2px;background:linear-gradient(90deg,var(--blue-400),var(--cyan-400));transition:all .3s;transform:translateX(-50%);border-radius:2px}
        .nav-link:hover::after{width:70%}
        .navbar.at-top .nav-logo{color:#fff!important}
        .navbar.scrolled .nav-logo{color:var(--navy-900)!important}
        .nav-logo{font-family:'Playfair Display',serif;font-size:1.3rem;text-decoration:none;display:flex;align-items:center;gap:10px;font-weight:700}
        .nav-logo span{color:var(--cyan-400)}

        /* BUTTONS + RIPPLE */
        .btn{position:relative;display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:12px;font-weight:600;font-size:.8125rem;transition:all .3s cubic-bezier(.4,0,.2,1);cursor:pointer;border:none;text-decoration:none;letter-spacing:.01em;font-family:'Inter',sans-serif;overflow:hidden}
        .btn .ripple{position:absolute;border-radius:50%;background:rgba(255,255,255,.35);transform:scale(0);animation:ripple-anim .6s ease-out;pointer-events:none}
        @keyframes ripple-anim{to{transform:scale(4);opacity:0}}
        .btn-primary{background:linear-gradient(135deg,var(--blue-600),var(--blue-500));color:#fff;box-shadow:0 4px 20px rgba(37,99,235,.3)}
        .btn-primary:hover{transform:translateY(-3px);box-shadow:0 14px 40px rgba(37,99,235,.35)}
        .btn-primary:active{transform:translateY(-1px)}
        .btn-white{background:#fff;color:var(--navy-800);box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .btn-white:hover{transform:translateY(-3px);box-shadow:0 14px 40px rgba(0,0,0,.12)}
        .btn-white:active{transform:translateY(-1px)}
        .btn-outline{background:transparent;color:var(--blue-600);border:2px solid var(--blue-200)}
        .btn-outline:hover{background:var(--blue-50);border-color:var(--blue-400);transform:translateY(-2px)}
        .btn-glass{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.2);backdrop-filter:blur(8px)}
        .btn-glass:hover{background:rgba(255,255,255,.18);border-color:rgba(255,255,255,.35);transform:translateY(-2px)}
        .btn-sm{padding:8px 18px;font-size:.75rem;border-radius:9px}
        .btn-lg{padding:16px 36px;font-size:.9375rem;border-radius:14px}

        /* HERO */
        .hero{position:relative;min-height:100vh;display:flex;align-items:center;background:linear-gradient(160deg,var(--navy-950) 0%,var(--navy-900) 30%,var(--navy-800) 60%,var(--navy-700) 100%);overflow:hidden}
        #networkCanvas{position:absolute;inset:0;z-index:1}
        .hero-content{position:relative;z-index:2}
        .hero-cards{position:relative;z-index:2}

        /* Glass cards on hero right */
        .glass-card{background:rgba(255,255,255,.06);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:20px 24px;color:#fff}

        /* Gradient text */
        .gradient-text{background:linear-gradient(135deg,var(--blue-300),var(--cyan-400),var(--blue-200),var(--cyan-300));background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:gradientShift 5s ease infinite}
        @keyframes gradientShift{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}

        /* Typing cursor */
        .type-cursor{display:inline-block;width:3px;height:.8em;background:var(--cyan-400);margin-left:4px;animation:blink .7s step-end infinite;vertical-align:text-bottom;border-radius:2px}
        @keyframes blink{0%,100%{opacity:1}50%{opacity:0}}

        .hero-badge{display:inline-flex;align-items:center;gap:8px;padding:7px 18px 7px 10px;border-radius:100px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:var(--blue-300);font-size:.8125rem;font-weight:500;backdrop-filter:blur(10px)}
        .hero-badge-dot{width:8px;height:8px;border-radius:50%;background:var(--emerald-500);animation:pulseDot 2s ease-in-out infinite}
        @keyframes pulseDot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.75)}}

        .stat-number{font-family:'Playfair Display',serif;font-size:2.75rem;line-height:1;color:#fff}

        /* Float animation for glass cards */
        @keyframes floatCard{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}

        /* SECTIONS */
        .section-label{display:inline-flex;align-items:center;gap:8px;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:var(--blue-600);margin-bottom:10px}
        .section-label::before{content:'';width:24px;height:2px;background:linear-gradient(90deg,var(--blue-600),var(--blue-400));border-radius:2px}
        .section-title{font-size:2.5rem;color:var(--navy-900);line-height:1.15;letter-spacing:-.01em}
        .section-deco{position:absolute;border-radius:50%;pointer-events:none;opacity:.35}

        /* CATEGORY CARDS */
        .cat-card{position:relative;background:#fff;border:1.5px solid var(--blue-50);border-radius:20px;padding:32px 28px;transition:all .4s cubic-bezier(.4,0,.2,1);overflow:hidden;cursor:pointer;text-decoration:none;display:block}
        .cat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--blue-500),var(--cyan-400));transform:scaleX(0);transform-origin:left;transition:transform .4s ease}
        .cat-card::after{content:'';position:absolute;top:-50%;right:-50%;width:100%;height:100%;background:radial-gradient(circle,rgba(37,99,235,.04) 0%,transparent 70%);opacity:0;transition:opacity .4s}
        .cat-card:hover::before{transform:scaleX(1)}.cat-card:hover::after{opacity:1}
        .cat-card:hover{transform:translateY(-8px);box-shadow:0 24px 64px rgba(11,26,46,.08);border-color:var(--blue-100)}
        .cat-icon{width:60px;height:60px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:20px;transition:all .4s cubic-bezier(.4,0,.2,1);position:relative}
        .cat-card:hover .cat-icon{transform:scale(1.1) rotate(-5deg);box-shadow:0 8px 24px rgba(0,0,0,.06)}
        .cat-icon-ring{position:absolute;inset:-4px;border-radius:22px;border:2px dashed var(--blue-200);opacity:0;transition:opacity .3s}
        .cat-card:hover .cat-icon-ring{opacity:1}

        /* STEPS */
        .step-number{width:72px;height:72px;border-radius:22px;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-size:1.6rem;color:#fff;background:linear-gradient(135deg,var(--blue-600),var(--blue-400));margin:0 auto 20px;box-shadow:0 10px 30px rgba(37,99,235,.25);position:relative}
        .step-number::after{content:'';position:absolute;inset:-6px;border-radius:28px;border:2px dashed var(--blue-200);opacity:.5}
        .step-connector{position:absolute;top:36px;left:calc(50% + 44px);width:calc(100% - 88px);height:2px}
        .step-connector-inner{width:100%;height:100%;background:repeating-linear-gradient(90deg,var(--blue-200) 0,var(--blue-200) 8px,transparent 8px,transparent 16px);animation:dashMove 20s linear infinite}
        @keyframes dashMove{to{background-position:32px 0}}

        /* FEATURE CARDS */
        .feat-card{background:#fff;border:1.5px solid var(--blue-50);border-radius:20px;padding:32px;transition:all .35s ease;position:relative;overflow:hidden}
        .feat-card::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--blue-500),var(--cyan-400));transform:scaleX(0);transition:transform .35s;transform-origin:left}
        .feat-card:hover::before{transform:scaleX(1)}
        .feat-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(11,26,46,.06);border-color:var(--blue-100)}
        .feat-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;margin-bottom:18px;transition:transform .3s}
        .feat-card:hover .feat-icon{transform:scale(1.1) rotate(-3deg)}

        /* CTA */
        .cta-section{position:relative;background:linear-gradient(135deg,var(--navy-900) 0%,var(--navy-800) 50%,#1a3d6e 100%);overflow:hidden}

        /* BADGES */
        .badge{display:inline-flex;align-items:center;padding:3px 12px;border-radius:100px;font-size:.6875rem;font-weight:600;letter-spacing:.03em}
        .badge-blue{background:var(--blue-50);color:var(--blue-700);border:1px solid var(--blue-100)}
        .badge-green{background:#ecfdf5;color:#059669;border:1px solid #a7f3d0}
        .badge-amber{background:#fffbeb;color:#d97706;border:1px solid #fde68a}
        .badge-rose{background:#fff1f2;color:#e11d48;border:1px solid #fecdd3}
        .badge-violet{background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe}
        .badge-cyan{background:#ecfeff;color:#0891b2;border:1px solid #a5f3fc}

        /* FLASH */
        .flash-msg{position:fixed;top:80px;right:20px;z-index:9999;padding:14px 22px;border-radius:14px;font-size:.8125rem;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 12px 40px rgba(0,0,0,.15);animation:slideIn .5s cubic-bezier(.16,1,.3,1);max-width:380px}
        .flash-success{background:rgba(16,185,129,.95);color:#fff}
        .flash-error{background:rgba(244,63,94,.95);color:#fff}
        .flash-warning{background:rgba(245,158,11,.95);color:#fff}
        @keyframes slideIn{from{transform:translateX(120%);opacity:0}to{transform:translateX(0);opacity:1}}

        /* FORM */
        .form-input{width:100%;padding:12px 16px;border:1.5px solid var(--blue-100);border-radius:12px;font-size:.875rem;font-family:'Inter',sans-serif;transition:all .25s;background:#fff;color:var(--gray-800)}
        .form-input:focus{outline:none;border-color:var(--blue-400);box-shadow:0 0 0 4px rgba(59,130,246,.08);background:var(--blue-25)}
        .form-label{display:block;font-weight:600;font-size:.8125rem;color:var(--gray-700);margin-bottom:6px}

        /* DROPDOWNS */
        .dropdown{position:absolute;right:0;margin-top:10px;background:#fff;border:1.5px solid var(--blue-50);border-radius:16px;box-shadow:0 20px 60px rgba(11,26,46,.12);overflow:hidden;z-index:100;min-width:230px}
        .dropdown-item{display:flex;align-items:center;gap:10px;padding:11px 18px;font-size:.8125rem;color:var(--gray-600);transition:all .15s;cursor:pointer;text-decoration:none}
        .dropdown-item:hover{background:var(--blue-50);color:var(--blue-600)}

        .avatar-sm{width:36px;height:36px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;background:linear-gradient(135deg,var(--blue-500),var(--blue-400))}
        .notif-dot{position:absolute;top:5px;right:5px;width:7px;height:7px;background:var(--rose-500);border-radius:50%;border:2px solid #fff}

        /* OPPORTUNITY CARDS (listing page) */
        .opp-card{background:#fff;border:1.5px solid var(--blue-50);border-radius:18px;overflow:hidden;transition:all .35s ease}
        .opp-card:hover{transform:translateY(-5px);box-shadow:0 20px 50px rgba(11,26,46,.07);border-color:var(--blue-100)}
        .opp-card-type{height:4px}
        .filter-btn{padding:8px 18px;border-radius:100px;font-size:.8125rem;font-weight:500;border:1.5px solid var(--blue-100);background:#fff;color:var(--gray-600);cursor:pointer;transition:all .2s;font-family:'Inter',sans-serif}
        .filter-btn:hover,.filter-btn.active{background:var(--blue-600);color:#fff;border-color:var(--blue-600);box-shadow:0 4px 12px rgba(37,99,235,.2)}

        /* ANIMATIONS */
        .fade-up{opacity:0;transform:translateY(30px);transition:all .7s cubic-bezier(.16,1,.3,1)}
        .fade-up.visible{opacity:1;transform:translateY(0)}
        .fade-up-delay-1{transition-delay:.1s}.fade-up-delay-2{transition-delay:.2s}.fade-up-delay-3{transition-delay:.3s}.fade-up-delay-4{transition-delay:.4s}.fade-up-delay-5{transition-delay:.5s}.fade-up-delay-6{transition-delay:.6s}

        @media(max-width:768px){
            .section-title{font-size:1.875rem}.stat-number{font-size:2rem}
            .hero{min-height:auto;padding-top:100px;padding-bottom:60px}
            .hero-cards{display:none!important}
            .step-connector{display:none}
        }
    </style>
    @stack('styles')
</head>
<body>
    @if(session('success'))
        <div class="flash-msg flash-success" id="flashMsg"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span><button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;color:#fff;cursor:pointer;opacity:.7"><i class="fas fa-times"></i></button></div>
    @endif
    @if(session('error'))
        <div class="flash-msg flash-error" id="flashMsg"><i class="fas fa-exclamation-circle"></i><span>{{ session('error') }}</span><button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;color:#fff;cursor:pointer;opacity:.7"><i class="fas fa-times"></i></button></div>
    @endif
    @if(session('warning'))
        <div class="flash-msg flash-warning" id="flashMsg"><i class="fas fa-exclamation-triangle"></i><span>{{ session('warning') }}</span><button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;color:#fff;cursor:pointer;opacity:.7"><i class="fas fa-times"></i></button></div>
    @endif

    @include('partials.header')
    <main>@yield('content')</main>
    @include('partials.footer')

    <script>
        const nav=document.getElementById('mainNav');
        function handleNav(){window.scrollY>30?(nav.classList.add('scrolled'),nav.classList.remove('at-top')):(nav.classList.remove('scrolled'),nav.classList.add('at-top'))}
        window.addEventListener('scroll',handleNav);handleNav();

        document.addEventListener('click',e=>{const b=e.target.closest('.btn');if(!b)return;const r=document.createElement('span');r.classList.add('ripple');const rect=b.getBoundingClientRect();const s=Math.max(rect.width,rect.height);r.style.width=r.style.height=s+'px';r.style.left=(e.clientX-rect.left-s/2)+'px';r.style.top=(e.clientY-rect.top-s/2)+'px';b.appendChild(r);setTimeout(()=>r.remove(),600)});

        function toggleDropdown(id){const el=document.getElementById(id);const h=el.style.display==='none'||!el.style.display;document.querySelectorAll('.dropdown').forEach(d=>d.style.display='none');if(h)el.style.display='block'}
        document.addEventListener('click',e=>{document.querySelectorAll('.dropdown').forEach(d=>{if(!d.parentElement.contains(e.target))d.style.display='none'})});

        function toggleMobile(){const m=document.getElementById('mobileMenu');const i=document.getElementById('mobileIcon');m.classList.toggle('hidden');i.className=m.classList.contains('hidden')?'fas fa-bars text-[15px]':'fas fa-times text-[15px]'}

        setTimeout(()=>{document.querySelectorAll('.flash-msg').forEach(el=>{el.style.transition='all .4s';el.style.opacity='0';el.style.transform='translateX(40px)';setTimeout(()=>el.remove(),400)})},4500);

        const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')})},{threshold:.08,rootMargin:'0px 0px -30px 0px'});
        document.querySelectorAll('.fade-up').forEach(el=>obs.observe(el));
    </script>
    @stack('scripts')
</body>
</html>