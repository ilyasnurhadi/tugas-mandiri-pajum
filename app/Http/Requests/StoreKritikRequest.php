<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKritikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'film_id' => 'required|exists:films,id',
            'comment' => 'required|string|max:1000',
            'rating'  => 'required|integer|min:1|max:10',
        ];
    }
}