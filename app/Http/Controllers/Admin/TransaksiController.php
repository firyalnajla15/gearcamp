<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Rental;
use App\Models\RentalReschedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with(['user', 'details.barang']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_rental', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksi = $query->latest()->paginate(10)->withQueryString();

        $totalTransaksi = Rental::count();
        $menunggu = Rental::where('status', 'menunggu')->count();
        $diproses = Rental::where('status', 'diproses')->count();
        $sedangDisewa = Rental::where('status', 'disewa')->count();
        $selesai = Rental::where('status', 'selesai')->count();

        return view('admin.transaksi.index', compact(
            'transaksi',
            'totalTransaksi',
            'menunggu',
            'diproses',
            'sedangDisewa',
            'selesai'
        ));
    }

    public function show(Rental $rental)
    {
        $rental->load([
            'user',
            'details.barang',
            'reschedules.pengaju',
            'reschedules.peninjau',
        ]);

        return view('admin.transaksi.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        if ($rental->status !== 'menunggu') {
            return redirect()
                ->route('admin.transaksi.show', $rental->id)
                ->with('error', 'Transaksi hanya bisa diedit sebelum booking diterima.');
        }

        $rental->load(['user', 'details.barang']);

        return view('admin.transaksi.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'tanggal_mulai' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_selesai' => ['required', 'date', 'after:tanggal_mulai'],
            'catatan' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated, $rental) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Transaksi tidak bisa diedit karena booking sudah diproses.',
                ]);
            }

            $mulai = Carbon::parse($validated['tanggal_mulai']);
            $selesai = Carbon::parse($validated['tanggal_selesai']);
            $totalHari = (int) $mulai->diffInDays($selesai);

            $data->load('details');

            $totalHarga = 0;

            foreach ($data->details as $detail) {
                $subtotal = $detail->harga_per_hari
                    * $detail->jumlah
                    * $totalHari;

                $detail->update(['subtotal' => $subtotal]);

                $totalHarga += $subtotal;
            }

            $data->update([
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'total_hari' => $totalHari,
                'total_harga' => $totalHarga,
                'catatan' => $validated['catatan'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.transaksi.show', $rental->id)
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function terima(Request $request, Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Booking ini sudah diproses sebelumnya.',
                ]);
            }

            if ($data->stok_dikurangi) {
                throw ValidationException::withMessages([
                    'stok' => 'Stok transaksi ini sudah pernah dikurangi.',
                ]);
            }

            $data->load('details');

            foreach ($data->details as $detail) {
                $barang = Barang::whereKey($detail->barang_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($barang->stok < $detail->jumlah) {
                    throw ValidationException::withMessages([
                        'stok' => "Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok}.",
                    ]);
                }

                $barang->decrement('stok', $detail->jumlah);
            }

            $data->update([
                'status' => 'diproses',
                'stok_dikurangi' => true,
                'alasan_penolakan' => null,
            ]);
        });

        return back()->with('success', 'Booking diterima dan stok berhasil diperbarui.');
    }

    public function tolak(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'alasan_penolakan' => ['required', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($rental, $validated) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Hanya booking yang menunggu yang bisa ditolak.',
                ]);
            }

            $data->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $validated['alasan_penolakan'],
            ]);
        });

        return back()->with('success', 'Booking berhasil ditolak.');
    }

    public function serahkan(Request $request, Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'diproses' || !$data->stok_dikurangi) {
                throw ValidationException::withMessages([
                    'status' => 'Booking harus diterima dan stok harus sudah dikurangi sebelum barang diserahkan.',
                ]);
            }

            $data->update([
                'status' => 'disewa',
                'tanggal_diserahkan' => now()->toDateString(),
            ]);
        });

        return back()->with('success', 'Barang berhasil diserahkan kepada penyewa.');
    }

    public function kembalikan(Request $request, Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data->status !== 'disewa' || !$data->stok_dikurangi) {
                throw ValidationException::withMessages([
                    'status' => 'Transaksi belum berstatus sedang disewa atau stok sudah dikembalikan.',
                ]);
            }

            $tanggalSelesai = Carbon::parse($data->tanggal_selesai)->startOfDay();
            $tanggalKembali = Carbon::today();

            $hariTerlambat = $tanggalKembali->greaterThan($tanggalSelesai)
                ? (int) $tanggalSelesai->diffInDays($tanggalKembali)
                : 0;

            $data->load('details');

            $biayaTambahan = 0;

            foreach ($data->details as $detail) {
                $biayaTambahan += $detail->harga_per_hari
                    * $detail->jumlah
                    * $hariTerlambat;
            }

            // Kembalikan stok satu kali saja.
            foreach ($data->details as $detail) {
                $barang = Barang::whereKey($detail->barang_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $barang->increment('stok', $detail->jumlah);
            }

            $data->update([
                'status' => 'selesai',
                'tanggal_dikembalikan' => $tanggalKembali->toDateString(),
                'total_hari_tambahan' => $hariTerlambat,
                'biaya_tambahan' => $biayaTambahan,
                'status_pembayaran_tambahan' => $biayaTambahan > 0
                    ? 'belum_bayar'
                    : 'tidak_ada',
                'stok_dikurangi' => false,
            ]);
        });

        return back()->with('success', 'Pengembalian berhasil diproses.');
    }

    public function konfirmasiPembayaranTambahan(Request $request, Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $data->status !== 'selesai' ||
                (float) $data->biaya_tambahan <= 0 ||
                $data->status_pembayaran_tambahan !== 'belum_bayar'
            ) {
                throw ValidationException::withMessages([
                    'pembayaran' => 'Tidak ada pembayaran tambahan yang perlu dikonfirmasi.',
                ]);
            }

            $data->update([
                'status_pembayaran_tambahan' => 'lunas',
            ]);
        });

        return back()->with('success', 'Pembayaran tambahan berhasil dikonfirmasi.');
    }

    public function ajukanReschedule(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'tanggal_mulai_baru' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_selesai_baru' => ['required', 'date', 'after:tanggal_mulai_baru'],
            'alasan' => ['required', 'string', 'max:2000'],
        ]);

        $pengajuId = $request->user()->id;

        DB::transaction(function () use ($rental, $validated, $pengajuId) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array($data->status, ['menunggu', 'diproses', 'disewa'])) {
                throw ValidationException::withMessages([
                    'status' => 'Jadwal transaksi ini tidak bisa diubah.',
                ]);
            }

            $sudahAda = RentalReschedule::where('rental_id', $data->id)
                ->where('status', 'menunggu_persetujuan')
                ->exists();

            if ($sudahAda) {
                throw ValidationException::withMessages([
                    'reschedule' => 'Masih ada permintaan perubahan jadwal yang menunggu persetujuan.',
                ]);
            }

            RentalReschedule::create([
                'rental_id' => $data->id,
                'pengaju_id' => $pengajuId,
                'role_pengaju' => 'admin',
                'tanggal_mulai_lama' => $data->tanggal_mulai,
                'tanggal_selesai_lama' => $data->tanggal_selesai,
                'tanggal_mulai_baru' => $validated['tanggal_mulai_baru'],
                'tanggal_selesai_baru' => $validated['tanggal_selesai_baru'],
                'alasan' => $validated['alasan'],
                'status' => 'menunggu_persetujuan',
            ]);
        });

        return redirect()
            ->route('admin.transaksi.show', $rental->id)
            ->with('success', 'Permintaan reschedule berhasil diajukan.');
    }

    public function setujuiReschedule(
        Request $request,
        Rental $rental,
        RentalReschedule $reschedule
    ) {
        $validated = $request->validate([
            'catatan_peninjau' => ['nullable', 'string', 'max:2000'],
        ]);

        $peninjauId = $request->user()->id;

        DB::transaction(function () use (
            $rental,
            $reschedule,
            $validated,
            $peninjauId
        ) {
            $data = Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            $permintaan = RentalReschedule::whereKey($reschedule->id)
                ->where('rental_id', $data->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($permintaan->status !== 'menunggu_persetujuan') {
                throw ValidationException::withMessages([
                    'reschedule' => 'Permintaan ini sudah ditinjau.',
                ]);
            }

            if (!in_array($data->status, ['menunggu', 'diproses', 'disewa'])) {
                throw ValidationException::withMessages([
                    'status' => 'Jadwal transaksi ini tidak bisa diubah.',
                ]);
            }

            $mulai = Carbon::parse($permintaan->tanggal_mulai_baru);
            $selesai = Carbon::parse($permintaan->tanggal_selesai_baru);
            $totalHari = (int) $mulai->diffInDays($selesai);

            $data->load('details');

            $totalHarga = 0;

            foreach ($data->details as $detail) {
                $subtotal = $detail->harga_per_hari
                    * $detail->jumlah
                    * $totalHari;

                $detail->update(['subtotal' => $subtotal]);

                $totalHarga += $subtotal;
            }

            $data->update([
                'tanggal_mulai' => $permintaan->tanggal_mulai_baru,
                'tanggal_selesai' => $permintaan->tanggal_selesai_baru,
                'total_hari' => $totalHari,
                'total_harga' => $totalHarga,
            ]);

            $permintaan->update([
                'status' => 'disetujui',
                'peninjau_id' => $peninjauId,
                'catatan_peninjau' => $validated['catatan_peninjau'] ?? null,
                'ditinjau_at' => now(),
            ]);
        });

        return back()->with('success', 'Perubahan jadwal berhasil disetujui.');
    }

    public function tolakReschedule(
        Request $request,
        Rental $rental,
        RentalReschedule $reschedule
    ) {
        $validated = $request->validate([
            'catatan_peninjau' => ['required', 'string', 'max:2000'],
        ]);

        $peninjauId = $request->user()->id;

        DB::transaction(function () use (
            $rental,
            $reschedule,
            $validated,
            $peninjauId
        ) {
            Rental::whereKey($rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            $permintaan = RentalReschedule::whereKey($reschedule->id)
                ->where('rental_id', $rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($permintaan->status !== 'menunggu_persetujuan') {
                throw ValidationException::withMessages([
                    'reschedule' => 'Permintaan ini sudah ditinjau.',
                ]);
            }

            $permintaan->update([
                'status' => 'ditolak',
                'peninjau_id' => $peninjauId,
                'catatan_peninjau' => $validated['catatan_peninjau'],
                'ditinjau_at' => now(),
            ]);
        });

        return back()->with('success', 'Permintaan perubahan jadwal ditolak.');
    }

    
public function batalkan(Request $request, Rental $rental)
{
    $request->validate([
        'alasan_pembatalan' => ['required', 'string', 'min:5', 'max:1000'],
    ], [
        'alasan_pembatalan.required' => 'Alasan pembatalan wajib diisi.',
        'alasan_pembatalan.min' => 'Alasan pembatalan minimal 5 karakter.',
    ]);

    try {
        DB::transaction(function () use ($request, $rental) {

            $rental = Rental::where('id', $rental->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($rental->status !== 'diproses') {
                throw new \Exception(
                    'Pembatalan hanya dapat dilakukan saat transaksi berstatus Diproses.'
                );
            }

            if (!$rental->stok_dikurangi) {
                throw new \Exception(
                    'Stok transaksi tidak tercatat sudah dikurangi.'
                );
            }

            $details = $rental->details()->get();

            foreach ($details as $detail) {
                $barang = \App\Models\Barang::where('id', $detail->barang_id)
                    ->lockForUpdate()
                    ->first();

                if (!$barang) {
                    throw new \Exception(
                        'Barang pada transaksi tidak ditemukan. Pembatalan dibatalkan.'
                    );
                }

                $barang->increment('stok', $detail->jumlah);
            }

            $rental->update([
                'status' => 'dibatalkan',
                'alasan_pembatalan' => $request->alasan_pembatalan,
                'pembatalan_oleh' => $request->user()->id,
                'dibatalkan_at' => now(),
                'stok_dikurangi' => false,
            ]);
        });

        return redirect()
            ->route('admin.transaksi.show', $rental->id)
            ->with('success', 'Booking berhasil dibatalkan dan stok barang telah dikembalikan.');

    } catch (\Throwable $e) {
        return back()->with('error', $e->getMessage());
    }
}
}
