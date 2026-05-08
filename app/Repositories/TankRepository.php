<?php

namespace App\Repositories;

use App\Interfaces\TankRepositoryInterface;
use App\Models\Tank;
use Override;

class TankRepository implements TankRepositoryInterface  {
    public function all (array $filters = []) {
        $query = Tank::query()->with([
            'terminal',
            'sensors'
        ]);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
         if (isset($filters['fuel_type'])) {
            $query->where('fuel_type', $filters['fuel_type']);
        }
         if (isset($filters['terminal_id'])) {
            $query->where('terminal_id', $filters['terminal_id']);
        }
        return $query->latest()->get();
    }


    public function paginate(int $perPage = 15)
    {
        return Tank::with([
            'terminal',
            'sensors',
        ])->latest()->paginate($perPage);
    }
    
    #[Override]
    public function create(array $data)
    {
        return Tank::create($data);
    }
  
  public function findById(int $id)
  {
    return Tank::with([
        'terminal',
         'sensors',
         'readings',
         'alerts'
    ])->findOrFail($id);
  }

  #[Override]
  public function findByUuid(string $uuid)
  {
    return Tank::where('uuid', $uuid)->findOrFail();
  }

  #[Override]
  public function update(int $id, array $data)
  {
    $tank = Tank::findOrFail($id);
    $tank-> update($data);
    return $tank->fresh();
  }

   public function delete(int $id)
  {
    $tank = Tank::findOrFail($id);
    return $tank->delete();
  }

 public function updateVolume(int $id, float $volume)
        {
        $tank = Tank::findOrFail($id);
            $tank-> update([
                'current_volume'=> $volume
            ]);
    return $tank->fresh();
     
    }



    #[Override]
    public function lowLevelTanks()
    {
    return Tank::whereColumn(
        'current_volume',
        '<=',
        'critical_level'
    )->get();
    }
  
}