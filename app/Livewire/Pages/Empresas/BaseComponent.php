<?php

namespace App\Livewire\Pages\Empresas;

use App\Models\Empresa;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use App\View\Components\Layouts\Company;

#[Layout(Company::class, ['dark' => false])]
abstract class BaseComponent extends Component
{
    public Empresa $empresa;

    protected function prepareRender(View $view)
    {
        return $view->layoutData([
            'empresa' => $this->empresa
        ]);
    }
}
