<?php

namespace App\Interfaces;

interface TankReadingRepositoryInterface
{
    /**
     * Get latest readings from all tanks
     */
public function latestReadings(int $limit = 50);
    /**
     * Get latest readings for a specific tank
     */
    public function latestTankReadings(int $tankId);

    /**
     * Get readings for a specific tank with limit
     */
    public function readingsByTank(int $tankId, int $limit = 100);

    /**
     * Get readings between two dates for a tank
     */
    public function readingsBetweenDates(
        int $tankId,
        string $startDate,
        string $endDate
    );

    /**
     * Get average consumption for tank in date range
     */
    public function averageConsumption(
        int $tankId,
        string $startDate,
        string $endDate
    );

    /**
     * Create new tank reading
     */
    public function create(array $data);

    /**
     * Find reading by ID
     */
    public function findById(string $id);

    /**
     * Update reading
     */
    public function update($model, array $data);

    /**
     * Delete reading
     */
    public function delete($model);
}