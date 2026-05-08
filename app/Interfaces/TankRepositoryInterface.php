<?php

namespace App\Interfaces;

interface TankRepositoryInterface {
    public function all(array $filters = []);
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updateVolume(int $id, float $volume);
    public function lowLevelTanks();

}