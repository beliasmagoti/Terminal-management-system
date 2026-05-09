<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get all users
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * Get user by ID
     */
    public function getById(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Create user (admin)
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user;
    }

    /**
     * Update user
     */
    public function update(string $id, array $data)
    {
        $user = $this->getById($id);

        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
        ]);

        if (!empty($data['password'])) {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        return $user;
    }

    /**
     * Delete user
     */
    public function delete(string $id): bool
    {
        return User::findOrFail($id)->delete();
    }
}