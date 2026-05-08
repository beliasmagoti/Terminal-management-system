<?php

namespace App\Interfaces;

interface AuditLogRepositoryInterface

{
    public function all();
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function logsByUser(int $userId);
    public function logsByModule(string $module);
    
    public function logsBetweenDates (
        string $starDate,
        string $endDate
    );

}