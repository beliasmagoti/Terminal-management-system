<?php

namespace App\Services;

use App\Interfaces\TankRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TankService
{
    public function __construct(
        protected TankRepositoryInterface $tankRepository
    ) {}

    /**
     * Get all tanks
     */
    public function getAll(): Collection
    {
        return $this->tankRepository->all();
    }

    /**
     * Get tank by ID
     */
    public function getById(string $id)
    {
        $tank = $this->tankRepository->findById($id);

        if (!$tank) {
            throw new ModelNotFoundException('Tank not found.');
        }

        return $tank;
    }

    /**
     * Create tank
     */
    public function create(array $data)
    {
        return $this->tankRepository->create([
            'terminal_id' => $data['terminal_id'],
            'name' => $data['name'],
            'code' => strtoupper($data['code']),
            'fuel_type' => $data['fuel_type'],
            'capacity_liters' => $data['capacity_liters'],
            'current_level' => $data['current_level'] ?? 0,
            'status' => $data['status'] ?? 'active',
            'temperature' => $data['temperature'] ?? null,
            'pressure' => $data['pressure'] ?? null,
            'installation_date' => $data['installation_date'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update tank
     */
    public function update(string $id, array $data)
    {
        $tank = $this->getById($id);

        return $this->tankRepository->update($tank, [
            'terminal_id' => $data['terminal_id'] ?? $tank->terminal_id,
            'name' => $data['name'] ?? $tank->name,

            'code' => isset($data['code'])
                ? strtoupper($data['code'])
                : $tank->code,

            'fuel_type' => $data['fuel_type'] ?? $tank->fuel_type,
            'capacity_liters' => $data['capacity_liters'] ?? $tank->capacity_liters,
            'current_level' => $data['current_level'] ?? $tank->current_level,
            'status' => $data['status'] ?? $tank->status,
            'temperature' => $data['temperature'] ?? $tank->temperature,
            'pressure' => $data['pressure'] ?? $tank->pressure,
            'installation_date' => $data['installation_date'] ?? $tank->installation_date,
            'notes' => $data['notes'] ?? $tank->notes,
        ]);
    }

    /**
     * Delete tank
     */
    public function delete(string $id): bool
    {
        $tank = $this->getById($id);

        return $this->tankRepository->delete($tank);
    }
}