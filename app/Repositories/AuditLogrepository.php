<?php

namespace App\Repositories;

use App\Interfaces\AuditLogRepositoryInterface;
use App\Interfaces\SensorRepositoryInterface;
use Override;

class AuditLogrepository implements AuditLogRepositoryInterface

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
        public function logsByUser(int $userId)
        {
            throw new \Exception('Not implemented');
        }
     

        #[Override]
        public function logsByModule(string $module)
        {
            throw new \Exception('Not implemented');
        }
      

        #[Override]
        public function logsBetweenDates(string $starDate, string $endDate)
        {
            throw new \Exception('Not implemented');
        }
      


      

       
}