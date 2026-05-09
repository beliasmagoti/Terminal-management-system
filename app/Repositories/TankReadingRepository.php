<?php

namespace App\Repositories;

use App\Interfaces\TankReadingRepositoryInterface;
use App\Models\TankReading;
use Carbon\Carbon;
use Override;

class TankReadingRepository implements TankReadingRepositoryInterface
{
    #[Override]
public function latestReadings(int $limit = 50)
{
    return TankReading::with('tank')
        ->latest()
        ->take($limit)
        ->get();
}

    #[Override]
    public function latestTankReadings(int $tankId)
    {
        return TankReading::where('tank_id', $tankId)
            ->latest()
            ->take(20)
            ->get();
    }

    #[Override]
    public function readingsByTank(int $tankId, int $limit = 100)
    {
        return TankReading::where('tank_id', $tankId)
            ->latest()
            ->take($limit)
            ->get();
    }

    #[Override]
    public function readingsBetweenDates(int $tankId, string $startDate, string $endDate)
    {
        return TankReading::where('tank_id', $tankId)
            ->whereBetween('created_at', [
                Carbon::parse($startDate),
                Carbon::parse($endDate),
            ])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    #[Override]
    public function averageConsumption(int $tankId, string $startDate, string $endDate)
    {
        return TankReading::where('tank_id', $tankId)
            ->whereBetween('created_at', [
                Carbon::parse($startDate),
                Carbon::parse($endDate),
            ])
            ->avg('volume_liters');
    }

    /**
     * CREATE READING (used by service)
     */
    public function create(array $data)
    {
        return TankReading::create($data);
    }

    /**
     * FIND BY ID
     */
    public function findById(string $id)
    {
        return TankReading::find($id);
    }

    /**
     * DELETE
     */
    public function delete($model): bool
    {
        return $model->delete();
    }

    /**
     * UPDATE
     */
    public function update($model, array $data)
    {
        $model->update($data);

        return $model;
    }
}