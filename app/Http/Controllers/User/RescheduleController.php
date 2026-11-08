<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\RentalReschedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RescheduleController extends Controller
{
    /**
     * Penyewa menyetujui perubahan jadwal dari admin.
     */
    public function setujui(Request $request, Rental $rental, RentalReschedule $reschedule)
    {
        try {
            DB::transaction(function () use ($request, $rental, $reschedule) {

                $rental = Rental::where('id', $rental->id)
                    ->where('user_id', $request->user()->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $reschedule = RentalReschedule::where('id', $reschedule->id)
                    ->where('rental_id', $rental->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($reschedule->role_pengaju !== 'admin') {
                    throw new \Exception('Permintaan ini bukan pengajuan dari admin.');
                }

                if ($reschedule->status !== 'menunggu_persetujuan') {
                    throw new \Exception('Permintaan perubahan jadwal sudah diproses.');
                }

                if (!in_array($rental->status, ['menunggu', 'diproses', 'disewa'])) {
                    throw new \Exception('Status rental tidak memungkinkan perubahan jadwal.');
                }

                $tanggalMulai = Carbon::parse($reschedule->tanggal_mulai_baru);
                $tanggalSelesai = Carbon::parse($reschedule->tanggal_selesai_baru);

                $totalHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

                $totalHarga = 0;

                foreach ($rental->details as $detail) {
                    $subtotal = $detail->harga_per_hari
                        * $detail->jumlah
                        * $totalHari;

                    $detail->update([
                        'subtotal' => $subtotal,
                    ]);

                    $totalHarga += $subtotal;
                }

                $rental->update([
                    'tanggal_mulai' => $tanggalMulai->toDateString(),
                    'tanggal_selesai' => $tanggalSelesai->toDateString(),
                    'total_hari' => $totalHari,
                    'total_harga' => $totalHarga,
                ]);

                $reschedule->update([
                    'status' => 'disetujui',
                    'peninjau_id' => $request->user()->id,
                    'catatan_peninjau' => 'Disetujui oleh penyewa.',
                    'ditinjau_at' => now(),
                ]);
            });

            return back()->with(
                'success',
                'Perubahan jadwal berhasil disetujui. Total biaya rental telah diperbarui.'
            );

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Penyewa menolak perubahan jadwal dari admin.
     */
    public function tolak(Request $request, Rental $rental, RentalReschedule $reschedule)
    {
        $request->validate([
            'catatan_peninjau' => ['required', 'string', 'max:1000'],
        ], [
            'catatan_peninjau.required' => 'Alasan penolakan wajib diisi.',
        ]);

        try {
            DB::transaction(function () use ($request, $rental, $reschedule) {

                $rental = Rental::where('id', $rental->id)
                    ->where('user_id', $request->user()->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $reschedule = RentalReschedule::where('id', $reschedule->id)
                    ->where('rental_id', $rental->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($reschedule->role_pengaju !== 'admin') {
                    throw new \Exception('Permintaan ini bukan pengajuan dari admin.');
                }

                if ($reschedule->status !== 'menunggu_persetujuan') {
                    throw new \Exception('Permintaan perubahan jadwal sudah diproses.');
                }

                $reschedule->update([
                    'status' => 'ditolak',
                    'peninjau_id' => $request->user()->id,
                    'catatan_peninjau' => $request->catatan_peninjau,
                    'ditinjau_at' => now(),
                ]);
            });

            return back()->with(
                'success',
                'Permintaan perubahan jadwal berhasil ditolak. Jadwal lama tetap digunakan.'
            );

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}