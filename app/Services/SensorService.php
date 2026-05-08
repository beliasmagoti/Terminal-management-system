<?php

namespace App\Services\Sensor;

use App\Interfaces\SensorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SensorService
{
    public function __construct(
       protected SensorRepositoryInterface $sensorRepository
    ) {}

    /**
     * Get all sensors
     */
    public function getAll(): Collection
    {
        return $this->sensorRepository->all();
    }

    /**
     * Get sensor by ID
     */
    public function getById(string $id)
    {
        $sensor = $this->sensorRepository->findById($id);

        if (!$sensor) {
            throw new ModelNotFoundException('Sensor not found.');
        }

        return $sensor;
    }

    /**
     * Create sensor
     */
    public function create(array $data)
    {
        return $this->sensorRepository->create([
            'tank_id' => $data['tank_id'],
            'name' => $data['name'],
            'serial_number' => strtoupper($data['serial_number']),
            'type' => $data['type'],
            'manufacturer' => $data['manufacturer'] ?? null,
            'model' => $data['model'] ?? null,
            'installation_date' => $data['installation_date'] ?? null,
            'last_calibrated_at' => $data['last_calibrated_at'] ?? null,
            'firmware_version' => $data['firmware_version'] ?? null,
            'ip_address' => $data['ip_address'] ?? null,
            'status' => $data['status'] ?? 'active',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update sensor
     */
    public function update(string $id, array $data)
    {
        $sensor = $this->getById($id);

        return $this->sensorRepository->update($sensor, [
            'tank_id' => $data['tank_id'] ?? $sensor->tank_id,
            'name' => $data['name'] ?? $sensor->name,

            'serial_number' => isset($data['serial_number'])
                ? strtoupper($data['serial_number'])
                : $sensor->serial_number,

            'type' => $data['type'] ?? $sensor->type,
            'manufacturer' => $data['manufacturer'] ?? $sensor->manufacturer,
            'model' => $data['model'] ?? $sensor->model,
            'installation_date' => $data['installation_date'] ?? $sensor->installation_date,
            'last_calibrated_at' => $data['last_calibrated_at'] ?? $sensor->last_calibrated_at,
            'firmware_version' => $data['firmware_version'] ?? $sensor->firmware_version,
            'ip_address' => $data['ip_address'] ?? $sensor->ip_address,
            'status' => $data['status'] ?? $sensor->status,
            'notes' => $data['notes'] ?? $sensor->notes,
        ]);
    }

    /**
     * Delete sensor
     */
    public function delete(string $id): bool
    {
        $sensor = $this->getById($id);

        return $this->sensorRepository->delete($sensor);
    }
}