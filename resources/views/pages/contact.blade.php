@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<section class="py-24 bg-[var(--blue-25)] relative overflow-hidden">
    <i class="fas fa-envelope absolute top-16 right-20 text-blue-100 text-4xl opacity-25 hidden lg:block"></i>
    <div class="relative max-w-5xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-14 fade-up">
            <span class="section-label">Contact</span>
            <h1 class="section-title mt-2">Get In Touch</h1>
            <p class="text-gray-400 mt-3 text-[15px]">Have questions? We'd love to hear from you.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3 fade-up fade-up-delay-1">
                <div class="bg-white rounded-2xl p-8 border border-blue-50 shadow-sm">
                    <form method="POST" action="#" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div><label class="form-label">Full Name</label><input type="text" name="name" class="form-input" placeholder="Your name" required></div>
                            <div><label class="form-label">Email</label><input type="email" name="email" class="form-input" placeholder="you@example.com" required></div>
                        </div>
                        <div><label class="form-label">Subject</label><input type="text" name="subject" class="form-input" placeholder="How can we help?" required></div>
                        <div><label class="form-label">Message</label><textarea name="message" rows="5" class="form-input" placeholder="Your message..." required></textarea></div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
                    </form>
                </div>
            </div>
            <div class="lg:col-span-2 space-y-5 fade-up fade-up-delay-2">
                <div class="bg-white rounded-2xl p-6 border border-blue-50 shadow-sm flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center shrink-0"><i class="fas fa-map-marker-alt text-blue-600 text-sm"></i></div>
                    <div><h4 class="text-sm font-bold text-gray-900">Address</h4><p class="text-sm text-gray-400 mt-1">Dhaka, Bangladesh</p></div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 shadow-sm flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0"><i class="fas fa-envelope text-emerald-600 text-sm"></i></div>
                    <div><h4 class="text-sm font-bold text-gray-900">Email</h4><p class="text-sm text-gray-400 mt-1">info@opportunityx.com</p></div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 shadow-sm flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0"><i class="fas fa-clock text-amber-600 text-sm"></i></div>
                    <div><h4 class="text-sm font-bold text-gray-900">Response Time</h4><p class="text-sm text-gray-400 mt-1">Within 24 hours</p></div>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-blue-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center gap-3 mb-3"><i class="fas fa-lightbulb text-yellow-300"></i><h4 class="font-bold">Quick Help</h4></div>
                    <p class="text-sm text-blue-100 leading-relaxed">Check our About page or How It Works guide for instant answers to common questions.</p>
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white mt-4 hover:gap-3 transition-all">Learn More <i class="fas fa-arrow-right text-xs"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection