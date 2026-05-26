@extends('layouts.dashboard')

@section('title', 'Vazifalar')
@section('header_title', 'Uyga vazifalar')

@section('content')
<div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-white">Topshiriqlar ro'yxati</h2>
        <span class="px-3 py-1 bg-slate-700 text-xs text-slate-300 rounded-lg">0 ta topshiriq</span>
    </div>
    <div class="text-center py-12 text-slate-500">
        Hozircha hech qanday topshiriq mavjud emas.
    </div>
</div>
@endsection