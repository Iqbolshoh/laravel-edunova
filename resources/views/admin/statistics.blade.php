@extends('layouts.dashboard')

@section('title', 'Statistika')
@section('header_title', 'Platforma statistikasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <h3 class="text-lg font-semibold text-white mb-6">O'quvchilar faoliyati</h3>
        <div class="h-64 flex items-center justify-center border-2 border-dashed border-slate-700 rounded-xl text-slate-500">
            Chart (Grafik) joyi
        </div>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <h3 class="text-lg font-semibold text-white mb-6">Kurslar ommabopligi</h3>
        <div class="h-64 flex items-center justify-center border-2 border-dashed border-slate-700 rounded-xl text-slate-500">
            Chart (Grafik) joyi
        </div>
    </div>
</div>
@endsection