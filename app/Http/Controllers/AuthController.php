<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // SATU HALAMAN LOGIN UNTUK ADMIN DAN USER
    public function showLogin(Request $request)
    {
        return view('auth.login', [
            'mode' => $request->query('mode', 'user'),
        ]);
    }

    // PROSES LOGIN BERDASARKAN MODE YANG DIPILIH
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,user'],
        ]);

        $user = User::where('email', $data['email'])->first();

        // Periksa email dan password
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email', 'role'));
        }

        // Pastikan role akun sesuai dengan mode login
        if ($user->role !== $data['role']) {
            return back()
                ->withErrors([
                    'email' => 'Akun ini tidak memiliki akses sebagai ' .
                        ($data['role'] === 'admin' ? 'Admin.' : 'User.'),
                ])
                ->withInput($request->only('email', 'role'));
        }

        // Periksa status akun user
        if ($user->role === 'user' && $user->status !== 'aktif') {
            return back()
                ->withErrors([
                    'email' => 'Akun kamu sedang diblokir. Silakan hubungi admin GearCamp.',
                ])
                ->withInput($request->only('email', 'role'));
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Arahkan sesuai role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('user.dashboard'));
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

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'status' => 'aktif',
        ]);

        return redirect()
            ->route('login', ['mode' => 'user'])
            ->with('success', 'Pendaftaran berhasil! Silakan login menggunakan akun yang sudah kamu daftarkan.');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
