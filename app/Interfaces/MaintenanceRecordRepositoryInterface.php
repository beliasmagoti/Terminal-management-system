<?php

namespace App\Interfaces;

interface MaintenanceRecordRepositoryInterface

{
    public function all();
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function recordsByTank(int $TankId);
    public function upcomingMaintenance();
    public function overdueMaintenance();

}