<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rental_id')
                ->constrained('rentals')
                ->cascadeOnDelete();

            $table->foreignId('barang_id')
                ->constrained('barang')
                ->restrictOnDelete();

            $table->unsignedInteger('jumlah');
            $table->decimal('harga_per_hari', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_details');
    }
};