<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public const TYPES = [
        1 => 'Suhu Panas',
        2 => 'Suhu Dingin',
        3 => 'Suhu Ruangan',
    ];

    protected $fillable = [
        'name',
        'type',
        'descriptions',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'type' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? 'Suhu Ruangan';
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'idRoom');
    }
}
