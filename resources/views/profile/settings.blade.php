@extends('layouts.dashboard')

@section('title', 'Profil')
@section('header_title', 'Profil sozlamalari')

@section('content')
<div class="max-w-2xl bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
    <form action="#" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm text-slate-400 mb-2">To'liq ism</label>
            <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-slate-900 border border-white/10 rounded-xl p-3 text-white">
        </div>
        <div>
            <label class="block text-sm text-slate-400 mb-2">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-slate-900 border border-white/10 rounded-xl p-3 text-white">
        </div>
        <button class="bg-blue-600 px-6 py-2 rounded-xl text-white font-medium">Saqlash</button>
    </form>
</div>
@endsection