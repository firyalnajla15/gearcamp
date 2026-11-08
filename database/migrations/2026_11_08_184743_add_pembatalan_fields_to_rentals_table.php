<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->text('alasan_pembatalan')->nullable();
            $table->unsignedBigInteger('pembatalan_oleh')->nullable();
            $table->timestamp('dibatalkan_at')->nullable();

            $table->foreign('pembatalan_oleh')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['pembatalan_oleh']);

            $table->dropColumn([
                'alasan_pembatalan',
                'pembatalan_oleh',
                'dibatalkan_at',
            ]);
        });
    }
};
