
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('rentals', 'stok_dikurangi')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->boolean('stok_dikurangi')
                    ->default(false);
            });
        }

        if (!Schema::hasColumn('rentals', 'tanggal_diserahkan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->date('tanggal_diserahkan')->nullable();
            });
        }

        if (!Schema::hasColumn('rentals', 'tanggal_dikembalikan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->date('tanggal_dikembalikan')->nullable();
            });
        }

        if (!Schema::hasColumn('rentals', 'total_hari_tambahan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->unsignedInteger('total_hari_tambahan')->default(0);
            });
        }

        if (!Schema::hasColumn('rentals', 'biaya_tambahan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->decimal('biaya_tambahan', 12, 2)->default(0);
            });
        }

        if (!Schema::hasColumn('rentals', 'status_pembayaran_tambahan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->string('status_pembayaran_tambahan')
                    ->default('tidak_ada');
            });
        }

        if (!Schema::hasColumn('rentals', 'alasan_penolakan')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->text('alasan_penolakan')->nullable();
            });
        }
    }

    public function down(): void
    {
        $columns = [
            'stok_dikurangi',
            'tanggal_diserahkan',
            'tanggal_dikembalikan',
            'total_hari_tambahan',
            'biaya_tambahan',
            'status_pembayaran_tambahan',
            'alasan_penolakan',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('rentals', $column)) {
                Schema::table('rentals', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
