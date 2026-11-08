<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalReschedule extends Model
{
    protected $table = 'rental_reschedules';

    protected $fillable = [
        'rental_id',
        'pengaju_id',
        'role_pengaju',
        'peninjau_id',
        'tanggal_mulai_lama',
        'tanggal_selesai_lama',
        'tanggal_mulai_baru',
        'tanggal_selesai_baru',
        'alasan',
        'catatan_peninjau',
        'status',
        'ditinjau_at',
    ];

    protected $casts = [
        'tanggal_mulai_lama' => 'date',
        'tanggal_selesai_lama' => 'date',
        'tanggal_mulai_baru' => 'date',
        'tanggal_selesai_baru' => 'date',
        'ditinjau_at' => 'datetime',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }

    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengaju_id');
    }

    public function peninjau(): BelongsTo
    {
        return $this->belongsTo(User::class, 'peninjau_id');
    }
}
