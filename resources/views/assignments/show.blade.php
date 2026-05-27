@extends('layouts.dashboard')
@section('title', $assignment->title)
@section('header_title', 'Topshiriq tafsilotlari')

@section('content')
<div class="space-y-6">
    <div class="mb-4">
        <a href="{{ route('assignments.index') }}" class="text-sm text-slate-400 hover:text-white flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Ortga qaytish
        </a>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 sm:p-8 backdrop-blur-sm">
        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">{{ $assignment->title }}</h2>
                <div class="prose prose-invert max-w-none text-slate-300">
                    {!! $assignment->description !!}
                </div>
            </div>

            <div class="bg-slate-900/50 rounded-xl p-4 border border-white/5 min-w-[200px]">
                <p class="text-xs text-slate-400 mb-1">Maksimal ball</p>
                <p class="text-xl font-bold text-emerald-400 mb-4">{{ $assignment->max_score }} ball</p>
                <p class="text-xs text-slate-400 mb-1">Muddat</p>
                <p class="text-sm font-medium text-rose-400">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d.m.Y H:i') }}</p>
            </div>
        </div>

        {{-- Student submission area --}}
        @can('assignments.submit')
        @cannot('assignments.grade')
        <div class="mt-8 pt-6 border-t border-white/5">
            @if($userSubmission)
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-3 text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-emerald-400 mb-1">Vazifa yuborilgan!</h3>
                @if($userSubmission->status === 'graded')
                <p class="text-slate-300 mb-2">Sizning bahoingiz: <span class="font-bold text-white">{{ $userSubmission->score }} / {{ $assignment->max_score }}</span></p>
                <p class="text-sm text-slate-400 italic">"{{ $userSubmission->feedback }}"</p>
                @else
                <p class="text-sm text-slate-400">O'qituvchi tekshirishi kutilmoqda.</p>
                @endif
                <a href="{{ route('submissions.download', $userSubmission) }}" class="mt-4 inline-block text-sm text-blue-400 hover:text-blue-300 underline">Faylingizni yuklab olish</a>
            </div>
            @else
            <div class="text-center">
                <a href="{{ route('assignments.submit', $assignment) }}" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-bold transition-colors shadow-lg shadow-blue-500/30">
                    Vazifani bajarish
                </a>
            </div>
            @endif
        </div>
        @endcannot
        @endcan
    </div>

    {{-- O'qituvchi uchun baholash maydoni --}}
    @can('assignments.grade')
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
        <h3 class="text-xl font-bold text-white mb-6">Talabalar javoblari</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 text-sm text-slate-400">
                        <th class="pb-3 font-medium">Talaba</th>
                        <th class="pb-3 font-medium">Yuborilgan sana</th>
                        <th class="pb-3 font-medium text-center">Fayl</th>
                        <th class="pb-3 font-medium text-center">Baho</th>
                        <th class="pb-3 font-medium text-right">Amal</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($assignment->submissions as $sub)
                    <tr class="border-b border-white/5 last:border-0 hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 text-white font-medium">{{ $sub->user->name ?? 'Talaba' }}</td>
                        <td class="py-4 text-slate-400">{{ $sub->submitted_at->format('d.m.Y H:i') }}</td>
                        <td class="py-4 text-center">
                            <a href="{{ route('submissions.download', $sub) }}" class="text-blue-400 hover:underline">Yuklash</a>
                        </td>
                        <td class="py-4 text-center">
                            @if($sub->status === 'graded')
                            <span class="text-emerald-400 font-bold">{{ $sub->score }}</span>
                            @else
                            <span class="text-amber-400">Baholanmagan</span>
                            @endif
                        </td>
                        <td class="py-4 text-right">
                            <form action="{{ route('submissions.grade', $sub) }}" method="POST" class="flex items-center justify-end gap-2">
                                @csrf
                                <input type="number" name="score" class="w-20 bg-slate-900 border border-white/10 rounded-lg px-2 py-1.5 text-white text-center" placeholder="Ball" max="{{ $assignment->max_score }}" required>
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg transition-colors">Saqlash</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-slate-500">Hali hech kim vazifa yubormadi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endcan
</div>
@endsection