<?php

namespace App\Tasks;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllUserTask
{
    /**
     * Get Paginated user data
     *
     * @param integer $perPage
     * @param string $search
     * @param string $orderby
     * @param string $order
     * @return LengthAwarePaginator
     */
    public function run(
        int $perPage = 10,
        string $search = '',
        string $orderby = '',
        string $order = 'asc',
    ): LengthAwarePaginator
    {
        $users = User::withCount(['orders']);

        if ($search) {
            $users->where('email', $search)
                ->Orwhere('name', $search);
        }

        if ($orderby) {
            $users->orderBy($orderby, $order);
        }

        return $users->paginate($perPage);
    }
}
