<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    /**
     * Display all notifications
     */
    public function index(): JsonResponse
    {
        $notifications = $this->notificationService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Notifications retrieved successfully.',
            'data' => NotificationResource::collection($notifications),
        ]);
    }

    /**
     * Store notification
     */
    public function store(
        NotificationRequest $request
    ): JsonResponse {
        $notification = $this->notificationService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Notification created successfully.',
            'data' => new NotificationResource($notification),
        ], 201);
    }

    /**
     * Show single notification
     */
    public function show(string $id): JsonResponse
    {
        $notification = $this->notificationService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new NotificationResource($notification),
        ]);
    }

    /**
     * Update notification
     */
    public function update(
        NotificationRequest $request,
        string $id
    ): JsonResponse {
        $notification = $this->notificationService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Notification updated successfully.',
            'data' => new NotificationResource($notification),
        ]);
    }

    /**
     * Mark as read
     */
    public function markAsRead(string $id): JsonResponse
    {
        $notification = $this->notificationService->markAsRead($id);

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read.',
            'data' => new NotificationResource($notification),
        ]);
    }

    /**
     * Delete notification
     */
    public function destroy(string $id): JsonResponse
    {
        $this->notificationService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully.',
        ]);
    }
}