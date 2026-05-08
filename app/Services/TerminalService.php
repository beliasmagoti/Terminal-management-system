<?php

namespace App\Services\Terminal;

use App\Interfaces\TerminalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TerminalService
{
    public function __construct(
        protected TerminalRepositoryInterface $terminalRepository
    ) {}

    /**
     * Get all terminals
     */
    public function getAll(): Collection
    {
        return $this->terminalRepository->all();
    }

    /**
     * Get terminal by ID
     */
    public function getById(string $id)
    {
        $terminal = $this->terminalRepository->findById($id);

        if (!$terminal) {
            throw new ModelNotFoundException('Terminal not found.');
        }

        return $terminal;
    }

    /**
     * Create terminal
     */
    public function create(array $data)
    {
        return $this->terminalRepository->create([
            'name' => $data['name'],
            'code' => strtoupper($data['code']),
            'location' => $data['location'],
            'city' => $data['city'] ?? null,
            'country' => $data['country'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'capacity' => $data['capacity'] ?? 0,
            'status' => $data['status'] ?? 'active',
            'manager_name' => $data['manager_name'] ?? null,
            'manager_phone' => $data['manager_phone'] ?? null,
        ]);
    }

    /**
     * Update terminal
     */
    public function update(string $id, array $data)
    {
        $terminal = $this->getById($id);

        return $this->terminalRepository->update($terminal, [
            'name' => $data['name'] ?? $terminal->name,

            'code' => isset($data['code'])
                ? strtoupper($data['code'])
                : $terminal->code,

            'location' => $data['location'] ?? $terminal->location,
            'city' => $data['city'] ?? $terminal->city,
            'country' => $data['country'] ?? $terminal->country,
            'latitude' => $data['latitude'] ?? $terminal->latitude,
            'longitude' => $data['longitude'] ?? $terminal->longitude,
            'capacity' => $data['capacity'] ?? $terminal->capacity,
            'status' => $data['status'] ?? $terminal->status,
            'manager_name' => $data['manager_name'] ?? $terminal->manager_name,
            'manager_phone' => $data['manager_phone'] ?? $terminal->manager_phone,
        ]);
    }

    /**
     * Delete terminal
     */
    public function delete(string $id): bool
    {
        $terminal = $this->getById($id);

        return $this->terminalRepository->delete($terminal);
    }
}