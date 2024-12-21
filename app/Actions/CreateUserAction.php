<?php

namespace App\Actions;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Tasks\CreateUserTask;

class CreateUserAction
{
    public function __construct(
        private CreateUserTask $createUserTask,
    ) {
    }

    /**
     * Create a new User
     *
     * @param CreateUserRequest $request
     * @return User
     */
    public function run(CreateUserRequest $request): User
    {
        $data = $request->toArray();

        return $this->createUserTask->run($data);
    }
}
