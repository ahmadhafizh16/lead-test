<?php

namespace App\Tasks;

use App\Models\User;

class CreateUserTask
{
    /**
     * Create User.
     *
     * @param array $data
     * @return User
     *
     */
    public function run(array $data): User
    {
        try {
            return User::create($data);
        } catch (\Throwable $e) {
            throw new \Exception('Failed to create user.');
        }
    }
}
