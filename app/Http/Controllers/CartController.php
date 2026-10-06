<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    // Tambah barang ke keranjang
    public function add(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->stok <= 0) {
            return redirect()->back()->with('error', 'Stok barang habis.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            if ($cart[$id]['jumlah'] < $barang->stok) {
                $cart[$id]['jumlah']++;
            } else {
                return redirect()->back()->with(
                    'error',
                    'Jumlah barang melebihi stok yang tersedia.'
                );
            }

        } else {

            $cart[$id] = [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'kategori' => $barang->kategori,
                'harga_per_hari' => $barang->harga_per_hari,
                'foto' => $barang->foto,
                'jumlah' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with(
            'success',
            $barang->nama_barang . ' berhasil ditambahkan ke keranjang.'
        );
    }

    // Tambah jumlah
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index');
        }

        $barang = Barang::findOrFail($id);

        if ($cart[$id]['jumlah'] < $barang->stok) {
            $cart[$id]['jumlah']++;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Kurangi jumlah
    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index');
        }

        if ($cart[$id]['jumlah'] > 1) {
            $cart[$id]['jumlah']--;
        } else {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // Hapus barang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with(
            'success',
            'Barang berhasil dihapus dari keranjang.'
        );
    }

    // Kosongkan keranjang
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with(
            'success',
            'Keranjang berhasil dikosongkan.'
        );
    }
}