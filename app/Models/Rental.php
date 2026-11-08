<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends Model
{
    protected $table = 'rentals';

    protected $fillable = [
        'user_id',
        'kode_rental',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_hari',
        'total_harga',
        'status',
        'status_pembayaran',
        'catatan',
        'alasan_penolakan',
        'tanggal_dikembalikan',
        'total_hari_tambahan',
        'biaya_tambahan',
        'stok_dikurangi',
        'tanggal_diserahkan',
        'status_pembayaran_tambahan',
        'alasan_pembatalan',
        'pembatalan_oleh',
        'dibatalkan_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_dikembalikan' => 'date',
        'tanggal_diserahkan' => 'date',
        'dibatalkan_at' => 'datetime',
        'total_hari' => 'integer',
        'total_hari_tambahan' => 'integer',
        'total_harga' => 'decimal:2',
        'biaya_tambahan' => 'decimal:2',
        'stok_dikurangi' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(RentalDetail::class, 'rental_id');
    }

    public function reschedules(): HasMany
    {
        return $this->hasMany(RentalReschedule::class, 'rental_id');
    }

    public function pembatalOleh(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembatalan_oleh');
    }
}
