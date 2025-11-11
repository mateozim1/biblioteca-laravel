<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        Categoria::insert([
            ['nome' => 'Ficcao', 'descricao' => 'Ficção em geral', 'created_at'=>now(),'updated_at'=>now()],
            ['nome' => 'Tecnico', 'descricao' => 'Livros técnicos', 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
