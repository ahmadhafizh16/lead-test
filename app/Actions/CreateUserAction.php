<?php

namespace App\Actions;

use App\Events\UserCreatedEvent;
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
        $data = $request->only(['email', 'password', 'name']);
        
        $createdUser = $this->createUserTask->run($data);
        UserCreatedEvent::dispatch($createdUser);

        return $createdUser;
    }
}
