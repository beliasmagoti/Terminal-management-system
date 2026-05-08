<?php

namespace App\Repositories;

use App\Interfaces\TankReadingRepositoryInterface;
use Override;

class TankReadingRepository implements TankReadingRepositoryInterface {
    #[Override]
    public function latestReadings()
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function latestTankReadings(int $tankId)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function readingsByTank(int $tankId, int $limit = 100)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function redingsBetweenDates(int $tankId, string $starDate, string $endDate)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function averageConsumption(int $tankId, string $starDate, string $endDate)
    {
        throw new \Exception('Not implemented');
    }
    
}