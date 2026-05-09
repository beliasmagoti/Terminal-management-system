<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TankRequest;
use App\Http\Resources\TankResource;
use App\Services\TankService;
use Illuminate\Http\JsonResponse;

class TankController extends Controller
{
    public function __construct(
        protected TankService $tankService
    ) {}

    /**
     * Get all tanks
     */
    public function index(): JsonResponse
    {
        $tanks = $this->tankService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Tanks retrieved successfully.',
            'data' => TankResource::collection($tanks),
        ]);
    }

    /**
     * Store tank
     */
    public function store(TankRequest $request): JsonResponse
    {
        $tank = $this->tankService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Tank created successfully.',
            'data' => new TankResource($tank),
        ], 201);
    }

    /**
     * Show tank
     */
    public function show(string $id): JsonResponse
    {
        $tank = $this->tankService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new TankResource($tank),
        ]);
    }

    /**
     * Update tank
     */
    public function update(
        TankRequest $request,
        string $id
    ): JsonResponse {
        $tank = $this->tankService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Tank updated successfully.',
            'data' => new TankResource($tank),
        ]);
    }

    /**
     * Delete tank
     */
    public function destroy(string $id): JsonResponse
    {
        $this->tankService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Tank deleted successfully.',
        ]);
    }
}