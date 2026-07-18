@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<section class="py-24 bg-white relative overflow-hidden">
    <div class="section-deco bg-blue-50" style="top:-40px;right:-30px;width:180px;height:180px"></div>
    <i class="fas fa-graduation-cap absolute top-16 left-16 text-blue-100 text-5xl opacity-20 hidden lg:block"></i>
    <i class="fas fa-university absolute bottom-20 right-20 text-blue-100 text-4xl opacity-20 hidden lg:block"></i>

    <div class="relative max-w-4xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-14 fade-up">
            <span class="section-label">About</span>
            <h1 class="section-title mt-2">About OpportunityX</h1>
            <p class="text-gray-400 mt-4 max-w-xl mx-auto text-[15px]">An intelligent platform bridging the gap between students and global academic opportunities</p>
        </div>

        <div class="bg-[var(--blue-25)] rounded-2xl p-8 sm:p-10 border border-blue-50 mb-12 fade-up fade-up-delay-1">
            <p class="text-gray-600 text-[15px] leading-relaxed mb-4">OpportunityX is a smart scholarship and research opportunity hub designed to connect students with the right academic opportunities at the right time. We believe every deserving student should have access to global opportunities regardless of their background.</p>
            <p class="text-gray-600 text-[15px] leading-relaxed">Our platform uses intelligent recommendation algorithms to match students with scholarships, research grants, internships, fellowships, and competitions based on their academic profile, skills, and interests.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 fade-up fade-up-delay-2">
            <div class="feat-card">
                <div class="feat-icon bg-blue-50"><i class="fas fa-brain text-blue-600 text-lg"></i></div>
                <h3 class="font-bold text-gray-900 mb-2">Smart Recommendations</h3>
                <p class="text-sm text-gray-400 leading-relaxed">Personalized matching based on your academic profile, skills, and research interests</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon bg-amber-50"><i class="fas fa-bell text-amber-600 text-lg"></i></div>
                <h3 class="font-bold text-gray-900 mb-2">Deadline Alerts</h3>
                <p class="text-sm text-gray-400 leading-relaxed">Automatic notifications before deadlines so you never miss an opportunity</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon bg-emerald-50"><i class="fas fa-shield-halved text-emerald-600 text-lg"></i></div>
                <h3 class="font-bold text-gray-900 mb-2">Eligibility Checker</h3>
                <p class="text-sm text-gray-400 leading-relaxed">Automatically verify if you meet the requirements before you apply</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon bg-violet-50"><i class="fas fa-chart-line text-violet-600 text-lg"></i></div>
                <h3 class="font-bold text-gray-900 mb-2">Application Tracking</h3>
                <p class="text-sm text-gray-400 leading-relaxed">Track every application from submission to final decision in real-time</p>
            </div>
        </div>
    </div>
</section>
@endsection