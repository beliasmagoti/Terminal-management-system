<?php

namespace App\Services\MaintenanceRecord;

use App\Interfaces\MaintenanceRecordRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MaintenanceRecordService
{
    public function __construct(
        protected MaintenanceRecordRepositoryInterface $maintenanceRecordRepository
    ) {}

    /**
     * Get all maintenance records
     */
    public function getAll(): Collection
    {
        return $this->maintenanceRecordRepository->all();
    }

    /**
     * Get maintenance record by ID
     */
    public function getById(string $id)
    {
        $record = $this->maintenanceRecordRepository->findById($id);

        if (!$record) {
            throw new ModelNotFoundException(
                'Maintenance record not found.'
            );
        }

        return $record;
    }

    /**
     * Create maintenance record
     */
    public function create(array $data)
    {
        return $this->maintenanceRecordRepository->create([
            'tank_id' => $data['tank_id'] ?? null,
            'sensor_id' => $data['sensor_id'] ?? null,
            'performed_by' => $data['performed_by'],
            'title' => $data['title'],
            'description' => $data['description'],
            'maintenance_type' => $data['maintenance_type'],
            'status' => $data['status'] ?? 'pending',
            'scheduled_at' => $data['scheduled_at'] ?? null,
            'started_at' => $data['started_at'] ?? null,
            'completed_at' => $data['completed_at'] ?? null,
            'cost' => $data['cost'] ?? 0,
            'vendor_name' => $data['vendor_name'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update maintenance record
     */
    public function update(string $id, array $data)
    {
        $record = $this->getById($id);

        return $this->maintenanceRecordRepository->update($record, [
            'title' => $data['title'] ?? $record->title,
            'description' => $data['description'] ?? $record->description,
            'maintenance_type' => $data['maintenance_type'] ?? $record->maintenance_type,
            'status' => $data['status'] ?? $record->status,
            'scheduled_at' => $data['scheduled_at'] ?? $record->scheduled_at,
            'started_at' => $data['started_at'] ?? $record->started_at,
            'completed_at' => $data['completed_at'] ?? $record->completed_at,
            'cost' => $data['cost'] ?? $record->cost,
            'vendor_name' => $data['vendor_name'] ?? $record->vendor_name,
            'notes' => $data['notes'] ?? $record->notes,
        ]);
    }

    /**
     * Delete maintenance record
     */
    public function delete(string $id): bool
    {
        $record = $this->getById($id);

        return $this->maintenanceRecordRepository->delete($record);
    }
}