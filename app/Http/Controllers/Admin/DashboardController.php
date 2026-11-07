<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik barang
        $totalBarang = DB::table('barang')->count();
        $totalStok = DB::table('barang')->sum('stok');

        $stokHabis = DB::table('barang')
            ->where('stok', 0)
            ->count();

        $stokMenipis = DB::table('barang')
            ->whereBetween('stok', [1, 5])
            ->count();

        // Statistik transaksi
        $totalTransaksi = DB::table('rentals')->count();

        // Statistik pengguna
        $totalUser = DB::table('users')
            ->where('role', 'user')
            ->count();

        $totalAdmin = DB::table('users')
            ->where('role', 'admin')
            ->count();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalStok',
            'stokHabis',
            'stokMenipis',
            'totalTransaksi',
            'totalUser',
            'totalAdmin'
        ));
    }
}
