<?php

namespace App\Livewire\Components;

use App\Models\Produto;
use App\Models\ProdutoOrcamento;
use Livewire\Component;

class FormProdutoOrcamento extends Component
{
    public Produto $produto;

    public bool $sucesso = false;

    public $form = [
        'nome'     => '',
        'email'    => '',
        'telefone' => '',
    ];

    public function submit()
    {
        $this->validate([
            'form.nome'     => ['required', 'string', 'max:255'],
            'form.email'    => ['required', 'email'],
            'form.telefone' => ['required', 'celular_com_ddd'],
        ]);

        $dados = [
            'empresa_id' => app('workspace.empresa')->getKey(),
            'produto_id' => $this->produto->id,
        ] + $this->form;

        ProdutoOrcamento::create($dados);

        $this->reset('form');

        $this->sucesso = true;

    }

    public function render()
    {
        return view('livewire.components.form-produto-orcamento');
    }
}
