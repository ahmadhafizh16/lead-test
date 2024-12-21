<?php

namespace App\Transformers;

use Illuminate\Support\Arr;

class PaginatedUserTransformer extends ParentTransformer
{
    public function transform(mixed $paginatedUser): array
    {
        return [
            'page' => $paginatedUser['current_page'],
            'users' => $this->transformArray($paginatedUser['data']),
        ];
    }

    private function transformArray(array $users): array
    {
        return Arr::map($users, function ($value) {
            return [
                'id' => $value['id'],
                'name' => $value['name'],
                'email' => $value['email'],
                'email' => $value['email'],
                'created_at' => $value['created_at'],
                'orders_count' => $value['orders_count'],
            ];
        });
    }

}