<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FuelDelivery\FuelDeliveryRequest;
use App\Http\Resources\FuelDeliveryResource;
use App\Services\FuelDelivery\FuelDeliveryService;
use Illuminate\Http\JsonResponse;

class FuelDeliveryController extends Controller
{
    public function __construct(
        protected FuelDeliveryService $fuelDeliveryService
    ) {}

    /**
     * Display all deliveries
     */
    public function index(): JsonResponse
    {
        $deliveries = $this->fuelDeliveryService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Fuel deliveries retrieved successfully.',
            'data' => FuelDeliveryResource::collection($deliveries),
        ]);
    }

    /**
     * Store delivery
     */
    public function store(
        FuelDeliveryRequest $request
    ): JsonResponse {
        $delivery = $this->fuelDeliveryService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Fuel delivery created successfully.',
            'data' => new FuelDeliveryResource($delivery),
        ], 201);
    }

    /**
     * Show single delivery
     */
    public function show(string $id): JsonResponse
    {
        $delivery = $this->fuelDeliveryService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new FuelDeliveryResource($delivery),
        ]);
    }

    /**
     * Update delivery
     */
    public function update(
        FuelDeliveryRequest $request,
        string $id
    ): JsonResponse {
        $delivery = $this->fuelDeliveryService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Fuel delivery updated successfully.',
            'data' => new FuelDeliveryResource($delivery),
        ]);
    }

    /**
     * Delete delivery
     */
    public function destroy(string $id): JsonResponse
    {
        $this->fuelDeliveryService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Fuel delivery deleted successfully.',
        ]);
    }
}