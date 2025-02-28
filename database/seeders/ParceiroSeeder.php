<?php

namespace Database\Seeders;

use App\Enums\Proporcao;
use App\Models\Midia;
use App\Models\Parceiro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParceiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            1 => ['nome' => 'Porto Seguro'],
            2 => ['nome' => 'Capemisa'],
            3 => ['nome' => 'Mapfre'],
            4 => ['nome' => 'Sulamérica'],
            5 => ['nome' => 'Allianz'],
            6 => ['nome' => 'Azos'],
        ];

        $imagens = [
            1 => 'parceiros/porto.webp',
            2 => 'parceiros/capemisa.webp',
            3 => 'parceiros/mapfre.webp',
            4 => 'parceiros/sulamerica.webp',
            5 => 'parceiros/allianz.webp',
            6 => 'parceiros/azos.webp',
        ];

        $icones = [
            1 => 'parceiros/porto_icone.webp',
            2 => 'parceiros/capemisa_icone.webp'
        ];


        foreach ($items as $id => $item) {

            $parceiro = Parceiro::firstOrNew(['id' => $id]);

            $parceiro->fill($item)->save();

            Midia::createOrUpdateFromAspectRatio($parceiro, null, [
                'caminho'   => $imagens[$id],
                'nome'      => basename($imagens[$id]),
            ]);

            isset($icones[$id]) && Midia::createOrUpdateFromAspectRatio($parceiro, Proporcao::QUADRADO, [
                'nome' => basename($icones[$id]),
                'caminho' => $icones[$id],
            ]);
        }
    }
}
