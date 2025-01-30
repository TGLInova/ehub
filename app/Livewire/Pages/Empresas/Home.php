<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use App\Models\Produto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Company;

#[Layout(Company::class, ['title' => 'Página Inicial', 'dark' => false])]
class Home extends BaseComponent
{
    public function render()
    {
        $produtos = $this->empresa->produtos()->with('imagem')->get();

        return $this->view('livewire.pages.empresas.home')->with([
            'produtos' => $produtos
        ]);
    }
}
