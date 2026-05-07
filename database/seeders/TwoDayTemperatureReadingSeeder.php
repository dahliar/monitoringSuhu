<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\TemperatureReading;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TwoDayTemperatureReadingSeeder extends Seeder
{
    private const SAMPLE_SEED = 'two_day_temperature_sample';

    public function run(): void
    {
        $devices = Device::query()
            ->orderBy('id')
            ->get();

        if ($devices->isEmpty()) {
            $this->command?->warn('Tidak ada device. Sample suhu tidak dibuat.');

            return;
        }

        TemperatureReading::query()
            ->where('metadata->sample_seed', self::SAMPLE_SEED)
            ->delete();

        $endAt = $this->floorToFiveMinutes(now());
        $startAt = $endAt->copy()->subDays(2);
        $rows = [];
        $createdAt = now();

        foreach ($devices as $deviceIndex => $device) {
            $minimum = (float) $device->minTemperature;
            $maximum = (float) $device->maxTemperature;
            $midpoint = ($minimum + $maximum) / 2;
            $amplitude = max(($maximum - $minimum) / 3, 0.8);
            $cursor = $startAt->copy();
            $slot = 0;

            while ($cursor->lte($endAt)) {
                $dailyWave = sin((2 * pi() * ($slot % 288)) / 288);
                $shortWave = sin((2 * pi() * ($slot % 36)) / 36) * 0.35;
                $deviceOffset = ($deviceIndex - 1.5) * 0.2;
                $jitter = (($slot * 17 + $device->id * 13) % 11 - 5) / 20;
                $temperature = round($midpoint + ($dailyWave * $amplitude) + $shortWave + $deviceOffset + $jitter, 2);

                $rows[] = [
                    'device_id' => $device->id,
                    'temperature' => $temperature,
                    'recorded_at' => $cursor->copy(),
                    'metadata' => json_encode([
                        'sample_seed' => self::SAMPLE_SEED,
                        'interval_minutes' => 5,
                    ]),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];

                if (count($rows) >= 500) {
                    TemperatureReading::query()->insert($rows);
                    $rows = [];
                }

                $slot++;
                $cursor->addMinutes(5);
            }
        }

        if ($rows !== []) {
            TemperatureReading::query()->insert($rows);
        }

        $this->command?->info('Sample suhu 2 hari terakhir berhasil dibuat untuk '.$devices->count().' device.');
    }

    private function floorToFiveMinutes(Carbon $dateTime): Carbon
    {
        return $dateTime->copy()
            ->second(0)
            ->microsecond(0)
            ->minute((int) (floor($dateTime->minute / 5) * 5));
    }
}
