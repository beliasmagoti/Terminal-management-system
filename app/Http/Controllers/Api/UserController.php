<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * List users
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->userService->getAll(),
        ]);
    }

    /**
     * Show user
     */
    public function show(string $id)
    {
        return response()->json([
            'success' => true,
            'data' => $this->userService->getById($id),
        ]);
    }

    /**
     * Create user
     */
    public function store(Request $request)
    {
        $user = $this->userService->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
    }

    /**
     * Update user
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userService->update($id, $request->all());

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }

    /**
     * Delete user
     */
    public function destroy(string $id)
    {
        $this->userService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}