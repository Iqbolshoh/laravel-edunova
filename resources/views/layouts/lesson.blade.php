<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dars') - EduNova</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-900 text-slate-200 font-sans antialiased selection:bg-blue-500 selection:text-white overflow-hidden">

    <div x-data="{ sidebarOpen: true }" class="flex h-screen w-full relative">

        {{-- Sidebar - Darslar ro'yxati --}}
        <aside :class="sidebarOpen ? 'w-80' : 'w-0'" class="bg-slate-900/95 border-r border-white/5 flex flex-col transition-all duration-300 overflow-hidden relative">
            <div class="flex-1 overflow-y-auto">
                {{-- Sidebar Header --}}
                <div class="p-5 border-b border-white/5">
                    <a href="{{ route('courses.show', $course) }}" class="text-sm text-slate-400 hover:text-white transition-colors flex items-center gap-1 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ $course->title }}
                    </a>
                    <h2 class="text-lg font-bold text-white">Darslar</h2>
                    <p class="text-xs text-slate-500 mt-1">{{ $allLessons->count() }} ta dars</p>
                </div>

                {{-- Lessons List --}}
                <div class="p-3 space-y-1">
                    @foreach($allLessons as $item)
                    <a href="{{ route('courses.lessons.show', [$course, $item]) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              {{ $item->id === $lesson->id ? 'bg-blue-500/10 border border-blue-500/20' : 'hover:bg-slate-800/50 border border-transparent' }}">
                        {{-- Status icon --}}
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                                    {{ $item->id === $lesson->id ? 'bg-blue-500/20 text-blue-400' : 'bg-slate-800 text-slate-500 group-hover:bg-slate-700 group-hover:text-slate-300' }}">
                            {{ $item->order }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate
                                    {{ $item->id === $lesson->id ? 'text-blue-400' : 'text-slate-300 group-hover:text-white' }}">
                                {{ $item->title }}
                            </p>
                            @if($item->duration)
                            <p class="text-xs text-slate-500">{{ $item->duration }} daq</p>
                            @endif
                        </div>
                        @if($item->id === $lesson->id)
                        <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Sidebar Footer --}}
            <div class="p-4 border-t border-white/5">
                <a href="{{ route('courses.lessons.index', $course) }}" class="text-xs text-slate-500 hover:text-slate-400 transition-colors">
                    Barcha darslarni boshqarish →
                </a>
            </div>
        </aside>

        {{-- Toggle Button --}}
        <button @click="sidebarOpen = !sidebarOpen"
            class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-slate-800 border border-white/10 rounded-r-lg p-1.5 hover:bg-slate-700 transition-colors"
            :class="sidebarOpen ? 'translate-x-80' : 'translate-x-0'">
            <svg x-show="sidebarOpen" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <svg x-show="!sidebarOpen" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-900/50">
            {{-- Top Bar --}}
            <header class="h-16 flex items-center justify-between px-6 bg-slate-900/80 backdrop-blur-md border-b border-white/5 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-400 font-bold text-sm">
                        {{ $lesson->order }}
                    </span>
                    <h1 class="text-lg font-semibold text-white truncate">{{ $lesson->title }}</h1>
                </div>
                <div class="flex items-center gap-2">
                    @if($prevLesson)
                    <a href="{{ route('courses.lessons.show', [$course, $prevLesson]) }}"
                        class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-1.5 rounded-lg text-sm transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Oldingi
                    </a>
                    @endif
                    @if($nextLesson)
                    <a href="{{ route('courses.lessons.show', [$course, $nextLesson]) }}"
                        class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-1.5 rounded-lg text-sm transition-colors flex items-center gap-1">
                        Keyingi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @endif
                </div>
            </header>

            {{-- Main Area --}}
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>