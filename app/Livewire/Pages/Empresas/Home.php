<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use App\Models\Produto;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Company;
use Livewire\Attributes\Computed;

#[Layout(Company::class, ['title' => 'Página Inicial', 'dark' => false])]
class Home extends Component
{
    public Empresa $empresa;

    public function render()
    {
        return view('livewire.pages.empresas.home')->layoutData([
            'empresa' => $this->empresa
        ]);
    }
}
