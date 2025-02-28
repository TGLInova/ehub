<?php

namespace App\Livewire\Pages;

use App\Models\Link;
use App\Models\Produto;
use App\View\Components\Layouts\Main;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(Main::class, ['title' => 'Página Inicial'])]
class Home extends Component
{
    public function render()
    {
        $links = Link::query()->whereNull('model_type')->get();

        $produtos = Produto::query()->get();

        $cards = [
            [
                'imagem' => asset('static/img/empresario.png'),
                'titulo' => 'Para sua empresa',
                'itens' => [
                    'colorful-presente' => 'Atração e retenção de talentos;',
                    'colorful-rock-and-roll' => 'Aumento da satisfação da equipe;',
                    'colorful-trofeu'   => 'Diferencial competitivo.',
                ]
            ],
            [
                'imagem' => asset('static/img/empresaria.png'),
                'titulo' => 'Para seu funcionário',
                'itens' => [
                    'colorful-pipoca' => 'Descontos em centenas de serviços;',
                    'colorful-sorrindo' => 'Melhora na qualidade de vida;',
                    'colorful-joinha'   => 'Aumento da produtividade.'
                ]
            ]
        ];

        return view('livewire.pages.home', compact('links', 'produtos', 'cards'));
    }
}
