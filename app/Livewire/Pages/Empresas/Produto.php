<?php

namespace App\Livewire\Pages\Empresas;

class Produto extends BaseComponent
{
    public \App\Models\Produto $produto;

    public function render()
    {
        return $this->view('livewire.pages.empresas.produto', [
            'title' => $this->produto->nome,
            'description' => $this->produto->descricao,
            'image'       => $this->produto?->imagemCapa?->url ?? $this->produto?->imagem?->url,
        ]);
    }
}
