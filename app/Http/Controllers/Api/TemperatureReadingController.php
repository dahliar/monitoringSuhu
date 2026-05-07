<?php

namespace App\Http\Controllers\Api;

use App\Models\TemperatureReading;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemperatureReadingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        abort_unless($request->user()->tokenCan('temperature:write'), 403);

        $data = $request->validate([
            'device_id' => ['required', 'integer', 'exists:devices,id'],
            'temperature' => ['required', 'numeric', 'between:-99.99,999.99'],
            'recorded_at' => ['nullable', 'date'],
            'metadata' => ['nullable', 'array'],
        ]);

        $reading = TemperatureReading::create($data);

        return response()->json([
            'message' => 'Temperature reading accepted.',
            'data' => [
                'id' => $reading->id,
                'device_id' => $reading->device_id,
                'temperature' => $reading->temperature,
                'recorded_at' => $reading->recorded_at?->toISOString(),
            ],
        ], 201);
    }
}
