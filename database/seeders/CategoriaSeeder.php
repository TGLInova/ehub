<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            1 => ['nome' => 'Seguro Saúde', 'icone' => 'icon-estetoscopio'],
            2 => ['nome' => 'Seguros Pessoais', 'icone' => 'icon-seguranca'],
            3 => ['nome' => 'Seguros Patrimoniais', 'icone' => 'icon-predio'],
            4 => ['nome' => 'Negócios e Eventos', 'icone' => 'icon-calendario'],
            5 => ['nome' => 'Psicologia', 'icone' => 'icon-psicologia'],
            6 => ['nome' => 'Consultorias'],
            7 => ['nome' => 'Finanças'],
        ];

        foreach ($items as $id => $item) {

            $model = Categoria::firstOrNew(['id' => $id]);

            if ($model->exists && !app()->isLocal()) continue;

            $model->fill($item)->save();
        }
    }
}
