<?php

namespace App\Services\FuelTransfer;

use App\Interfaces\FuelTransferRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FuelTransferService
{
    public function __construct(
        protected FuelTransferRepositoryInterface $fuelTransferRepository
    ) {}

    /**
     * Get all transfers
     */
    public function getAll(): Collection
    {
        return $this->fuelTransferRepository->all();
    }

    /**
     * Get transfer by ID
     */
    public function getById(string $id)
    {
        $transfer = $this->fuelTransferRepository->findById($id);

        if (!$transfer) {
            throw new ModelNotFoundException(
                'Fuel transfer not found.'
            );
        }

        return $transfer;
    }

    /**
     * Create fuel transfer
     */
    public function create(array $data)
    {
        return $this->fuelTransferRepository->create([
            'source_tank_id' => $data['source_tank_id'],
            'destination_tank_id' => $data['destination_tank_id'],
            'performed_by' => $data['performed_by'],
            'volume_liters' => $data['volume_liters'],
            'fuel_type' => $data['fuel_type'],
            'transfer_date' => $data['transfer_date'],
            'status' => $data['status'] ?? 'pending',
            'reference_number' => $data['reference_number'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update fuel transfer
     */
    public function update(string $id, array $data)
    {
        $transfer = $this->getById($id);

        return $this->fuelTransferRepository->update($transfer, [
            'volume_liters' =>
                $data['volume_liters'] ?? $transfer->volume_liters,

            'fuel_type' =>
                $data['fuel_type'] ?? $transfer->fuel_type,

            'transfer_date' =>
                $data['transfer_date'] ?? $transfer->transfer_date,

            'status' =>
                $data['status'] ?? $transfer->status,

            'reference_number' =>
                $data['reference_number'] ?? $transfer->reference_number,

            'notes' =>
                $data['notes'] ?? $transfer->notes,
        ]);
    }

    /**
     * Delete transfer
     */
    public function delete(string $id): bool
    {
        $transfer = $this->getById($id);

        return $this->fuelTransferRepository->delete($transfer);
    }
}