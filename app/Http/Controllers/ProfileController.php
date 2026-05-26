<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile settings page.
     */
    public function settings()
    {
        return view('profile.settings');
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ], [
            'name.required'  => 'Ism kiritilishi shart.',
            'name.max'       => 'Ism 255 ta belgidan oshmasligi kerak.',
            'email.required' => 'Elektron pochta kiritilishi shart.',
            'email.email'    => 'To\'g\'ri elektron pochta manzilini kiriting.',
            'email.unique'   => 'Bu elektron pochta allaqachon band qilingan.',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil ma\'lumotlari muvaffaqiyatli yangilandi.');
    }

    /**
     * Show the security settings page.
     */
    public function security()
    {
        return view('profile.security');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => [
                'required',
                'confirmed',
                Password::min(8)
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'current_password.required'         => 'Joriy parol kiritilishi shart.',
            'current_password.current_password' => 'Joriy parol noto\'g\'ri kiritildi.',
            'password.required'                 => 'Yangi parol kiritilishi shart.',
            'password.min'                      => 'Parol kamida 8 ta belgidan iborat bo\'lishi kerak.',
            'password.numbers'                  => 'Parolda kamida 1 ta raqam (0-9) bo\'lishi kerak.',
            'password.symbols'                  => 'Parolda kamida 1 ta belgi (!@#$%^&*) bo\'lishi kerak.',
            'password.confirmed'                => 'Yangi parol tasdiqlash bilan mos kelmadi.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Parol muvaffaqiyatli yangilandi.');
    }

    /**
     * Show the sessions page.
     */
    public function sessions()
    {
        /** @var User $user */
        $user = Auth::user();

        $currentSessionId = request()->session()->getId();

        $sessions = Session::where('user_id', $user->id)
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) use ($currentSessionId) {
                return (object) [
                    'id'            => $session->id,
                    'ip_address'    => $session->ip_address,
                    'user_agent'    => $session->user_agent,
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'is_current'    => $session->id === $currentSessionId,
                ];
            });

        return view('profile.sessions', compact('sessions'));
    }

    /**
     * Delete a specific session by its ID.
     */
    public function destroySession(Request $request, string $sessionId)
    {
        /** @var User $user */
        $user = Auth::user();

        // Faqat o'zining sessiyasini o'chira olishini tekshirish
        $session = Session::where('id', $sessionId)
            ->where('user_id', $user->id)
            ->first();

        if (!$session) {
            abort(404, 'Sessiya topilmadi.');
        }

        // Joriy qurilmani o'chirishga urinmaslik
        if ($session->id === $request->session()->getId()) {
            return back()->with('error', 'Joriy qurilmani bu yerdan o\'chira olmaysiz. Tizimdan chiqish tugmasini bosing.');
        }

        $session->delete();

        return back()->with('success', 'Qurilma sessiyadan muvaffaqiyatli chiqarildi.');
    }
}
