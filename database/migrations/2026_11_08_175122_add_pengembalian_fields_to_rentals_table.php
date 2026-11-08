<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->text('alasan_penolakan')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->unsignedInteger('total_hari_tambahan')->default(0);
            $table->decimal('biaya_tambahan', 12, 2)->default(0);
            $table->boolean('stok_dikurangi')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn([
                'alasan_penolakan',
                'tanggal_dikembalikan',
                'total_hari_tambahan',
                'biaya_tambahan',
                'stok_dikurangi',
            ]);
        });
    }
};