<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'ID_KUNJUNGAN';

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_KUNJUNGAN',
        'ID_PEGAWAI',
        'ID_TAMU',
        'NO_TIKET',
        'WAKTU_CHECKIN',
        'WAKTU_CHEKOUT',
        'KEPERLUAN',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }

    public function tamu(): BelongsTo
    {
        return $this->belongsTo(Tamu::class, 'ID_TAMU', 'ID_TAMU');
    }
}
