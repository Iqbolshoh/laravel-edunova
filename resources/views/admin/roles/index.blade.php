@extends('layouts.dashboard')

@section('title', 'Rollar')
@section('header_title', 'Rollarni boshqarish')

@section('content')
<div x-data="{ deleteModalOpen: false, deleteUrl: '' }">

    <div x-show="deleteModalOpen" class="fixed inset-0 z-[60] overflow-y-auto" style="display: none;">
        <div x-show="deleteModalOpen" x-transition.opacity @click="deleteModalOpen = false" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 z-10 relative">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-3xl bg-slate-800/95 border border-white/10 text-left shadow-2xl shadow-rose-500/10 transition-all sm:my-8 sm:w-full sm:max-w-md p-8">
                <div>
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-500/10 border border-rose-500/20">
                        <svg class="h-8 w-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    <div class="mt-5 text-center sm:mt-6">
                        <h3 class="text-xl font-semibold leading-6 text-white">Rolni o'chirish</h3>
                        <div class="mt-2">
                            <p class="text-sm text-slate-400">Haqiqatan ham bu rolni o'chirmoqchimisiz? Davom etsangiz, bu ma'lumotlarni qayta tiklab bo'lmaydi.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row-reverse gap-3 sm:gap-4">
                    <form :action="deleteUrl" method="POST" class="w-full sm:w-auto flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center rounded-xl bg-rose-500 hover:bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 focus:outline-none transition-colors">
                            Ha, o'chirish
                        </button>
                    </form>
                    <button type="button" @click="deleteModalOpen = false" class="mt-3 sm:mt-0 w-full sm:w-auto flex-1 justify-center rounded-xl bg-slate-700/50 px-4 py-3 text-sm font-semibold text-white shadow-sm border border-slate-600 hover:bg-slate-700 focus:outline-none transition-colors">
                        Yo'q, qolish
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Rollar</h2>
            <p class="text-sm text-slate-400 mt-1">Tizimda mavjud rollar va ularning ruxsatnomalari</p>
        </div>

        @can('roles.create')
        <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-lg shadow-emerald-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Yangi rol qo'shish
        </a>
        @endcan
    </div>

    @if(session('success'))
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900/50 text-slate-400 text-xs uppercase tracking-wider border-b border-white/5">
                        <th class="px-6 py-4 font-medium">#ID</th>
                        <th class="px-6 py-4 font-medium">Rol Nomi</th>
                        <th class="px-6 py-4 font-medium">Ruxsatnomalar (Permissions)</th>
                        <th class="px-6 py-4 font-medium text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-300">
                    @forelse($roles as $role)
                    <tr class="border-b border-white/5 hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">{{ $role->id }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                {{ ucfirst($role->name) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1 max-w-lg">
                                @forelse($role->permissions as $permission)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-700/50 text-slate-300 border border-white/5">
                                    {{ $permission->name }}
                                </span>
                                @empty
                                <span class="text-slate-500 italic text-xs">Ruxsatnomalar yo'q</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                @can('roles.edit')
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-slate-400 hover:text-blue-400 transition-colors tooltip" title="Tahrirlash">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @endcan

                                @can('roles.delete')
                                @if($role->name !== 'superadmin')
                                <button type="button" @click="deleteUrl = '{{ route('admin.roles.destroy', $role->id) }}'; deleteModalOpen = true" class="text-slate-400 hover:text-rose-400 transition-colors tooltip" title="O'chirish">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                                @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                            Hozircha rollar mavjud emas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-white/5">
            {{ $roles->links() }}
        </div>
    </div>
</div>
@endsection