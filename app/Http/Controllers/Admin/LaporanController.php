<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function filteredQuery(Request $request)
    {
        $query = Rental::with(['user', 'details.barang']);

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_mulai', '<=', $request->tanggal_selesai);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    public function index(Request $request)
    {
        $statistikQuery = $this->filteredQuery($request);

        $laporan = (clone $statistikQuery)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalTransaksi = (clone $statistikQuery)->count();

        $totalPendapatan = (clone $statistikQuery)
            ->where('status_pembayaran', 'lunas')
            ->sum('total_harga');

        $transaksiMenunggu = (clone $statistikQuery)
            ->where('status', 'menunggu')
            ->count();

        $transaksiSelesai = (clone $statistikQuery)
            ->where('status', 'selesai')
            ->count();

        $transaksiDibatalkan = (clone $statistikQuery)
            ->where('status', 'dibatalkan')
            ->count();

        return view('admin.laporan.index', compact(
            'laporan',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiMenunggu',
            'transaksiSelesai',
            'transaksiDibatalkan'
        ));
    }

    public function exportPdf(Request $request)
{
    $laporan = $this->filteredQuery($request)
        ->latest()
        ->get();

    $admin = auth()->guard()->user();

    $pdf = Pdf::loadView('admin.laporan.pdf', [
        'laporan' => $laporan,
        'admin' => $admin,
    ])->setPaper('a4', 'landscape');

    return $pdf->download('laporan-rental-gearcamp.pdf');
}
}
