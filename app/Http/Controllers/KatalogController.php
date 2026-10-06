<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class KatalogController extends Controller
{
    public function index()
    {
        $barang = Barang::latest()->get();

        return view('katalog.index', compact('barang'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return view('katalog.detail', compact('barang'));
    }
}