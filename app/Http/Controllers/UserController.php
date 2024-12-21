<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\GetAllUserAction;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GetAllUserRequest;
use App\Transformers\PaginatedUserTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private CreateUserAction $createUserAction,
        private GetAllUserAction $getAllUserAction,
    ) {
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        // Create a new user
        $user = $this->createUserAction->run($request);

        // Return a success response with a 201 status code
        // The response should contain the newly created user's data
        return $this->transform($user, new UserTransformer(), 201);
    }

    public function getAllUser(GetAllUserRequest $request): mixed
    {
        $paginateUsers = $this->getAllUserAction->run($request);

        // Return a paginated response with a 200 status code
        return $this->transform($paginateUsers, new PaginatedUserTransformer(), 200);
    }
}
