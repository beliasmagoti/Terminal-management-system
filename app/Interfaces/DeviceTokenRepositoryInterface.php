<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DeviceTokenRepositoryInterface
{
    /**
     * Get all device tokens
     */
    public function all(): Collection;

    /**
     * Find token by ID
     */
    public function findById(string $id);

    /**
     * Create device token
     */
    public function create(array $data);

    /**
     * Update device token
     */
    public function update($model, array $data);

    /**
     * Delete device token
     */
    public function delete($model): bool;

    /**
     * Find tokens by user
     */
    public function findByUserId(string $userId): Collection;

    /**
     * Find active tokens
     */
    public function findActiveTokens(): Collection;

    /**
     * Find token by value
     */
    public function findByToken(string $token);
}