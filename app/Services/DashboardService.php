<?php

namespace App\Services;

use App\Models\Tank;
use App\Models\Sensor;
use App\Models\Alert;
use App\Models\FuelTransfer;
use App\Models\FuelDelivery;

class DashboardService
{
    public function getDashboard(): array
    {
        return [
            'statistics' => $this->statistics(),
            'fuel' => $this->fuelSummary(),
            'alerts' => $this->alerts(),
            'sensors' => $this->sensorStatus(),
            'recent_activity' => $this->recentActivity(),
        ];
    }

    private function statistics(): array
    {
        return [
            'total_tanks' => Tank::count(),
            'active_sensors' => Sensor::where('status', 'active')->count(),
            'inactive_sensors' => Sensor::where('status', 'inactive')->count(),
            'critical_alerts' => Alert::where('severity', 'critical')->count(),
        ];
    }

    private function fuelSummary(): array
    {
        $capacity = Tank::sum('capacity');
        $current = Tank::sum('current_volume');

        return [
            'total_capacity' => $capacity,
            'current_volume' => $current,
            'utilization' => $capacity > 0 ? ($current / $capacity) * 100 : 0,
        ];
    }

    private function alerts(): array
    {
        return [
            'open' => Alert::where('status', 'open')->count(),
            'critical' => Alert::where('severity', 'critical')->count(),
        ];
    }

    private function sensorStatus(): array
    {
        return [
            'active' => Sensor::where('status', 'active')->count(),
            'inactive' => Sensor::where('status', 'inactive')->count(),
        ];
    }

    private function recentActivity(): array
    {
        return [
            'transfers' => FuelTransfer::latest()->take(5)->get(),
            'deliveries' => FuelDelivery::latest()->take(5)->get(),
        ];
    }
}