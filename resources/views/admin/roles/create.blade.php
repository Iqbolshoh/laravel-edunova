@extends('layouts.dashboard')

@section('title', 'Yangi rol yaratish')
@section('header_title', 'Rollar / Yaratish')

@section('content')
@php
$groupedPermissions = $permissions->groupBy(function($perm) {
return explode('.', $perm->name)[0];
});
@endphp

<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Ortga qaytish
        </a>
        <h2 class="text-2xl font-bold text-white">Yangi rol qo'shish</h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl backdrop-blur-sm p-6 sm:p-8">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="mb-8">
                <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">Rol nomi <span class="text-rose-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Masalan: manager, editor, support..." required>
                @error('name')
                <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-slate-300 mb-4">Ruxsatnomalarni belgilash (Permissions) <span class="text-rose-500">*</span></label>

                @error('permissions')
                <p class="text-rose-400 text-xs mb-4">{{ $message }}</p>
                @enderror

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($groupedPermissions as $groupName => $perms)
                    <div class="bg-slate-900/40 border border-white/5 rounded-xl p-5">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-3 pb-2 border-b border-white/10">
                            {{ ucfirst($groupName) }}
                        </h3>
                        <div class="space-y-3">
                            @foreach($perms as $permission)
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <div class="relative flex items-center pt-0.5">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-slate-600 bg-slate-800 checked:border-blue-500 checked:bg-blue-500 transition-all" @if(is_array(old('permissions')) && in_array($permission->name, old('permissions'))) checked @endif>
                                    <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-3 h-3 pointer-events-none opacity-0 peer-checked:opacity-100 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-slate-300 group-hover:text-white transition-colors">
                                    {{ explode('.', $permission->name)[1] ?? $permission->name }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/5">
                <a href="{{ route('admin.roles.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700 transition-colors">
                    Bekor qilish
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">
                    Saqlash va qo'shish
                </button>
            </div>
        </form>
    </div>
</div>
@endsection