<?php

namespace App\Interfaces;

interface TerminalRepositoryInterface

{
    public function all(array $filters = []);
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
   

    public function activeTerminals();
     public function inactiveTerminals();

 public function terminalWithTanks(int $id);
public function terminalTankCount(int $id);
 public function totalFuelCapacity(int $id);
public function totalCurrentVolume(int $id);
public function lowLevelTanks(int $id);



}