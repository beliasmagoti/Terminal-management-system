<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alert\AlertRequest;
use App\Http\Resources\AlertResource;
use App\Services\Alert\AlertService;
use Illuminate\Http\JsonResponse;

class AlertController extends Controller
{
    public function __construct(
        protected AlertService $alertService
    ) {}

    /**
     * Get all alerts
     */
    public function index(): JsonResponse
    {
        $alerts = $this->alertService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Alerts retrieved successfully.',
            'data' => AlertResource::collection($alerts),
        ]);
    }

    /**
     * Create alert
     */
    public function store(AlertRequest $request): JsonResponse
    {
        $alert = $this->alertService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Alert created successfully.',
            'data' => new AlertResource($alert),
        ], 201);
    }

    /**
     * Show alert
     */
    public function show(string $id): JsonResponse
    {
        $alert = $this->alertService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new AlertResource($alert),
        ]);
    }

    /**
     * Resolve alert
     */
    public function resolve(string $id): JsonResponse
    {
        $alert = $this->alertService->resolve($id);

        return response()->json([
            'success' => true,
            'message' => 'Alert resolved successfully.',
            'data' => new AlertResource($alert),
        ]);
    }

    /**
     * Ignore alert
     */
    public function ignore(string $id): JsonResponse
    {
        $alert = $this->alertService->ignore($id);

        return response()->json([
            'success' => true,
            'message' => 'Alert ignored successfully.',
            'data' => new AlertResource($alert),
        ]);
    }

    /**
     * Delete alert
     */
    public function destroy(string $id): JsonResponse
    {
        $this->alertService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Alert deleted successfully.',
        ]);
    }
}