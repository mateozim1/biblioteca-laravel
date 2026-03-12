<?php

namespace App\Http\Requests\Autor;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'nacionalidade' => ['nullable', 'string', 'max:100'],
        ];
    }
}
