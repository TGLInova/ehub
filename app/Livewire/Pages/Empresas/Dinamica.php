<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\EmpresaPagina;
use Livewire\Attributes\Computed;

class Dinamica extends BaseComponent
{
    public EmpresaPagina $empresaPagina;

    #[Computed]
    public function produtos()
    {
        return $this->empresa->produtos()->get();
    }

    public function render()
    {
        return $this->view('livewire.pages.empresas.dinamica', [
            'title' => $this->empresaPagina->nome,
            'description' => $this->empresaPagina->descricao
        ]);
    }
}
