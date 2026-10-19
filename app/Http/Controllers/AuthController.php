<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // HALAMAN LOGIN ADMIN
    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    // PROSES LOGIN ADMIN
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ])) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah, atau akun ini bukan admin.',
            ])
            ->onlyInput('email');
    }

    // HALAMAN LOGIN USER
    public function showUserLogin()
    {
        return view('auth.login-user');
    }

    // PROSES LOGIN USER
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'user',
        ])) {
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah, atau akun ini bukan user.',
            ])
            ->onlyInput('email');
    }

    // HALAMAN REGISTER USER
    public function showRegister()
    {
        return view('auth.register');
    }

    // PROSES REGISTER USER
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.user');
    }
}