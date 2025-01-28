<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FormularioContato extends Component
{
    public array $form = [];

    public function render()
    {
        return view('livewire.components.formulario-contato');
    }
}
