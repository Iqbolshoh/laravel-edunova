<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Handle the incoming login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kiritilgan ma\'lumotlar noto\'g\'ri.',
        ])->onlyInput('email');
    }

    /**
     * Handle the incoming registration request.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->numbers()
                    ->symbols(),
            ],
            'terms' => ['accepted'],
        ], [
            'first_name.required' => 'Ism kiritilishi shart.',
            'first_name.max'      => 'Ism 255 ta belgidan oshmasligi kerak.',
            'last_name.required'  => 'Familiya kiritilishi shart.',
            'last_name.max'       => 'Familiya 255 ta belgidan oshmasligi kerak.',
            'email.required'      => 'Elektron pochta kiritilishi shart.',
            'email.email'         => 'To\'g\'ri elektron pochta manzilini kiriting.',
            'email.unique'        => 'Bu elektron pochta allaqachon ro\'yxatdan o\'tgan.',
            'password.required'   => 'Parol kiritilishi shart.',
            'password.min'        => 'Parol kamida 8 ta belgidan iborat bo\'lishi kerak.',
            'password.numbers'    => 'Parolda kamida 1 ta raqam (0-9) bo\'lishi kerak.',
            'password.symbols'    => 'Parolda kamida 1 ta belgi bo\'lishi kerak.',
            'password.confirmed'  => 'Parol tasdiqlash bilan mos kelmadi.',
            'terms.accepted'      => 'Foydalanish shartlariga rozilik bildirishingiz kerak.',
        ]);

        $fullName = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

        $user = User::create([
            'name'     => $fullName,
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole) {
            $user->assignRole($studentRole);
        }

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Xush kelibsiz, ' . $user->name . '!');
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
