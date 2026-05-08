<?php

namespace App\Interfaces;

interface FuelDeliveryRepositoryInterface {
    public function all(array $filters = []);
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
   

       public function deliveriesByTank(int $tankId);
        public function deliveriesByTerminal(int $terminalId);

     public function deliveriesBetweenDates(
        string $starDate,
        string $endDate
        
    );

     public function totalDeliveredVolume(
        int $tankId,
        string $starDate,
        string $endDate
        
    );
    
       public function latestDeliveries(int $limit = 10);
       
       public function pendingDeliveries();
       
       public function completedDeliveries();

}