<?php

namespace App\View\Components\Layouts;

use App\Models\Empresa;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Color\Hex;

class Company extends Component
{
    public function __construct(public Empresa $empresa)
    {

    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.company', [
            'company' => $this->empresa->nome,
            'links' => $this->empresa->paginas()->where('menu', true)->pluck('nome', 'slug')
        ]);
    }
}
