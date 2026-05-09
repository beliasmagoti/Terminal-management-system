<?php

namespace App\Services\Sensor;

use App\Events\Sensor\SensorActive;
use App\Events\Sensor\SensorInactive;
use App\Events\Sensor\SensorReadingUpdated;
use App\Interfaces\SensorRepositoryInterface;
use App\Interfaces\TankRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SensorService
{
    public function __construct(
        protected SensorRepositoryInterface $sensorRepository,
        protected TankRepositoryInterface $tankRepository
    ) {}

    // =========================
    // CRUD METHODS (Controller needs these)
    // =========================

    public function getAll(array $filters = []): Collection
    {
        return $this->sensorRepository->all($filters);
    }

    public function getById(int $id)
    {
        $sensor = $this->sensorRepository->findById($id);

        if (!$sensor) {
            throw new ModelNotFoundException('Sensor not found');
        }

        return $sensor;
    }

    public function create(array $data)
    {
        return $this->sensorRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->sensorRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->sensorRepository->delete($id);
    }

    // =========================
    // IoT / REALTIME METHODS
    // =========================

    /**
     * Handle sensor live data (heartbeat + reading)
     */
    public function handleSensorData(array $data)
    {
        $sensor = $this->getById($data['sensor_id']);

        // Activate sensor
        $this->sensorRepository->update($sensor->id, [
            'status' => 'active',
            'last_seen_at' => now(),
        ]);

        event(new SensorActive([
            'id' => $sensor->id,
            'tank_id' => $sensor->tank_id,
        ]));

        // Update tank
        $this->tankRepository->update($sensor->tank_id, [
            'current_volume' => $data['volume_liters'],
        ]);

        // Fire reading event
        event(new SensorReadingUpdated([
            'sensor_id' => $sensor->id,
            'tank_id' => $sensor->tank_id,
            'fuel_level' => $data['fuel_level'],
            'volume_liters' => $data['volume_liters'],
            'temperature' => $data['temperature'] ?? null,
            'timestamp' => now()->toDateTimeString(),
        ]));

        return $data;
    }

    /**
     * Mark sensor inactive
     */
    public function markSensorInactive(int $sensorId)
    {
        $sensor = $this->getById($sensorId);

        $this->sensorRepository->update($sensor->id, [
            'status' => 'inactive',
        ]);

        event(new SensorInactive([
            'id' => $sensor->id,
            'tank_id' => $sensor->tank_id,
            'last_seen_at' => $sensor->last_seen_at,
        ]));

        return $sensor;
    }
}