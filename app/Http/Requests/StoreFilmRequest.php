<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'    => 'required|string|max:255',
            'year'     => 'required|integer|min:1900|max:2100',
            'genre_id' => 'required|exists:genres,id',
            'sinopsis' => 'required|string',
            'poster'   => 'required|image|max:2048',
        ];
    }
}