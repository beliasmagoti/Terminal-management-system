<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SensorRequest;
use App\Http\Resources\SensorResource;
use App\Services\Sensor\SensorService;
use Illuminate\Http\JsonResponse;

class SensorController extends Controller
{
    public function __construct(
        protected SensorService $sensorService
    ) {}

    /**
     * Display all sensors
     */
    public function index(): JsonResponse
    {
        $sensors = $this->sensorService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Sensors retrieved successfully.',
            'data' => SensorResource::collection($sensors),
        ]);
    }

    /**
     * Store sensor
     */
    public function store(SensorRequest $request): JsonResponse
    {
        $sensor = $this->sensorService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Sensor created successfully.',
            'data' => new SensorResource($sensor),
        ], 201);
    }

    /**
     * Display single sensor
     */
    public function show(string $id): JsonResponse
    {
        $sensor = $this->sensorService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new SensorResource($sensor),
        ]);
    }

    /**
     * Update sensor
     */
    public function update(
        SensorRequest $request,
        string $id
    ): JsonResponse {
        $sensor = $this->sensorService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Sensor updated successfully.',
            'data' => new SensorResource($sensor),
        ]);
    }

    /**
     * Delete sensor
     */
    public function destroy(string $id): JsonResponse
    {
        $this->sensorService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Sensor deleted successfully.',
        ]);
    }
}