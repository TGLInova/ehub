<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->isLocal()) return;

        $empresa = Empresa::firstOrNew([
            'id' => 1,
        ]);

        $empresa->fill([
            'nome'  => 'TGL',
            'razao_social' => 'TGL Consultoria Financeira',
            'email' => 'contato@grupotgl.com',
            'slug'  => 'tgl',
            'cor'   => '#0051cc',
        ])->save();

        $empresa->endereco()->firstOrNew([])->fill([
            'cep'         => '30110013',
            'logradouro'  => 'Av. Contorno, 2905',
            'complemento' => 'Sala 505',
            'bairro'      => "Santa Efigênia",
            'numero'      => 2905

        ])->save();

        $empresa->produtos()->sync(Produto::pluck('id'));
    }
}
