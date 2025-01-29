<?php

namespace Database\Seeders;

use App\Models\Midia;
use App\Models\Produto;
use Filament\Pages\BasePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            1 => [
                'nome'        => 'Seguro Auto',
                'descricao'   => 'Proteção para você e seu automóvel com a Multiseg Seguros.',
                'imagem'      => 'produtos/seguro-auto.webp',
                'parceiro_id' => 1,
            ],
            2  => [
                'nome'        => 'Plano de Saúde',
                'descricao'   => 'Planos de saúde e odontológicos para você e sua família.',
                'imagem'      => 'produtos/plano-saude.webp',
                'parceiro_id' => 2,
            ]
        ];

        foreach ($items as $id => $item) {

            $produto = Produto::firstOrNew(['id' => $id]);

            if (app()->isProduction() && $produto->exists) continue;


            $imagem = $item['imagem'];

            unset($item['imagem']);


            $produto->fill($item)->save();

            Midia::createOrUpdateFrom($produto, $imagem, ['nome' => basename($imagem)]);
        }
    }
}
