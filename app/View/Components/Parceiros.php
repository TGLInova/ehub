<?php

namespace App\View\Components;

use App\Models\Empresa;
use App\Models\Parceiro;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Parceiros extends Component
{
    public ?Empresa $empresa = null;

    public function __construct(
        public ?string $title = null,
        $empresa = null

    ) {
        $this->empresa = $empresa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $parceiros = Parceiro::query()
            ->with('imagem')
            ->when($this->empresa, fn ($query) =>
                $query->whereHas(
                        'produtos.empresas',
                        fn ($query) => $query->where('empresa_id', $this->empresa->getKey())
                    )
            )
            ->get();


        return view('components.parceiros.index', [
            'parceiros' => $parceiros
        ]);
    }
}
