<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_reschedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rental_id')
                ->constrained('rentals')
                ->cascadeOnDelete();

            // Pihak yang mengajukan perubahan
            $table->foreignId('pengaju_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('role_pengaju');

            // Pihak yang memeriksa dan menyetujui
            $table->foreignId('peninjau_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Jadwal sebelum perubahan
            $table->date('tanggal_mulai_lama');
            $table->date('tanggal_selesai_lama');

            // Jadwal yang diajukan
            $table->date('tanggal_mulai_baru');
            $table->date('tanggal_selesai_baru');

            $table->text('alasan');
            $table->text('catatan_peninjau')->nullable();

            // menunggu_persetujuan, disetujui, ditolak, dibatalkan
            $table->string('status')->default('menunggu_persetujuan');

            $table->timestamp('ditinjau_at')->nullable();

            $table->timestamps();

            $table->index(['rental_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_reschedules');
    }
};
