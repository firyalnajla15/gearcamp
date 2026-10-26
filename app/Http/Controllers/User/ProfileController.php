<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],

            'current_password' => [
                'nullable',
                'required_with:password',
                'current_password',
            ],
            'password' => [
                'nullable',
                'required_with:current_password',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'current_password.required_with' => 'Masukkan password saat ini.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.required_with' => 'Masukkan password baru.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;

        $passwordChanged = !empty($validated['password']);

        if ($passwordChanged) {
            $user->password = $validated['password'];
        }

        $user->save();

        if ($passwordChanged) {
            $message = 'Informasi dan password berhasil diperbarui.';

            if (
                $request->boolean('password_only')
                && $request->boolean('profile_unchanged')
            ) {
                $message = 'Password berhasil diperbarui.';
            }
        } else {
            $message = 'Informasi berhasil diperbarui.';
        }

        return redirect()
            ->route('user.profile')
            ->with('success', $message);
    }
}
