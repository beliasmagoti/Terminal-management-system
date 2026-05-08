<?php

namespace App\Interfaces;

interface NotificationRepositoryInterface

{
    public function all();
    public function paginate(int $perPage = 15);
    public function findById(int $id);
    public function findByUuid(string $uuid);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function markAsRead(int $id);
    public function unreadNotifications();
    public function notificationsByUser(int $userId);

}