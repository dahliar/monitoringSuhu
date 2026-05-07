<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\Room;
use App\Models\TemperatureReading;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TemperatureReadingFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_accepts_temperature_reading_with_valid_token(): void
    {
        $user = $this->user();
        $device = $this->device(min: 45, max: 80);

        Sanctum::actingAs($user, ['temperature:write']);

        $response = $this->postJson('/api/temperature-readings', [
            'device_id' => $device->id,
            'temperature' => 60,
            'recorded_at' => '2026-05-07 10:30:00',
            'metadata' => ['source' => 'feature-test'],
        ]);

        $response->assertCreated()
            ->assertJsonPath('message', 'Temperature reading accepted.')
            ->assertJsonPath('data.device_id', $device->id)
            ->assertJsonPath('data.temperature', '60.00');

        $this->assertDatabaseHas('temperature_readings', [
            'device_id' => $device->id,
            'temperature' => 60,
        ]);
    }

    public function test_api_rejects_temperature_reading_without_token(): void
    {
        $device = $this->device();

        $this->postJson('/api/temperature-readings', [
            'device_id' => $device->id,
            'temperature' => 25,
        ])->assertUnauthorized();
    }

    public function test_api_rejects_token_without_temperature_write_ability(): void
    {
        $user = $this->user();
        $device = $this->device();

        Sanctum::actingAs($user, ['temperature:read']);

        $this->postJson('/api/temperature-readings', [
            'device_id' => $device->id,
            'temperature' => 25,
        ])->assertForbidden();
    }

    public function test_api_rejects_invalid_payload(): void
    {
        $user = $this->user();

        Sanctum::actingAs($user, ['temperature:write']);

        $this->postJson('/api/temperature-readings', [
            'device_id' => 999,
            'temperature' => 1000,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['device_id', 'temperature']);
    }

    public function test_temperature_status_is_safe_inside_device_range(): void
    {
        $device = $this->device(min: 20, max: 30);

        $reading = TemperatureReading::create([
            'device_id' => $device->id,
            'temperature' => 25,
            'recorded_at' => now(),
        ]);

        $this->assertSame('Aman', $reading->fresh(['device'])->temperature_status);
    }

    public function test_temperature_status_is_danger_outside_device_range(): void
    {
        $device = $this->device(min: 20, max: 30);

        $reading = TemperatureReading::create([
            'device_id' => $device->id,
            'temperature' => 35,
            'recorded_at' => now(),
        ]);

        $this->assertSame('Bahaya', $reading->fresh(['device'])->temperature_status);
    }

    public function test_authenticated_user_can_view_temperature_readings_datatable(): void
    {
        $user = $this->user();
        $device = $this->device(min: 20, max: 30);

        TemperatureReading::create([
            'device_id' => $device->id,
            'temperature' => 25,
            'recorded_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->getJson('/temperature-readings?draw=1&start=0&length=10');

        $response->assertOk()
            ->assertJsonPath('recordsTotal', 1)
            ->assertJsonFragment(['device_name' => $device->nama])
            ->assertSee('Aman', false);
    }

    public function test_guest_cannot_view_temperature_readings_page(): void
    {
        $this->get('/temperature-readings')
            ->assertRedirect('/login');
    }

    private function user(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'role' => 'admin',
            'is_active' => true,
        ], $attributes));
    }

    private function device(float $min = 20, float $max = 30): Device
    {
        $room = Room::create([
            'name' => 'Ruang Test',
            'type' => 3,
            'descriptions' => 'Room for feature tests',
            'is_active' => true,
        ]);

        return Device::create([
            'nama' => 'Sensor Test',
            'jenis' => 'Thermometer',
            'idRoom' => $room->id,
            'lokasi' => 'Area Test',
            'minTemperature' => $min,
            'maxTemperature' => $max,
            'is_active' => true,
        ]);
    }
}
