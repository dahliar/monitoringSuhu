<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureReading extends Model
{
    protected $fillable = [
        'device_id',
        'temperature',
        'recorded_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'temperature' => 'decimal:2',
            'recorded_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function getTemperatureStatusAttribute(): string
    {
        if (! $this->device) {
            return 'Bahaya';
        }

        $temperature = (float) $this->temperature;
        $minimum = (float) $this->device->minTemperature;
        $maximum = (float) $this->device->maxTemperature;

        return $temperature >= $minimum && $temperature <= $maximum ? 'Aman' : 'Bahaya';
    }

    public function getTemperatureStatusClassAttribute(): string
    {
        return $this->temperature_status === 'Aman'
            ? 'bg-emerald-100 text-emerald-800'
            : 'bg-red-100 text-red-800';
    }
}
