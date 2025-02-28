<?php

namespace App\Livewire\Components;

use App\Models\Inscricao;
use Livewire\Component;

class FormularioInscricao extends Component
{
    public array $form = [];

    public bool $sucesso = false;

    public function submit()
    {
        $this->validate([
            'form.nome'         => ['required', 'string', 'max:150'],
            'form.email'        => ['required', 'email'],
            'form.telefone'     => ['required', 'celular_com_ddd'],
            'form.area_atuacao' => ['required', 'string'],
            'form.cargo'        => ['required', 'string']
        ]);

        Inscricao::create($this->form);

        $this->sucesso = true;
    }

    public function render()
    {
        return view('livewire.components.formulario-inscricao');
    }
}
