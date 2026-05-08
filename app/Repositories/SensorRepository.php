<?php

namespace App\Repositories;

use App\Interfaces\SensorRepositoryInterface;
use Override;

class SensorRepository implements SensorRepositoryInterface

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
        public function sensorsByTank(int $tankId)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function delete(int $id)
        {
            throw new \Exception('Not implemented');
        }


        #[Override]
        public function activeSensors(int $id, float $volume)
        {
            throw new \Exception('Not implemented');
        }

        #[Override]
        public function offlineSensors()
        {
            throw new \Exception('Not implemented');
        }
}