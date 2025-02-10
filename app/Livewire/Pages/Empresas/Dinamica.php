<?php

namespace App\Livewire\Pages\Empresas;

use Illuminate\Support\Str;
use App\Models\EmpresaPagina;
use App\Models\Parceiro;
use Livewire\Attributes\Computed;

class Dinamica extends BaseComponent
{
    public ?string $slug = null;

    public EmpresaPagina $empresaPagina;

    public function mount()
    {
        $this->empresaPagina = EmpresaPagina::whereIn('slug', [
            $this->slug,
            Str::start($this->slug, '/'),
        ])->firstOrFail();
    }

    #[Computed]
    public function parceiros()
    {
        return Parceiro::query()
            ->whereHas('produtos.empresas', fn($query) => $query->where('empresa_id', $this->empresa->getKey()))
            ->get();
    }

    #[Computed]
    public function produtos()
    {
        return $this->empresa->produtos()->get();
    }

    public function render()
    {
        return $this->view('livewire.pages.empresas.dinamica', [
            'title' => $this->empresaPagina->nome,
            'description' => $this->empresaPagina->descricao
        ]);
    }
}
