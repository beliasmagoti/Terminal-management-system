<?php

namespace App\Repositories;

use App\Interfaces\FuelDeliveryRepositoryInterface;
use Override;

class FuelDeliveryRepository implements FuelDeliveryRepositoryInterface

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
        public function deliveriesBetweenDates(string $starDate, string $endDate)
        {
            throw new \Exception('Not implemented');
        }
     

        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function deliveriesByTank(int $tankId)
        {
            throw new \Exception('Not implemented');
        }
     

        #[Override]
        public function deliveriesByTerminal(int $terminalId)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function totalDeliveredVolume(int $tankId, string $starDate, string $endDate)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function latestDeliveries(int $limit = 10)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function pendingDeliveries()
        {
            throw new \Exception('Not implemented');
        }
        

        #[Override]
        public function completedDeliveries()
        {
            throw new \Exception('Not implemented');
        }
     
}