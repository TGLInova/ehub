<?php

namespace App\Livewire\Pages\Empresas;

class Home extends BaseComponent
{
    public function render()
    {

        $produtos = $this->empresa->produtos()->with('imagem')->get();

        return $this->view('livewire.pages.empresas.home', [
            'title' => 'Página Inicial',
            'description' => 'Aqui você encontra Produtos e Serviços para a sua segurança e tranquilidade.'
        ])
        ->with([
            'produtos' => $produtos,
            'categoria' => $this->empresa->produtos()->first()?->categorias()->first(),
        ]);
    }
}
