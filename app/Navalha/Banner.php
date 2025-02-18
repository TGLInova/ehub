<?php

namespace App\Navalha;

use WallaceMaxters\Navalha\Component;

class Banner extends Component
{
    public function __construct(string $image = null)
    {

    }

    protected function data(): array
    {
        return [
            'title'       => 'Clube de Benefícios com descontos de verdade!',
            'description' => 'Aqui você encontra Produtos e Serviços para a sua segurança e tranquilidade.'
        ];
    }

    public function render()
    {
        return view('navalha.banner');
    }
}
