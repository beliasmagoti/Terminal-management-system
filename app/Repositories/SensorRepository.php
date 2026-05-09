<?php

namespace App\Repositories;

use App\Interfaces\SensorRepositoryInterface;
use App\Models\Sensor;
use Carbon\Carbon;
use Override;

class SensorRepository implements SensorRepositoryInterface
{
    #[Override]
    public function all(array $filters = [])
    {
        $query = Sensor::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['tank_id'])) {
            $query->where('tank_id', $filters['tank_id']);
        }

        return $query->latest()->get();
    }

    #[Override]
    public function paginate(int $perPage = 15)
    {
        return Sensor::with('tank')
            ->latest()
            ->paginate($perPage);
    }

    #[Override]
    public function findById(int $id)
    {
        return Sensor::with('tank')
            ->find($id);
    }

    #[Override]
    public function findByUuid(string $uuid)
    {
        return Sensor::where('uuid', $uuid)
            ->first();
    }

    #[Override]
    public function create(array $data)
    {
        return Sensor::create($data);
    }

    #[Override]
    public function update(int $id, array $data)
    {
        $sensor = Sensor::findOrFail($id);

        $sensor->update($data);

        return $sensor;
    }

    #[Override]
    public function sensorsByTank(int $tankId)
    {
        return Sensor::where('tank_id', $tankId)
            ->get();
    }

    #[Override]
    public function delete(int $id)
    {
        return Sensor::where('id', $id)->delete();
    }

    /**
     * Active sensors for a tank (based on recent activity)
     */
    #[Override]
    public function activeSensors(int $tankId, float $volume)
    {
        return Sensor::where('tank_id', $tankId)
            ->where('status', 'active')
            ->where('last_seen_at', '>=', Carbon::now()->subMinutes(10))
            ->get();
    }

    /**
     * Offline sensors (no heartbeat)
     */
    #[Override]
    public function offlineSensors()
    {
        return Sensor::where('status', 'offline')
            ->orWhere('last_seen_at', '<', Carbon::now()->subMinutes(10))
            ->get();
    }
}