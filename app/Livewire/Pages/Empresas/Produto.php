<?php

namespace App\Livewire\Pages\Empresas;

class Produto extends BaseComponent
{
    public int $produto_id;

    public function render()
    {
        $produto = $this->empresa->produtos()->findOrFail($this->produto_id);

        return $this->view('livewire.pages.empresas.produto', [
            'title' => $produto->nome,
            'description' => $produto->descricao,
            'image'       => $produto?->imagemCapa?->url ?? $produto?->imagem?->url,
        ], ['produto' => $produto]);
    }
}
