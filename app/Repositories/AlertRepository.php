<?php

namespace App\Repositories;

use App\Interfaces\AlertRepositoryInterface;
use Override;

class AlertRepository implements AlertRepositoryInterface

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
        public function activeAlert(int $id, float $volume)
        {
            throw new \Exception('Not implemented');
        }
      
        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function criticalAlert()
        {
            throw new \Exception('Not implemented');
        }
     

        #[Override]
        public function resolveAlert(int $id)
        {
            throw new \Exception('Not implemented');
        }
     
}