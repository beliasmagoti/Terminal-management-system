<?php 
namespace App\Interfaces;


interface AlertRepositoryInterface

{
    public function all();
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function activeAlert(int $id, float $volume);
    public function criticalAlert();
    public function resolveAlert(int $id);
}