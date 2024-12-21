<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer extends ParentTransformer
{
    public function transform(mixed $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at->toDateTimeString(),
        ];
    }
}