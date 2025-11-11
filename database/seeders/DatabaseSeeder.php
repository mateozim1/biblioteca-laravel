<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            \Database\Seeders\UsersSeeder::class,
            \Database\Seeders\AutoresSeeder::class,
            \Database\Seeders\CategoriasSeeder::class,
            \Database\Seeders\LivrosSeeder::class,
        ]);
    }
}
