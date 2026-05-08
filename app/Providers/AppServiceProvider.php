<?php

namespace App\Providers;

use App\Interfaces\AuditLogRepositoryInterface;
use App\Interfaces\FuelDeliveryRepositoryInterface;
use App\Interfaces\FuelTransferRepositoryInterface;
use App\Interfaces\MaintenanceRecordRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\SensorRepositoryInterface;
use App\Interfaces\TankRepositoryInterface;
use App\Interfaces\TerminalRepositoryInterface;
use App\Repositories\AuditLogrepository;
use App\Repositories\FuelDeliveryRepository;
use App\Repositories\FuelTransferRepository;
use App\Repositories\MaitenanceRecordRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\SensorRepository;
use App\Repositories\TankRepository;
use App\Repositories\TermanalRepository;
use App\Repositories\TerminalRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TankRepositoryInterface::class,
            TankRepository::class
            );

     $this->app->bind(
            TerminalRepository::class,
            TerminalRepositoryInterface::class
            );

        $this->app->bind(
            SensorRepository::class,
            SensorRepositoryInterface::class
            );
            

    $this->app->bind(
            NotificationRepository::class,
            NotificationRepositoryInterface::class
            );

    $this->app->bind(
            MaitenanceRecordRepository::class,
            MaintenanceRecordRepositoryInterface::class
            );


            $this->app->bind(
            FuelTransferRepository::class,
            FuelTransferRepositoryInterface::class);

            $this->app->bind(

            FuelDeliveryRepository::class,
            FuelDeliveryRepositoryInterface::class);


            $this->app->bind(
            AuditLogrepository::class,
            AuditLogRepositoryInterface::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
