<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => [
                'string',
            ],
            'perPage' => [
                'numeric',
                'min:1',
            ],
            'sortBy' => [
                'string',
                Rule::in(['name','email','created_at']),
            ],
            'sort' => [
                'string',
                Rule::in(['asc','desc']),
            ]
        ];
    }
}