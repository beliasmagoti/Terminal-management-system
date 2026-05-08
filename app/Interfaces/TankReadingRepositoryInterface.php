<?php

namespace App\Interfaces;

interface TankReadingRepositoryInterface

{
    public function latestReadings();
    public function readingsByTank(
        int $tankId,
        int $limit = 100
    );

    public function latestTankReadings(int $tankId);

    public function redingsBetweenDates(
        int $tankId,
        string $starDate,
        string $endDate,

        
    );
    public function averageConsumption(
        int $tankId,
        string $starDate,
        string $endDate
        
    );
   

}