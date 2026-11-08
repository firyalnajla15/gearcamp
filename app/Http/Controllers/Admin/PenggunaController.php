<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    // Daftar pengguna
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengguna = $query->paginate(10)->withQueryString();

        return view('admin.pengguna.index', compact('pengguna'));
    }

    // Detail pengguna
    public function show(string $id)
    {
        $pengguna = User::where('role', 'user')->findOrFail($id);

        return view('admin.pengguna.show', compact('pengguna'));
    }

    // Form edit pengguna
    public function edit(string $id)
    {
        $pengguna = User::where('role', 'user')->findOrFail($id);

        return view('admin.pengguna.edit', compact('pengguna'));
    }

    // Update data pengguna
    public function update(Request $request, string $id)
    {
        $pengguna = User::where('role', 'user')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($pengguna->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $pengguna->update($validated);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Aktifkan atau blokir pengguna
    public function updateStatus(Request $request, string $id)
    {
        $pengguna = User::where('role', 'user')->findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['aktif', 'diblokir'])],
        ]);

        $pengguna->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status pengguna berhasil diperbarui.'
        );
    }
}