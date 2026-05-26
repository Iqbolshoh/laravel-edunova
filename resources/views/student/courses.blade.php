@extends('layouts.dashboard')

@section('title', 'Mening kurslarim')
@section('header_title', 'Mening kurslarim')

@section('content')
<div class="bg-slate-800/50 border border-white/5 rounded-2xl p-12 text-center backdrop-blur-sm">
    <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path>
        </svg>
    </div>
    <h2 class="text-xl font-semibold text-white mb-2">Hozircha kurslar yo'q</h2>
    <p class="text-slate-400 mb-6">Siz hali biron-bir kursga yozilmagansiz.</p>
    <a href="#" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors">Kurs izlash</a>
</div>
@endsection