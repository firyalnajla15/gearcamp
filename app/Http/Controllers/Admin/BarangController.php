<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Barang::select('kategori')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $query = Barang::latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $barang = $query->paginate(10)->withQueryString();

        return view('admin.barang.index', compact('barang', 'kategori'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('barang', 'public');
        }

        Barang::create($validated);

        return redirect()
            ->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Simpan foto baru terlebih dahulu.
            $fotoBaru = $request->file('foto')
                ->store('barang', 'public');

            // Hapus foto lama jika merupakan file lokal.
            if (
                $barang->foto &&
                !Str::startsWith($barang->foto, ['http://', 'https://'])
            ) {
                Storage::disk('public')->delete($barang->foto);
            }

            $validated['foto'] = $fotoBaru;
        }

        $barang->update($validated);

        return redirect()
            ->route('admin.barang.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if (
            $barang->foto &&
            !Str::startsWith($barang->foto, ['http://', 'https://'])
        ) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()
            ->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}