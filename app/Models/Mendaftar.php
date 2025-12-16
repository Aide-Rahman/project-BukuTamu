<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mendaftar extends Model
{
    protected $table = 'MENDAFTAR';

    /**
     * Composite primary key: (ID_AGENDA, ID_TAMU)
     * Eloquent tidak native mendukung PK komposit.
     */
    protected $primaryKey = ['ID_AGENDA', 'ID_TAMU'];

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'ID_AGENDA',
        'ID_TAMU',
    ];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class, 'ID_AGENDA', 'ID_AGENDA');
    }

    public function tamu(): BelongsTo
    {
        return $this->belongsTo(Tamu::class, 'ID_TAMU', 'ID_TAMU');
    }

    public function getKeyName(): array
    {
        return $this->primaryKey;
    }

    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $keyField) {
            $query->where($keyField, '=', $this->getAttribute($keyField));
        }

        return $query;
    }
}
