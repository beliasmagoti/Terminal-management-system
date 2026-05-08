<?php

namespace App\Interfaces;

interface FuelTransferRepositoryInterface {
    public function all(array $filters = []);
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
   

    public function transtersByTank(int $tankId);
    public function incomingTransfers(int $tankId);

    public function transferBetweenDates(
        string $starDate,
        string $endDate
        
    );

    public function totalTransferredIn(
        int $tankId,      
    );

    public function totalTransferredOut(
        int $tankId,      
    );
    
    public function latestTransfers(int $limit = 10);
       
    public function pendingTransfers();
       
    public function completedTransfers();

}