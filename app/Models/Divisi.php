<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'ID_DIVISI';

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_DIVISI',
        'NAMA_DIVISI',
        'LOKASI_LANTAI',
    ];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'ID_DIVISI', 'ID_DIVISI');
    }
}
