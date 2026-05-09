<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRecordRequest;
use App\Http\Resources\MaintenanceRecordResource;
use App\Services\MaintenanceRecord\MaintenanceRecordService;
use Illuminate\Http\JsonResponse;

class MaintenanceRecordController extends Controller
{
    public function __construct(
        protected MaintenanceRecordService $maintenanceRecordService
    ) {}

    /**
     * Display all maintenance records
     */
    public function index(): JsonResponse
    {
        $records = $this->maintenanceRecordService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Maintenance records retrieved successfully.',
            'data' => MaintenanceRecordResource::collection($records),
        ]);
    }

    /**
     * Store maintenance record
     */
    public function store(
        MaintenanceRecordRequest $request
    ): JsonResponse {
        $record = $this->maintenanceRecordService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Maintenance record created successfully.',
            'data' => new MaintenanceRecordResource($record),
        ], 201);
    }

    /**
     * Show single maintenance record
     */
    public function show(string $id): JsonResponse
    {
        $record = $this->maintenanceRecordService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new MaintenanceRecordResource($record),
        ]);
    }

    /**
     * Update maintenance record
     */
    public function update(
        MaintenanceRecordRequest $request,
        string $id
    ): JsonResponse {
        $record = $this->maintenanceRecordService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Maintenance record updated successfully.',
            'data' => new MaintenanceRecordResource($record),
        ]);
    }

    /**
     * Delete maintenance record
     */
    public function destroy(string $id): JsonResponse
    {
        $this->maintenanceRecordService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Maintenance record deleted successfully.',
        ]);
    }
}