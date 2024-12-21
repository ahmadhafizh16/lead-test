<?php

namespace App\Actions;

use App\Http\Requests\GetAllUserRequest;
use App\Models\User;
use App\Tasks\GetAllUserTask;

class GetAllUserAction
{
    public function __construct(
        private GetAllUserTask $getAllUserTask,
    ) {
    }

    /**
     * Get Paginated user data.
     *
     * @param GetAllUserRequest $request
     * @return array
     */
    public function run(GetAllUserRequest $request): array
    {
        $perPage = $request->input('perPage', 10);
        $sortBy = $request->input('sortBy', 'created_at');
        $sort = $request->input('sort', 'asc');

        return $this->getAllUserTask->run(
            perPage: $perPage,
            search: $request->input('search', ''),
            orderby: $sortBy,
            order: $sort,
        )->toArray();
    }
}
