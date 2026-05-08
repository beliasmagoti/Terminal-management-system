<?php

namespace App\Services\TankReading;

use App\Interfaces\TankReadingRepositoryInterface as InterfacesTankReadingRepositoryInterface;
use App\Interfaces\TankRepositoryInterface;
use App\Repositories\Contracts\TankReadingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TankReadingService
{
    public function __construct(
        protected TankRepositoryInterface $tankReadingRepository
    ) {}

    /**
     * Get all readings
     */
    public function getAll(): Collection
    {
        return $this->tankReadingRepository->all();
    }

    /**
     * Get reading by ID
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
     * Create tank reading
     */
    public function create(array $data)
    {
        return $this->tankReadingRepository->create([
            'tank_id' => $data['tank_id'],
            'sensor_id' => $data['sensor_id'] ?? null,
            'fuel_level' => $data['fuel_level'],
            'volume_liters' => $data['volume_liters'],
            'temperature' => $data['temperature'] ?? null,
            'water_level' => $data['water_level'] ?? null,
            'pressure' => $data['pressure'] ?? null,
            'density' => $data['density'] ?? null,
            'reading_time' => $data['reading_time'],
            'status' => $data['status'] ?? 'normal',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update reading
     */
    public function update(string $id, array $data)
    {
        $reading = $this->getById($id);

        return $this->tankReadingRepository->update($reading, [
            'fuel_level' => $data['fuel_level'] ?? $reading->fuel_level,
            'volume_liters' => $data['volume_liters'] ?? $reading->volume_liters,
            'temperature' => $data['temperature'] ?? $reading->temperature,
            'water_level' => $data['water_level'] ?? $reading->water_level,
            'pressure' => $data['pressure'] ?? $reading->pressure,
            'density' => $data['density'] ?? $reading->density,
            'reading_time' => $data['reading_time'] ?? $reading->reading_time,
            'status' => $data['status'] ?? $reading->status,
            'notes' => $data['notes'] ?? $reading->notes,
        ]);
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