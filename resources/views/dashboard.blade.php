@extends('layouts.dashboard')

@section('title', 'Umumiy panel')
@section('header_title', 'Xush kelibsiz, ' . (auth()->user()->name ?? 'Foydalanuvchi'))

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Mening kurslarim</h3>
            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9 5m9-5l9 5"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Tugallangan darslar</h3>
            <div class="p-2 bg-emerald-500/10 rounded-lg text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Sertifikatlar</h3>
            <div class="p-2 bg-purple-500/10 rounded-lg text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Umumiy ballar</h3>
            <div class="p-2 bg-amber-500/10 rounded-lg text-amber-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

</div>

<div class="bg-slate-800/50 border border-white/5 rounded-2xl p-12 text-center backdrop-blur-sm flex flex-col items-center justify-center">

    <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
    </div>

    <h2 class="text-xl font-semibold text-white mb-2">Hali hech qanday kursni boshlamadingiz</h2>
    <p class="text-slate-400 max-w-md mx-auto mb-6">Platformamizdagi qiziqarli kurslarni kashf eting, yangi bilimlarni o'zlashtiring va ta'lim olishni bugunoq boshlang.</p>

    <a href="#" class="inline-flex justify-center items-center bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-blue-500/30">
        Kurslarni ko'rish
    </a>
</div>
@endsection