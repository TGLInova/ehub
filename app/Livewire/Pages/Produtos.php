<?php

namespace App\Livewire\Pages;

use App\Models\Produto;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Main;
use Livewire\Attributes\Computed;

#[Layout(Main::class, ['title' => 'Produtos', 'dark' => false])]
class Produtos extends Component
{

    #[Url("q")]
    public ?string $busca = null;

    #[Computed()]
    public function produtos()
    {
        return Produto::query()
            ->when($this->busca, fn ($query) => $query->whereAny(['nome', 'descricao'], 'LIKE', "%$this->busca%"))
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.produtos');
    }
}
