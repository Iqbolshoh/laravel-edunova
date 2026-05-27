@extends('layouts.dashboard')

@section('title', 'Umumiy panel')
@section('header_title', 'Xush kelibsiz, ' . (auth()->user()->name ?? 'Foydalanuvchi'))

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Talabalar soni</h3>
            <div class="p-3 bg-blue-500/10 rounded-xl text-blue-400 flex items-center justify-center transition-all duration-300 hover:scale-105 shadow-lg shadow-blue-500/20">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-6 h-6 object-contain">
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Kurslar</h3>
            <div class="p-3 bg-emerald-500/10 rounded-xl text-emerald-400 transition-all duration-300 hover:scale-105 shadow-lg shadow-emerald-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Topshiriqlar soni</h3>
            <div class="p-3 bg-purple-500/10 rounded-xl text-purple-400 transition-all duration-300 hover:scale-105 shadow-lg shadow-purple-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-white">0</p>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-400 text-sm font-medium">Umumiy ballar</h3>
            <div class="p-3 bg-amber-500/10 rounded-xl text-amber-400 transition-all duration-300 hover:scale-105 shadow-lg shadow-amber-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <a href="{{route('courses.index')}}" class="inline-flex justify-center items-center bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-blue-500/30">
        Kurslarni ko'rish
    </a>
</div>
@endsection