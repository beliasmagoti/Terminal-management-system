<?php

namespace App\Repositories;

use App\Interfaces\MaintenanceRecordRepositoryInterface;
use App\Interfaces\SensorRepositoryInterface;
use Override;

class MaitenanceRecordRepository implements MaintenanceRecordRepositoryInterface

{
        #[Override]
        public function all(array $filters = [])
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function paginate(int $perPage = 15)
        {
            throw new \Exception('Not implemented');
        }
        #[Override]
        public function findById(int $id)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function findByUuid(string $uuid)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function create(array $data)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function update(int $id, array $data)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function upcomingMaintenance()
        {
            throw new \Exception('Not implemented');
        }
    

        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function recordsByTank(int $TankId)
        {
            throw new \Exception('Not implemented');
        }
    
        #[Override]
        public function overdueMaintenance()
        {
            throw new \Exception('Not implemented');
        }
      
}