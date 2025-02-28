<?php

namespace App\View\Components\Produtos;

use App\Models\Empresa;
use App\Models\Produto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Produto $produto, public ?Empresa $empresa = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.produtos.card');
    }
}
