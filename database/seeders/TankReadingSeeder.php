<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tank;
use App\Models\TankReading;

class TankReadingSeeder extends Seeder
{
    public function run(): void
{
    foreach (Tank::all() as $tank) {
        // Find the sensor linked to this tank
        $sensor = \App\Models\Sensor::where('tank_id', $tank->id)->first();

        if ($sensor) {
            TankReading::create([
                'tank_id' => $tank->id,
                'sensor_id' => $sensor->id, // Get ID from the sensor record
                'terminal_id' => $tank->terminal_id,
                'name' => $tank->name,
                // Add the other missing fields required by your migration:
                'fuel_level_liters' => rand(1000, 20000),
                'water_level' => '0',
                'current_volume' => rand(1000, 20000),
                'fuel_level_percent' => rand(20, 95),
                'temperature_celcius' => rand(25, 35),
                'pressure_kpa' => rand(100, 110),
                'density' => 0.84,
                'recorded_at' => now(),
                'reading_time' => now(),
                'status' => 'normal',
            ]);
        }
    }
}


}