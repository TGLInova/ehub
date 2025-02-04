<?php

namespace App\Livewire\Pages\Empresas;

use App\View\Components\Layouts\Company;
use Livewire\Attributes\Layout;

class Categoria extends BaseComponent
{
    public \App\Models\Produto $produto;

    public function render()
    {
        return $this->view('livewire.pages.empresas.produto')->with([]);
    }
}
