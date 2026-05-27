@extends('layouts.dashboard')

@section('title', 'Kurslar')
@section('header_title', 'Kurslar')

@section('content')
<div class="space-y-6" x-data="{ deleteModalOpen: false, deleteUrl: '', deleteTitle: '' }">

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModalOpen" class="fixed inset-0 z-[60] overflow-y-auto" style="display: none;">
        <div x-show="deleteModalOpen" x-transition.opacity @click="deleteModalOpen = false"
            class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 z-10 relative">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-slate-800/95 border border-white/10 text-left shadow-2xl shadow-rose-500/10 transition-all sm:my-8 sm:w-full sm:max-w-md p-6">
                <div>
                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/20 border border-rose-500/30">
                        <svg class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    <div class="mt-5 text-center sm:mt-6">
                        <h3 class="text-xl font-semibold leading-6 text-white">Kursni o'chirish</h3>
                        <div class="mt-2">
                            <p class="text-sm text-slate-400">
                                <span x-text="deleteTitle"></span> kursini o'chirmoqchimisiz? Bu amal qaytarib bo'lmaydi
                                va barcha darslar bilan birga o'chiriladi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row-reverse gap-3 sm:gap-4">
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full justify-center rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 hover:bg-rose-400 transition-colors">Ha,
                            o'chirish</button>
                    </form>
                    <button type="button" @click="deleteModalOpen = false"
                        class="mt-3 sm:mt-0 w-full sm:w-auto flex-1 justify-center rounded-xl bg-slate-700/50 px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 transition-colors">Yo'q,
                        bekor qilish</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show"
        class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300"><svg class="w-5 h-5"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg></button>
    </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Kurslar</h2>
            <p class="text-sm text-slate-400 mt-1">Barcha mavjud kurslar ro'yxati</p>
        </div>
        @can('courses.create')
        <a href="{{ route('courses.create') }}"
            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-emerald-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yangi kurs
        </a>
        @endcan
    </div>

    {{-- Courses Grid --}}
    @if ($courses->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($courses as $course)
        <div
            class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-40 bg-slate-700/50 overflow-hidden">
                @if ($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                @else
                <div
                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-emerald-500/20">
                    <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253">
                        </path>
                    </svg>
                </div>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-lg font-semibold text-white mb-2 line-clamp-1">{{ $course->title }}</h3>
                <p class="text-sm text-slate-400 line-clamp-2 mb-4">
                    {{ $course->description ?? 'Tavsif mavjud emas' }}
                </p>

                <div class="flex items-center justify-between mb-4">
                    <span
                        class="text-xs px-2 py-1 rounded-full font-medium
                        @if ($course->status === 'active') bg-emerald-500/10 text-emerald-400
                        @elseif($course->status === 'inactive') bg-rose-500/10 text-rose-400
                        @else bg-slate-500/10 text-slate-400 @endif">
                        @if ($course->status === 'active')
                        Faol
                        @elseif($course->status === 'inactive')
                        Nofaol
                        @else
                        Qoralama
                        @endif
                    </span>
                    @if ($course->price > 0)
                    <span class="text-sm text-white font-medium">{{ number_format($course->price) }}
                        so'm</span>
                    @else
                    <span class="text-sm text-emerald-400 font-medium">Bepul</span>
                    @endif
                </div>

                <div class="flex items-center gap-3 text-xs text-slate-500 mb-4">
                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg> {{ $course->students_count ?? 0 }}</span>
                    @if ($course->duration)
                    <span>•</span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg> {{ $course->duration }} soat</span>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('courses.show', $course) }}"
                        class="flex-1 text-center bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg text-sm transition-colors">Ko'rish</a>
                    @can('courses.edit')
                    <a href="{{ route('courses.edit', $course) }}"
                        class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 px-3 py-2 rounded-lg text-sm transition-colors cursor-pointer"
                        title="Tahrirlash">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    @endcan
                    @can('courses.delete')
                    <button
                        @click="deleteUrl = '{{ route('courses.destroy', $course) }}'; deleteTitle = '{{ $course->title }}'; deleteModalOpen = true"
                        class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 px-3 py-2 rounded-lg text-sm transition-colors cursor-pointer"
                        title="O'chirish">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">{{ $courses->links() }}</div>
    @else
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-12 text-center backdrop-blur-sm">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253">
                </path>
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-white mb-2">Hozircha kurslar yo'q</h2>
        <p class="text-slate-400 mb-6">Hozircha faol kurslar mavjud emas.</p>
        @can('courses.create')
        <a href="{{ route('courses.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yangi kurs yaratish
        </a>
        @endcan
    </div>
    @endif
</div>
@endsection