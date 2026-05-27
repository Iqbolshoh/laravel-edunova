@extends('layouts.dashboard')
@section('title', 'Topshiriqlar')
@section('header_title', 'Topshiriqlar')

@section('content')
<div class="space-y-6" x-data="{ deleteModalOpen: false, deleteUrl: '', deleteTitle: '' }">

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModalOpen" class="fixed inset-0 z-[60] overflow-y-auto" style="display: none;">
        <div x-show="deleteModalOpen" x-transition.opacity @click="deleteModalOpen = false" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 z-10 relative">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-slate-800/95 border border-white/10 text-left shadow-2xl shadow-rose-500/10 transition-all sm:my-8 sm:w-full sm:max-w-md p-6">
                <div>
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/20 border border-rose-500/30">
                        <svg class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    <div class="mt-5 text-center sm:mt-6">
                        <h3 class="text-xl font-semibold leading-6 text-white">Topshiriqni o'chirish</h3>
                        <div class="mt-2">
                            <p class="text-sm text-slate-400">
                                "<span x-text="deleteTitle"></span>" topshiriqni o'chirmoqchimisiz? Bu amal qaytarib bo'lmaydi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row-reverse gap-3 sm:gap-4">
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 hover:bg-rose-400 transition-colors cursor-pointer">
                            Ha, o'chirish
                        </button>
                    </form>
                    <button type="button" @click="deleteModalOpen = false" class="mt-3 sm:mt-0 w-full sm:w-auto flex-1 justify-center rounded-xl bg-slate-700/50 px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 transition-colors cursor-pointer">
                        Yo'q, bekor qilish
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Barcha topshiriqlar</h2>
            <p class="text-sm text-slate-400 mt-1">Sizga yuklatilgan vazifalar</p>
        </div>

        @can('assignments.create')
        <a href="{{ route('assignments.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-blue-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yangi topshiriq
        </a>
        @endcan
    </div>

    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400 mb-6">
        <span class="text-sm font-medium">{{ session('success') }}</span>
        <button @click="show = false" class="hover:text-emerald-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    <div class="grid gap-4">
        @forelse($assignments as $item)
        <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 hover:border-blue-500/30 transition-colors flex flex-col md:flex-row gap-6 justify-between md:items-center">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white hover:text-blue-400 transition-colors">
                        <a href="{{ route('assignments.show', $item) }}">{{ $item->title }}</a>
                    </h3>
                    <p class="text-sm text-slate-400 mt-1">Kurs: <span class="text-slate-300">{{ $item->course->title ?? 'Umumiy' }}</span></p>

                    {{-- Ma'lumot ko'rsatkichlari --}}
                    <div class="flex flex-wrap items-center gap-2.5 mt-3 text-xs font-medium">
                        {{-- Max ball --}}
                        <span class="inline-flex items-center gap-1.5 bg-slate-700/50 text-slate-300 px-2.5 py-1.5 rounded-lg border border-white/5">
                            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Max ball: {{ $item->max_score }}
                        </span>

                        {{-- Muddat --}}
                        <span class="inline-flex items-center gap-1.5 bg-slate-700/50 text-slate-300 px-2.5 py-1.5 rounded-lg border border-white/5">
                            <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Muddat: {{ \Carbon\Carbon::parse($item->due_date)->format('d.m.Y H:i') }}
                        </span>

                        {{-- Tekshiruvchi uchun ma'lumot --}}
                        @can('assignments.grade')
                        @php
                        $ungradedCount = $item->submissions->where('status', 'submitted')->count();
                        $totalSubmissions = $item->submissions->count();
                        @endphp
                        @if($ungradedCount > 0)
                        <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 px-2.5 py-1.5 rounded-lg border border-amber-500/20">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $ungradedCount }} ta tekshirilmagan
                        </span>
                        @elseif($totalSubmissions > 0)
                        <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 px-2.5 py-1.5 rounded-lg border border-emerald-500/20">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Barchasi tekshirilgan
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 bg-slate-700/50 text-slate-400 px-2.5 py-1.5 rounded-lg border border-white/5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            Barchasi tekshirilgan
                        </span>
                        @endif
                        @endcan

                        {{-- Talaba uchun topshiriq holati --}}
                        @if(!auth()->user()->can('assignments.grade'))
                        @php
                        $userSub = $item->submissions->where('user_id', auth()->id())->first();
                        @endphp
                        @if($userSub)
                        <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 px-2.5 py-1.5 rounded-lg border border-emerald-500/20">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Topshirilgan
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 bg-rose-500/10 text-rose-400 px-2.5 py-1.5 rounded-lg border border-rose-500/20">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Topshirilmagan
                        </span>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <a href="{{ route('assignments.show', $item) }}" class="bg-slate-700 hover:bg-slate-600 text-slate-300 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors border border-white/5">
                    Ko'rish
                </a>

                @can('assignments.edit')
                <a href="{{ route('assignments.edit', $item) }}" class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-500 p-2.5 rounded-xl transition-colors border border-amber-500/20" title="Tahrirlash">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </a>
                @endcan

                @can('assignments.delete')
                <button @click="deleteUrl = '{{ route('assignments.destroy', $item) }}'; deleteTitle = '{{ $item->title }}'; deleteModalOpen = true" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-500 p-2.5 rounded-xl transition-colors border border-rose-500/20 cursor-pointer" title="O'chirish">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
                @endcan
            </div>
        </div>
        @empty
        <div class="text-center py-12 bg-slate-800/50 rounded-2xl border border-white/5">
            <p class="text-slate-400">Hozircha vazifalar yo'q.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $assignments->links() }}
    </div>
</div>
@endsection