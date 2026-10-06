<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori unik dari database
        $kategori = Barang::select('kategori')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        // Query barang
        $query = Barang::latest();

        // FILTER KATEGORI
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // PENCARIAN BARANG
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');

            });
        }

        // Ambil hasil barang
        $barang = $query->get();

        return view('katalog.index', compact(
            'barang',
            'kategori'
        ));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return view('katalog.detail', compact('barang'));
    }
}