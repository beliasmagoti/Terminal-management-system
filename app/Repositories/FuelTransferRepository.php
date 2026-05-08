<?php

namespace App\Repositories;

use App\Interfaces\FuelTransferRepositoryInterface;
use Override;

class FuelTransferRepository implements FuelTransferRepositoryInterface
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
        public function transtersByTank(int $tankId)
        {
            throw new \Exception('Not implemented');
        }
     
     

        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function totalTransferredIn(int $tankId)
        {
            throw new \Exception('Not implemented');
        }
     
     

        #[Override]
        public function totalTransferredOut(int $tankId)
        {
            throw new \Exception('Not implemented');
        }
       

        #[Override]
        public function transferBetweenDates(string $starDate, string $endDate)
        {
            throw new \Exception('Not implemented');
        }
    

        #[Override]
        public function incomingTransfers(int $tankId)
        {
            throw new \Exception('Not implemented');
        }
      
        

        #[Override]
        public function latestTransfers(int $limit = 10)
        {
            throw new \Exception('Not implemented');
        }
      
        #[Override]
        public function pendingTransfers()
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function completedTransfers()
        {
            throw new \Exception('Not implemented');
        }
     
}