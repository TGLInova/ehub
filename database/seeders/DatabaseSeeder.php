<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Usuario::firstOrCreate(['email' => 'wallacemaxters@gmail.com'], [
            'password' => bcrypt('123456'),
            'nome'     => 'Administrador E-Hub'
        ]);

        $this->call(CategoriaSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ParceiroSeeder::class);
        $this->call(ProdutoSeeder::class);
    }
}
