<?php

namespace App\Livewire\Pages;

use App\View\Components\Layouts\Main;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(Main::class, ['title' => 'Produtos'])]
class Produtos extends Component
{
    public function render()
    {
        return view('livewire.pages.produtos');
    }
}
