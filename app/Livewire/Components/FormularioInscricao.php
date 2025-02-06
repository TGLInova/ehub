<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FormularioInscricao extends Component
{
    public array $form = [];

    public function submit()
    {
        $data = $this->validate([
            'form.nome'         => ['required', 'string', 'max:150'],
            'form.email'        => ['required', 'email'],
            'form.telefone'     => ['required', 'celular_com_ddd'],
            'form.area_atuacao' => ['required', 'string'],
            'form.cargo'        => ['required', 'string']
        ]);
    }

    public function render()
    {
        return view('livewire.components.formulario-inscricao');
    }
}
