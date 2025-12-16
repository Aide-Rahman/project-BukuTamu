<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'ID_AGENDA';

    public $timestamps = false;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_AGENDA',
        'TEMA_AGENDA',
        'TANGGAL',
        'LOKASI',
    ];

    public function mendaftar(): HasMany
    {
        return $this->hasMany(Mendaftar::class, 'ID_AGENDA', 'ID_AGENDA');
    }

    public function tamu(): BelongsToMany
    {
        return $this->belongsToMany(Tamu::class, 'MENDAFTAR', 'ID_AGENDA', 'ID_TAMU');
    }
}
