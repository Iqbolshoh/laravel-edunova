@extends('layouts.dashboard')

@section('title', 'Kurslar')
@section('header_title', 'Kurslar')

@section('content')
<div class="space-y-6">

    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Kurslar</h2>
            <p class="text-sm text-slate-400 mt-1">
                @if(auth()->user()->hasRole('teacher'))
                Siz yaratgan kurslar ro'yxati
                @else
                Mavjud kurslar ro'yxati
                @endif
            </p>
        </div>
        @can('courses.create')
        <a href="{{ route('courses.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-emerald-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Yangi kurs
        </a>
        @endcan
    </div>

    @if($courses->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
        <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-1 group">
            {{-- Course Image --}}
            <div class="h-40 bg-slate-700/50 overflow-hidden">
                @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-emerald-500/20">
                    <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path>
                    </svg>
                </div>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-lg font-semibold text-white mb-2 line-clamp-1">{{ $course->title }}</h3>
                <p class="text-sm text-slate-400 line-clamp-2 mb-4">{{ $course->description ?? 'Tavsif mavjud emas' }}</p>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        @if($course->status === 'active') bg-emerald-500/10 text-emerald-400
                        @elseif($course->status === 'inactive') bg-rose-500/10 text-rose-400
                        @else bg-slate-500/10 text-slate-400
                        @endif">
                        @if($course->status === 'active') Faol
                        @elseif($course->status === 'inactive') Nofaol
                        @else Qoralama
                        @endif
                    </span>
                    @if($course->price > 0)
                    <span class="text-sm text-white font-medium">{{ number_format($course->price) }} so'm</span>
                    @else
                    <span class="text-sm text-emerald-400 font-medium">Bepul</span>
                    @endif
                </div>

                <div class="flex items-center gap-3 text-xs text-slate-500 mb-4">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        {{ $course->students_count ?? 0 }}
                    </span>
                    @if($course->duration)
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $course->duration }} soat
                    </span>
                    @endif
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('courses.show', $course) }}" class="flex-1 text-center bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg text-sm transition-colors">
                        Ko'rish
                    </a>
                    @can('courses.edit')
                    <a href="{{ route('courses.edit', $course) }}" class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 px-3 py-2 rounded-lg text-sm transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $courses->links() }}
    </div>

    @else
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-12 text-center backdrop-blur-sm">
        <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path>
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-white mb-2">Hozircha kurslar yo'q</h2>
        <p class="text-slate-400 mb-6">
            @if(auth()->user()->hasRole('teacher'))
            Siz hali biron-bir kurs yaratmagansiz.
            @else
            Hozircha faol kurslar mavjud emas.
            @endif
        </p>
        @can('courses.create')
        <a href="{{ route('courses.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-medium transition-colors">
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