<?php

namespace App\Http\Requests\Livro;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'autor_id' => ['required', 'exists:autores,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'ano_publicacao' => ['nullable', 'integer'],
            'quantidade_total' => ['required', 'integer', 'min:0'],
            'isbn' => ['nullable', 'string'],
        ];
    }
}
