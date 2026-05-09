<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceTokenRequest;
use App\Http\Resources\DeviceTokenResource;
use App\Services\DeviceTokenService;
use Illuminate\Http\JsonResponse;

class DeviceTokenController extends Controller
{
    public function __construct(
        protected DeviceTokenService $deviceTokenService
    ) {}

    /**
     * List tokens
     */
    public function index(): JsonResponse
    {
        $tokens = $this->deviceTokenService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Device tokens retrieved successfully.',
            'data' => DeviceTokenResource::collection($tokens),
        ]);
    }

    /**
     * Register token
     */
    public function store(DeviceTokenRequest $request): JsonResponse
    {
        $token = $this->deviceTokenService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Device token registered successfully.',
            'data' => new DeviceTokenResource($token),
        ], 201);
    }

    /**
     * Show token
     */
    public function show(string $id): JsonResponse
    {
        $token = $this->deviceTokenService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new DeviceTokenResource($token),
        ]);
    }

    /**
     * Update token
     */
    public function update(
        DeviceTokenRequest $request,
        string $id
    ): JsonResponse {
        $token = $this->deviceTokenService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Device token updated successfully.',
            'data' => new DeviceTokenResource($token),
        ]);
    }

    /**
     * Deactivate token
     */
    public function deactivate(string $id): JsonResponse
    {
        $token = $this->deviceTokenService->deactivate($id);

        return response()->json([
            'success' => true,
            'message' => 'Device token deactivated successfully.',
            'data' => new DeviceTokenResource($token),
        ]);
    }

    /**
     * Delete token
     */
    public function destroy(string $id): JsonResponse
    {
        $this->deviceTokenService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Device token deleted successfully.',
        ]);
    }
}