<?php

namespace App\Repositories;

use App\Interfaces\TerminalRepositoryInterface;
use App\Models\Terminal;
use Override;

class TerminalRepository implements TerminalRepositoryInterface {

#[Override]
	public function all(array $filters = [])
    {
        $query = Terminal::query()->withCount('tanks');


        if (isset($filters['status'])) {
            $query->where (
                'status',
                $filters['status']
            );
        }
        return $query->latest()->get();
    }

    #[Override]
    public function paginate(int $perPage = 15)
    {
        return Terminal::withCount('tanks')->latest()->paginate($perPage);
    }

    #[Override]
    public function findById(int $id)
    {
        return Terminal::with([
            'tanks',
            'tanks.sensors',
            'tanks.alerts'
        ])->withCount('tanks')->findOrFail($id);
    }
    
        #[Override]
        public function findByUuid(string $uuid)
        {
             return Terminal::where([
            'uuid',
            $uuid
        ])->firstOrFail();
        
    
      
    }
    #[Override]
    public function create(array $data)
    {
        return Terminal::create($data);
    }
    
    #[Override]
    public function update(int $id, array $data)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function delete(int $id)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function activeTerminals()
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function inactiveTerminals()
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function terminalTankCount(int $id)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function terminalWithTanks(int $id)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function totalCurrentVolume(int $id)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function totalFuelCapacity(int $id)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function lowLevelTanks(int $id)
    {
        throw new \Exception('Not implemented');
    }
}
