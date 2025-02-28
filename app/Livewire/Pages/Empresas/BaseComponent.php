<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Company;

#[Layout('components.layouts.company', ['dark' => false, 'empresa' => null])]
abstract class BaseComponent extends Component
{
    public Empresa $empresa;

    protected function view(string $view, array $layoutData = [], array $data = [])
    {

        return view($view, $data)->layoutData([
            'empresa' => $this->empresa,
            'links' => $this->empresa->paginas()->where('menu', true)->pluck('nome', 'slug'),
            'title'   => class_basename(static::class),
            ...$layoutData
        ]);
    }
}
