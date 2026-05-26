@extends('layouts.dashboard')

@section('title', 'Sessiyalar')
@section('header_title', 'Faol sessiyalar')

@section('content')
<div class="max-w-3xl mx-auto" x-data="{ 
    showModal: false, 
    sessionToDelete: null,
    openModal(id) { this.sessionToDelete = id; this.showModal = true; },
    closeModal() { this.showModal = false; this.sessionToDelete = null; }
}">

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

    {{-- Error Message --}}
    @if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mb-6 flex items-center justify-between bg-rose-500/10 border border-rose-500/20 rounded-xl p-4 text-rose-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="text-rose-400 hover:text-rose-300 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Validation Errors --}}
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

    {{-- Sessions List Card --}}
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm">
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-white/5">
            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Faol sessiyalar</h2>
                <p class="text-sm text-slate-400">Hisobingizga kirilgan qurilmalar ro'yxati</p>
            </div>
        </div>

        {{-- Sessions List --}}
        @if (isset($sessions) && count($sessions) > 0)
        <div class="space-y-3">
            @foreach ($sessions as $session)
            <div class="flex items-center justify-between bg-slate-900/50 rounded-xl p-4 border {{ $session->is_current ? 'border-blue-500/30 bg-blue-500/5' : 'border-white/5' }}">
                {{-- Device Info --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 {{ $session->is_current ? 'bg-blue-500/10 text-blue-400' : 'bg-slate-800 text-slate-400' }} rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-white">
                                {{ $session->ip_address ?? 'Noma\'lum IP' }}
                            </span>
                            @if ($session->is_current)
                            <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded-full font-medium">Joriy qurilma</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 mt-1">
                            So'nggi faollik: {{ $session->last_activity }}
                        </p>
                    </div>
                </div>

                {{-- Logout Button (only for non-current sessions) --}}
                @if (!$session->is_current)
                <button @click="openModal('{{ $session->id }}')" type="button" class="text-xs bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Chiqish
                </button>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-sm text-slate-500">Hech qanday faol sessiya topilmadi</p>
        </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
        style="display: none;">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

        {{-- Modal Content --}}
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 relative z-10">
            <div x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="closeModal()"
                class="relative transform overflow-hidden rounded-2xl bg-slate-800/90 border border-white/10 text-left shadow-2xl shadow-rose-500/10 transition-all sm:my-8 sm:w-full sm:max-w-md p-6">

                {{-- Icon --}}
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/20 border border-rose-500/30">
                    <svg class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </div>

                {{-- Title --}}
                <div class="mt-5 text-center sm:mt-6">
                    <h3 class="text-xl font-semibold leading-6 text-white" id="modal-title">
                        Qurilmani chiqarish
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-slate-400">
                            Ushbu qurilma hisobingizdan chiqariladi. Agar bu sizning qurilmangiz bo'lsa, qaytadan kirishingiz kerak bo'ladi.
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-6 flex flex-col sm:flex-row-reverse gap-3 sm:gap-4">
                    <form :action="'/profile/sessions/' + sessionToDelete" method="POST" class="w-full sm:w-auto flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 hover:bg-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-500 transition-colors">
                            Ha, chiqarish
                        </button>
                    </form>
                    <button type="button" @click="closeModal()" class="mt-3 sm:mt-0 w-full sm:w-auto flex-1 justify-center rounded-xl bg-slate-700/50 px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 focus:outline-none transition-colors">
                        Yo'q, bekor qilish
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection