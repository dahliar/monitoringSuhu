<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'nama',
        'jenis',
        'idRoom',
        'lokasi',
        'maxTemperature',
        'minTemperature',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'maxTemperature' => 'decimal:2',
            'minTemperature' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'idRoom');
    }
}
