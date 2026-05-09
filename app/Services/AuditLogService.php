<?php

namespace App\Services;

use App\Interfaces\AuditLogRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    public function __construct(
        protected AuditLogRepositoryInterface $auditLogRepository
    ) {}

    /**
     * Get all logs
     */
    public function getAll(): Collection
    {
        return $this->auditLogRepository->all();
    }

    /**
     * Create audit log
     */
    public function create(array $data)
    {
        return $this->auditLogRepository->create([
            'user_id' => $data['user_id'] ?? null,
            'action' => $data['action'],
            'model_type' => $data['model_type'],
            'model_id' => $data['model_id'],
            'description' => $data['description'] ?? null,
            'ip_address' => $data['ip_address'] ?? request()->ip(),
            'user_agent' => $data['user_agent'] ?? request()->userAgent(),
            'old_values' => $data['old_values'] ?? null,
            'new_values' => $data['new_values'] ?? null,
        ]);
    }

    /**
     * Log helper (clean usage from services)
     */
    public function log(
        string $action,
        string $modelType,
        string $modelId,
        array $oldValues = [],
        array $newValues = [],
        ?string $description = null
    ) {
        return $this->create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}