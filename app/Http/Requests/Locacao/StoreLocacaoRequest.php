<?php

namespace App\Http\Requests\Locacao;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocacaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'exists:users,id'],
            'livro_id' => ['required', 'exists:livros,id'],
            'data_devolucao' => ['required', 'date', 'after:today'],
        ];
    }
}
