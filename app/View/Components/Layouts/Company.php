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
        $rgb = Hex::fromString($this->empresa->cor)->toRgb();

        $color = implode(' ', [$rgb->red(), $rgb->green(), $rgb->blue()]);

        return view('components.layouts.company', [
            'color' => $color,
            'company' => $this->empresa->nome,
            'links' => [
                route('empresa.home', ['empresa' => $this->empresa]) => 'Página Inicial',
                route('empresa.produtos', ['empresa' => $this->empresa]) => 'Todos os Benefícios',

            ]
        ]);
    }
}
