<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('kode_rental')->unique();

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->unsignedInteger('total_hari');
            $table->decimal('total_harga', 12, 2)->default(0);

            $table->string('status')->default('menunggu');
            $table->string('status_pembayaran')->default('belum_bayar');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};