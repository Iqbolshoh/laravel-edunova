@extends('layouts.dashboard')

@section('title', 'Profil')
@section('header_title', 'Profil sozlamalari')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Success Message --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mb-6 flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
    <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-start justify-between bg-rose-500/10 border border-rose-500/20 rounded-xl p-4 text-rose-400">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-sm font-medium mb-1">Xatolik yuz berdi:</p>
                <ul class="text-sm list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button @click="show = false" class="text-rose-400 hover:text-rose-300 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Profile Form Card --}}
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-white/5">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-slate-400">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Full Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-2">
                    To'liq ism
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="block w-full pl-10 pr-4 py-3 bg-slate-900 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-600 @error('name') border-rose-500/50 focus:ring-rose-500 @enderror" placeholder="Ismingizni kiriting" />
                </div>
                @error('name')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-slate-400 mb-2">
                    Elektron pochta
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="block w-full pl-10 pr-4 py-3 bg-slate-900 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 hover:border-slate-600 @error('email') border-rose-500/50 focus:ring-rose-500 @enderror" placeholder="email@example.com" />
                </div>
                @error('email')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between pt-4 border-t border-white/5">
                <p class="text-xs text-slate-500">
                    Oxirgi yangilanish: {{ auth()->user()->updated_at ? auth()->user()->updated_at->diffForHumans() : 'Hech qachon' }}
                </p>
                <button type="submit" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 px-6 py-2.5 rounded-xl text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/20 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection