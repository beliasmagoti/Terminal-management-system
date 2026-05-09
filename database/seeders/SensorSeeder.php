<?php

namespace Database\Seeders;

use App\Enums\SensorType;
use Illuminate\Database\Seeder;
use App\Models\Sensor;
use App\Models\Tank;
use Illuminate\Support\Str;

class SensorSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Tank::all() as $tank) {

            Sensor::create([
                'id' => Str::uuid(), // ✅ CRITICAL FIX

                'tank_id' => $tank->id,
                'terminal_id' => $tank->terminal_id,

                'serial_number' => 'SN-' . strtoupper(uniqid()),

                'name' => 'Sensor ' . $tank->name,

                'sensor_type' => SensorType::LEVEL->value ?? SensorType::LEVEL,

                'status' => 'active',
            ]);
        }
    }
}