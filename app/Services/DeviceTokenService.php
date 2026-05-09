<?php

namespace App\Services;

use App\Repositories\Contracts\DeviceTokenRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeviceTokenService
{
    public function __construct(
        protected DeviceTokenRepositoryInterface $deviceTokenRepository
    ) {}

    /**
     * Get all device tokens
     */
    public function getAll(): Collection
    {
        return $this->deviceTokenRepository->all();
    }

    /**
     * Get token by ID
     */
    public function getById(string $id)
    {
        $token = $this->deviceTokenRepository->findById($id);

        if (!$token) {
            throw new ModelNotFoundException('Device token not found.');
        }

        return $token;
    }

    /**
     * Register device token
     */
    public function create(array $data)
    {
        return $this->deviceTokenRepository->create([
            'user_id' => $data['user_id'],
            'token' => $data['token'],
            'device_type' => $data['device_type'],
            'device_name' => $data['device_name'] ?? null,
            'is_active' => $data['is_active'] ?? true,
            'last_used_at' => now(),
        ]);
    }

    /**
     * Update token
     */
    public function update(string $id, array $data)
    {
        $token = $this->getById($id);

        return $this->deviceTokenRepository->update($token, [
            'device_name' => $data['device_name'] ?? $token->device_name,
            'is_active' => $data['is_active'] ?? $token->is_active,
            'last_used_at' => now(),
        ]);
    }

    /**
     * Deactivate token
     */
    public function deactivate(string $id)
    {
        $token = $this->getById($id);

        return $this->deviceTokenRepository->update($token, [
            'is_active' => false,
        ]);
    }

    /**
     * Delete token
     */
    public function delete(string $id): bool
    {
        $token = $this->getById($id);

        return $this->deviceTokenRepository->delete($token);
    }
}