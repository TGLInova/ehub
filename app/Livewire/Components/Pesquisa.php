<?php

namespace App\Livewire\Components;

use App\Models\Empresa;
use App\Models\Produto;
use App\Services\Workspace;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Pesquisa extends Component
{
    public ?string $busca = null;

    #[Computed]
    public function produtos()
    {
        $empresa = app('workspace.empresa');

        return $empresa->produtos()
            ->with('imagem')
            ->when($this->busca, fn ($query) => $query->whereAny(['nome', 'descricao'], 'LIKE', "%{$this->busca}%"))
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.components.pesquisa');
    }
}
