<?php

namespace Database\Seeders;

use App\Models\Midia;
use App\Models\Produto;
use App\Enums\Proporcao;
use Illuminate\Support\Str;
use Filament\Pages\BasePage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'texto'       => <<<HTML

                HTML,
            ],
            2  => [
                'nome'        => 'Plano de Saúde',
                'descricao'   => 'Planos de saúde e odontológicos para você e sua família.',
                'imagem'      => 'produtos/plano-saude.webp',
                'parceiro_id' => 2,
            ],
            3  => [
                'nome'        => 'Cartão Porto Bank',
                'descricao'   => 'Conheça o nosso cartão que combina com você!',
                'imagem'      => 'produtos/porto-bank.webp',
                'parceiro_id' => 2,
            ],
            4  => [
                'nome'        => 'Seguro Bike',
                'descricao'   => 'Solução completa de proteção para todos os tipos de bicicleta.',
                'imagem'      => 'produtos/seguro-bike.webp',
                'parceiro_id' => 2,
            ],
            5  => [
                'nome'        => 'Seguro Residencial',
                'descricao'   => 'Sua casa segura e tranquila com planos sob medida.',
                'imagem'      => 'produtos/seguro-residencial.webp',
                'parceiro_id' => 2,
            ]
        ];

        foreach ($items as $id => $item) {

            $produto = Produto::firstOrNew(['id' => $id]);

            if (app()->isProduction() && $produto->exists) continue;


            $imagem = $item['imagem'];

            unset($item['imagem']);

            $produto->fill($item)->save();

            Midia::createOrUpdateFrom($produto, $imagem, [
                'nome' => basename($imagem),
                'proporcao' => Proporcao::QUADRADO
            ]);

            Midia::createOrUpdateFrom($produto, 'produtos/' . Str::slug($item['nome']) . '-capa.png', [
                'nome' => basename($imagem),
                'proporcao' => Proporcao::ULTRAWIDE
            ]);
        }
    }
}
