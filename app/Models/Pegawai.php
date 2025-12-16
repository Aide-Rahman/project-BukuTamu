<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_PEGAWAI',
        'ID_DIVISI',
        'NIP',
        'NAMA_PEGAWAI',
        'JABATAN',
        'EMAIL_KANTOR',
    ];

    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'ID_DIVISI', 'ID_DIVISI');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }
}
