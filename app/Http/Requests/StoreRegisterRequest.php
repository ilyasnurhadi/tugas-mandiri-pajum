<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:45',
            'email'    => 'required|email|max:45|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }
}