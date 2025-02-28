<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class Produtos extends BaseComponent
{

    #[Url("q")]
    public ?string $busca = null;

    public Empresa $empresa;

    #[Computed()]
    public function produtos()
    {
        return $this->empresa->produtos()
            ->when($this->busca, fn ($query) => $query->whereAny(['nome', 'descricao'], 'LIKE', "%$this->busca%"))
            ->get();
    }

    public function render()
    {
        return $this->view('livewire.pages.produtos')->layoutData([
            'empresa' => $this->empresa
        ]);
    }
}
