<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tamu extends Model
{
    protected $table = 'tamu';
    protected $primaryKey = 'ID_TAMU';

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'ID_TAMU',
        'NIK_TAMU',
        'NAMA_LENGKAP',
        'NO_HP',
        'ASAL_INSTANSI',
        'ALAMAT',
        'JENIS_KELAMIN',
    ];

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'ID_TAMU', 'ID_TAMU');
    }

    public function mendaftar(): HasMany
    {
        return $this->hasMany(Mendaftar::class, 'ID_TAMU', 'ID_TAMU');
    }

    public function agenda(): BelongsToMany
    {
        return $this->belongsToMany(Agenda::class, 'MENDAFTAR', 'ID_TAMU', 'ID_AGENDA');
    }
}
