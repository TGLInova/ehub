<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Parceiro;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Models\EmpresaPagina;
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
                ->with('imagem')
                ->whereHas('produtos.empresas', fn($query) => $query->where('empresa_id', $this->empresa->getKey()))
                ->get();
        }

    #[Computed]
    public function produtos()
    {
        return $this->empresa->produtos()->with('imagem')->get();
    }

    #[Computed]
    public function categorias()
    {
        return Categoria::query()
            ->with('imagem')
            ->whereIn('id', $this->empresa->produtos()->select('produtos.id'))
            ->get();
    }

    public function render()
    {
        return $this->view('livewire.pages.empresas.dinamica', [
            'title' => $this->empresaPagina->nome,
            'description' => $this->empresaPagina->descricao,
            'image'      => asset('static/img/home/banner.webp')
        ]);
    }
}
