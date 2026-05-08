<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Terminal\TerminalRequest;
use App\Http\Resources\TerminalResource;
use App\Services\Terminal\TerminalService;
use Illuminate\Http\JsonResponse;

class TerminalController extends Controller
{
    public function __construct(
        protected TerminalService $terminalService
    ) {}

    /**
     * Get all terminals
     */
    public function index(): JsonResponse
    {
        $terminals = $this->terminalService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Terminals retrieved successfully.',
            'data' => TerminalResource::collection($terminals),
        ]);
    }

    /**
     * Store terminal
     */
    public function store(TerminalRequest $request): JsonResponse
    {
        $terminal = $this->terminalService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Terminal created successfully.',
            'data' => new TerminalResource($terminal),
        ], 201);
    }

    /**
     * Show terminal
     */
    public function show(string $id): JsonResponse
    {
        $terminal = $this->terminalService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new TerminalResource($terminal),
        ]);
    }

    /**
     * Update terminal
     */
    public function update(
        TerminalRequest $request,
        string $id
    ): JsonResponse {
        $terminal = $this->terminalService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Terminal updated successfully.',
            'data' => new TerminalResource($terminal),
        ]);
    }

    /**
     * Delete terminal
     */
    public function destroy(string $id): JsonResponse
    {
        $this->terminalService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Terminal deleted successfully.',
        ]);
    }
}