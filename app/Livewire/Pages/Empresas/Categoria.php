<?php

namespace App\Livewire\Pages\Empresas;

use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\View\Components\Layouts\Company;

class Categoria extends BaseComponent
{
    public ?\App\Models\Categoria $categoria = null;

    #[Url]
    public ?string $busca = null;

    #[Computed()]
    public function produtos()
    {
        return $this->empresa->produtos()
            ->when($this->categoria, fn($query) => $query->whereHas('categorias', fn($query) => $query->where('categoria_id', $this->categoria->getKey())))
            ->when($this->busca, fn($query) => $query->whereAny(['nome', 'descricao'], 'LIKE', "%$this->busca%"))
            ->get();
    }

    public function render()
    {

        $categorias = \App\Models\Categoria::query()->get();

        return $this->view('livewire.pages.empresas.categoria', ['image' => $this->categoria?->imagem?->url])->with([
            'categorias' => $categorias
        ]);
    }
}
