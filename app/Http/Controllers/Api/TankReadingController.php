<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TankReadingRequest;
use App\Http\Resources\TankReadingResource;
use App\Services\TankReadingService;
use Illuminate\Http\JsonResponse;

class TankReadingController extends Controller
{
    public function __construct(
        protected TankReadingService $tankReadingService
    ) {}

    /**
     * Display all readings
     */
    public function index(): JsonResponse
    {
        $readings = $this->tankReadingService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Tank readings retrieved successfully.',
            'data' => TankReadingResource::collection($readings),
        ]);
    }

    /**
     * Store reading
     */
    public function store(TankReadingRequest $request): JsonResponse
    {
        $reading = $this->tankReadingService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Tank reading created successfully.',
            'data' => new TankReadingResource($reading),
        ], 201);
    }

    /**
     * Show single reading
     */
    public function show(string $id): JsonResponse
    {
        $reading = $this->tankReadingService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new TankReadingResource($reading),
        ]);
    }

    /**
     * Update reading
     */
    public function update(
        TankReadingRequest $request,
        string $id
    ): JsonResponse {
        $reading = $this->tankReadingService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Tank reading updated successfully.',
            'data' => new TankReadingResource($reading),
        ]);
    }

    /**
     * Delete reading
     */
    public function destroy(string $id): JsonResponse
    {
        $this->tankReadingService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Tank reading deleted successfully.',
        ]);
    }
}