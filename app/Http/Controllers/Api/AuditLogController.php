<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuditLogRequest;
use App\Services\AuditLogService;
use Illuminate\Http\JsonResponse;

class AuditLogController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    /**
     * Get all logs
     */
    public function index(): JsonResponse
    {
        $logs = $this->auditLogService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Audit logs retrieved successfully.',
            'data' => $logs,
        ]);
    }

    /**
     * Manual log creation (optional admin use)
     */
    public function store(AuditLogRequest $request)
    {
        $log = $this->auditLogService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Audit log created successfully.',
            'data' => $log,
        ], 201);
    }
}