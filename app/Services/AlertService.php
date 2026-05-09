<?php

namespace App\Services;

use App\Events\Alert\AlertCreated;
use App\Events\Alert\AlertResolved;
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
     * Create alert (REALTIME)
     */
    public function create(array $data)
    {
        $alert = $this->alertRepository->create([
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

        /**
         * 🔥 Broadcast alert created
         */
        event(new AlertCreated([
            'id' => $alert->id,
            'tank_id' => $alert->tank_id,
            'sensor_id' => $alert->sensor_id,
            'type' => $alert->type,
            'severity' => $alert->severity,
            'title' => $alert->title,
            'message' => $alert->message,
            'status' => $alert->status,
        ]));

        return $alert;
    }

    /**
     * Resolve alert (REALTIME)
     */
    public function resolve(string $id)
    {
        $alert = $this->getById($id);

        $updated = $this->alertRepository->update($alert, [
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);

        /**
         * 🔥 Broadcast resolved event
         */
        event(new AlertResolved([
            'id' => $updated->id,
            'tank_id' => $updated->tank_id,
            'sensor_id' => $updated->sensor_id,
            'title' => $updated->title,
            'severity' => $updated->severity,
            'status' => $updated->status,
            'resolved_at' => $updated->resolved_at,
        ]));

        return $updated;
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