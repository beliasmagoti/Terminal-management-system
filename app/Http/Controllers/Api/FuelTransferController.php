<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FuelTransferRequest;
use App\Http\Resources\FuelTransferResource;
use App\Services\FuelTransferService;
use Illuminate\Http\JsonResponse;

class FuelTransferController extends Controller
{
    public function __construct(
        protected FuelTransferService $fuelTransferService
    ) {}

    /**
     * Display all transfers
     */
    public function index(): JsonResponse
    {
        $transfers = $this->fuelTransferService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Fuel transfers retrieved successfully.',
            'data' => FuelTransferResource::collection($transfers),
        ]);
    }

    /**
     * Store transfer
     */
    public function store(
        FuelTransferRequest $request
    ): JsonResponse {
        $transfer = $this->fuelTransferService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Fuel transfer created successfully.',
            'data' => new FuelTransferResource($transfer),
        ], 201);
    }

    /**
     * Show single transfer
     */
    public function show(string $id): JsonResponse
    {
        $transfer = $this->fuelTransferService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new FuelTransferResource($transfer),
        ]);
    }

    /**
     * Update transfer
     */
    public function update(
        FuelTransferRequest $request,
        string $id
    ): JsonResponse {
        $transfer = $this->fuelTransferService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Fuel transfer updated successfully.',
            'data' => new FuelTransferResource($transfer),
        ]);
    }

    /**
     * Delete transfer
     */
    public function destroy(string $id): JsonResponse
    {
        $this->fuelTransferService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Fuel transfer deleted successfully.',
        ]);
    }
}