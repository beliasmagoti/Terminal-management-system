<?php

namespace App\Services\Notification;

use App\Interfaces\NotificationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationService
{
    public function __construct(
        protected NotificationRepositoryInterface $notificationRepository
    ) {}

    /**
     * Get all notifications
     */
    public function getAll(): Collection
    {
        return $this->notificationRepository->all();
    }

    /**
     * Get notification by ID
     */
    public function getById(string $id)
    {
        $notification = $this->notificationRepository->findById($id);

        if (!$notification) {
            throw new ModelNotFoundException('Notification not found.');
        }

        return $notification;
    }

    /**
     * Create notification
     */
    public function create(array $data)
    {
        return $this->notificationRepository->create([
            'user_id' => $data['user_id'],
            'tank_id' => $data['tank_id'] ?? null,
            'sensor_id' => $data['sensor_id'] ?? null,
            'title' => $data['title'],
            'message' => $data['message'],
            'type' => $data['type'],
            'channel' => $data['channel'] ?? 'in_app',
            'status' => $data['status'] ?? 'pending',
            'sent_at' => $data['sent_at'] ?? null,
            'read_at' => $data['read_at'] ?? null,
            'metadata' => $data['metadata'] ?? null,
        ]);
    }

    /**
     * Update notification
     */
    public function update(string $id, array $data)
    {
        $notification = $this->getById($id);

        return $this->notificationRepository->update($notification, [
            'title' => $data['title'] ?? $notification->title,
            'message' => $data['message'] ?? $notification->message,
            'type' => $data['type'] ?? $notification->type,
            'channel' => $data['channel'] ?? $notification->channel,
            'status' => $data['status'] ?? $notification->status,
            'sent_at' => $data['sent_at'] ?? $notification->sent_at,
            'read_at' => $data['read_at'] ?? $notification->read_at,
            'metadata' => $data['metadata'] ?? $notification->metadata,
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(string $id)
    {
        $notification = $this->getById($id);

        return $this->notificationRepository->update($notification, [
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    /**
     * Delete notification
     */
    public function delete(string $id): bool
    {
        $notification = $this->getById($id);

        return $this->notificationRepository->delete($notification);
    }
}