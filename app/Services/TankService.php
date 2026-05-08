<?php

namespace App\Services;

use App\Interfaces\TankRepositoryInterface;

class TankService {
    public function __construct(
         protected TankRepositoryInterface $tankRepository
    )
    {  }

    public function getAllTanks (array $filters = []) {
        return $this->tankRepository->all($filters);
    }

    public function paginateTanks (int $perPage = 15) {
        return $this->tankRepository->paginate($perPage);
    }

    public function findTank (int $id) {
        return $this->tankRepository->findById($id);
    }  
    
    public function createTank (array $data) {

        $data['current_volume'] = 0;
        return $this->tankRepository->create($data);
    }

     public function updateTank (int $id, array $data) {
        return $this->tankRepository->update($id, $data);
    }

    
    public function delete (int $id) {
        return $this->tankRepository->delete($id);
    } 

    
    public function updateTankVolume (int $tankId, float $volume) {
        $tank = $this->tankRepository->updateVolume($tankId, $volume);

        if ($tank->current_volume <= $tank->critical_level) {
            return 'full';
        }

        return $tank;
    } 

      public function getCriticalTanks () {
        return $this->tankRepository->lowLevelTanks();
    }
 
}