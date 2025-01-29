<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use App\Models\Produto;
use App\View\Components\Layouts\Company;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout(Company::class, ['title' => 'Produtos', 'dark' => false])]
class Produtos extends Component
{

    #[Url("q")]
    public ?string $busca = null;

    public Empresa $empresa;

    #[Computed()]
    public function produtos()
    {
        return Produto::query()
            ->when($this->busca, fn ($query) => $query->whereAny(['nome', 'descricao'], 'LIKE', "%$this->busca%"))
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.produtos')->layoutData([
            'empresa' => $this->empresa
        ]);
    }
}
