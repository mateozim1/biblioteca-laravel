<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Autor;

class AutoresSeeder extends Seeder
{
    public function run()
    {
        Autor::insert([
            ['nome' => 'Machado de Assis', 'nacionalidade' => 'BR', 'created_at'=>now(),'updated_at'=>now()],
            ['nome' => 'George Orwell', 'nacionalidade' => 'UK','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
