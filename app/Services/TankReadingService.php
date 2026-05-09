<?php

namespace App\Services;

use App\Events\Tank\TankCriticalLevelReached;
use App\Events\Tank\TankLevelUpdated;
use App\Events\Tank\TankLowLevelReached;
use App\Interfaces\TankReadingRepositoryInterface;
use App\Interfaces\TankRepositoryInterface;
use App\Models\Sensor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TankReadingService
{
    public function __construct(
        protected TankReadingRepositoryInterface $tankReadingRepository,
        protected TankRepositoryInterface $tankRepository
    ) {}

    /**
     * Get all readings
     */
    public function getAll(): Collection
    {
 return $this->tankReadingRepository->latestReadings();    }

    /**
     * Get single reading
     */
    public function getById(string $id)
    {
        $reading = $this->tankReadingRepository->findById($id);

        if (!$reading) {
            throw new ModelNotFoundException('Tank reading not found.');
        }

        return $reading;
    }

    /**
     * MAIN BUSINESS LOGIC (EVENT DRIVEN CORE)
     */

    public function create(array $data)
{
    // 1. Get tank
    $tank = $this->tankRepository->findById($data['tank_id']);
  $sensor = $tank->sensors()->first();
    if (!$tank) {
        throw new ModelNotFoundException('Tank not found.');
    }

    // 2. Get sensor (CRITICAL FIX)
      

    if (!$sensor) {
        throw new ModelNotFoundException('Sensor not found for this tank.');
    }

    // 3. Save reading
    $reading = $this->tankReadingRepository->create([
        'tank_id' => $tank->id,
        'terminal_id' => $tank->terminal_id,
        'sensor_id' => $sensor->id,
        'fuel_level' => $data['fuel_level'],
        'volume_liters' => $data['volume_liters'],
        'temperature' => $data['temperature'] ?? null,
        'water_level' => $data['water_level'] ?? null,
        'pressure' => $data['pressure'] ?? null,
        'density' => $data['density'] ?? null,
        'reading_time' => $data['reading_time'] ?? now(),
        'status' => 'processed',
        'notes' => $data['notes'] ?? null,
    ]);

    // 4. Update tank state
    $tank->update([
        'current_volume' => $data['volume_liters']
    ]);

    // 5. Percentage calculation
    $percentage = $tank->capacity > 0
        ? ($data['volume_liters'] / $tank->capacity) * 100
        : 0;

    // 6. MAIN EVENT
    event(new TankLevelUpdated([
        'tank_id' => $tank->id,
        'name' => $tank->name,
        'current_volume' => $data['volume_liters'],
        'percentage' => round($percentage, 2),
    ]));

    // 7. LOW ALERT
    if ($percentage <= 20 && $percentage > 10) {
        event(new TankLowLevelReached([
            'tank_id' => $tank->id,
            'name' => $tank->name,
            'percentage' => round($percentage, 2),
        ]));
    }

    // 8. CRITICAL ALERT
    if ($percentage <= 10) {
        event(new TankCriticalLevelReached([
            'tank_id' => $tank->id,
            'name' => $tank->name,
            'percentage' => round($percentage, 2),
        ]));
    }

    return $reading;
}
    /**
     * Update reading
     */
    public function update(string $id, array $data)
    {
        $reading = $this->getById($id);

        return $this->tankReadingRepository->update($reading, $data);
    }

    /**
     * Delete reading
     */
    public function delete(string $id): bool
    {
        $reading = $this->getById($id);

        return $this->tankReadingRepository->delete($reading);
    }
}