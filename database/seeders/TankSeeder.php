<?php

namespace Database\Seeders;

use App\Enums\FuelType;
use App\Enums\TankStatus;
use Illuminate\Database\Seeder;
use App\Models\Tank;
use App\Models\Terminal;

class TankSeeder extends Seeder
{
    public function run(): void
    {
        $terminal = Terminal::first();

        Tank::create([
            'terminal_id' => $terminal->id,
            'name' => 'Tank A1',
            'tank_number' => 12,
            'capacity_liters' => 20000,
             'safe_level' => 18000,
             'critical_level' => 1000,

            'fuel_type' => FuelType::AGO,
            'status' => TankStatus::ACTIVE,
        ]);

        Tank::create([
            'terminal_id' => $terminal->id,

             'critical_level' => 1000,

            'name' => 'Tank A2',
            'safe_level' => 14000,
            'tank_number' => 22,

            'capacity_liters' => 15000,
            'fuel_type' => FuelType::AGO,
            'status' => TankStatus::ACTIVE,
        ]);
    }
}