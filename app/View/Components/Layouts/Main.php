<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $dark = true
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main', [
            'links' => [
                route('home') => 'Pagina Inicial',
                // route('produtos') => 'Todos os Benefícios'
            ]
        ]);
    }
}
