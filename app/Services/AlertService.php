<?php

namespace App\Services\Alert;

use App\Interfaces\AlertRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlertService
{
    public function __construct(
        protected AlertRepositoryInterface $alertRepository
    ) {}

    /**
     * Get all alerts
     */
    public function getAll(): Collection
    {
        return $this->alertRepository->all();
    }

    /**
     * Get alert by ID
     */
    public function getById(string $id)
    {
        $alert = $this->alertRepository->findById($id);

        if (!$alert) {
            throw new ModelNotFoundException('Alert not found.');
        }

        return $alert;
    }

    /**
     * Create alert
     */
    public function create(array $data)
    {
        return $this->alertRepository->create([
            'tank_id' => $data['tank_id'] ?? null,
            'sensor_id' => $data['sensor_id'] ?? null,
            'type' => $data['type'],
            'severity' => $data['severity'],
            'title' => $data['title'],
            'message' => $data['message'],
            'status' => $data['status'] ?? 'active',
            'resolved_at' => $data['resolved_at'] ?? null,
            'metadata' => $data['metadata'] ?? null,
        ]);
    }

    /**
     * Resolve alert
     */
    public function resolve(string $id)
    {
        $alert = $this->getById($id);

        return $this->alertRepository->update($alert, [
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);
    }

    /**
     * Ignore alert
     */
    public function ignore(string $id)
    {
        $alert = $this->getById($id);

        return $this->alertRepository->update($alert, [
            'status' => 'ignored',
        ]);
    }

    /**
     * Delete alert
     */
    public function delete(string $id): bool
    {
        $alert = $this->getById($id);

        return $this->alertRepository->delete($alert);
    }
}