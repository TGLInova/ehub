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

        return view('livewire.pages.home', compact('links', 'produtos'));
    }
}
