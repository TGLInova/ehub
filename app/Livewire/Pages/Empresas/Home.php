<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use App\Models\Produto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Company;

#[Layout(Company::class, ['title' => 'Página Inicial', 'dark' => false])]
class Home extends Component
{
    public Empresa $empresa;

    public function render()
    {
        $produtos = Produto::with('imagem')->get();

        return view('livewire.pages.empresas.home', [
            'produtos' => $produtos
        ])
        ->layoutData([
            'empresa' => $this->empresa
        ]);
    }
}
