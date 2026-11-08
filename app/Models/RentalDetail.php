<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalDetail extends Model
{
    protected $table = 'rental_details';

    protected $fillable = [
        'rental_id',
        'barang_id',
        'jumlah',
        'harga_per_hari',
        'subtotal',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
