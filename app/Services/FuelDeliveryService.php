<?php

namespace App\Services\FuelDelivery;

use App\Interfaces\FuelDeliveryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FuelDeliveryService
{
    public function __construct(
        protected FuelDeliveryRepositoryInterface $fuelDeliveryRepository
    ) {}

    /**
     * Get all deliveries
     */
    public function getAll(): Collection
    {
        return $this->fuelDeliveryRepository->all();
    }

    /**
     * Get delivery by ID
     */
    public function getById(string $id)
    {
        $delivery = $this->fuelDeliveryRepository->findById($id);

        if (!$delivery) {
            throw new ModelNotFoundException(
                'Fuel delivery not found.'
            );
        }

        return $delivery;
    }

    /**
     * Create fuel delivery
     */
    public function create(array $data)
    {
        return $this->fuelDeliveryRepository->create([
            'tank_id' => $data['tank_id'],
            'supplier_id' => $data['supplier_id'] ?? null,
            'received_by' => $data['received_by'],
            'fuel_type' => $data['fuel_type'],
            'volume_liters' => $data['volume_liters'],
            'delivery_date' => $data['delivery_date'],
            'reference_number' => $data['reference_number'] ?? null,
            'truck_number' => $data['truck_number'] ?? null,
            'driver_name' => $data['driver_name'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'density' => $data['density'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Update fuel delivery
     */
    public function update(string $id, array $data)
    {
        $delivery = $this->getById($id);

        return $this->fuelDeliveryRepository->update($delivery, [
            'fuel_type' =>
                $data['fuel_type'] ?? $delivery->fuel_type,

            'volume_liters' =>
                $data['volume_liters'] ?? $delivery->volume_liters,

            'delivery_date' =>
                $data['delivery_date'] ?? $delivery->delivery_date,

            'reference_number' =>
                $data['reference_number'] ?? $delivery->reference_number,

            'truck_number' =>
                $data['truck_number'] ?? $delivery->truck_number,

            'driver_name' =>
                $data['driver_name'] ?? $delivery->driver_name,

            'temperature' =>
                $data['temperature'] ?? $delivery->temperature,

            'density' =>
                $data['density'] ?? $delivery->density,

            'status' =>
                $data['status'] ?? $delivery->status,

            'notes' =>
                $data['notes'] ?? $delivery->notes,
        ]);
    }

    /**
     * Delete delivery
     */
    public function delete(string $id): bool
    {
        $delivery = $this->getById($id);

        return $this->fuelDeliveryRepository->delete($delivery);
    }
}