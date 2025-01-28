<?php

namespace App\Livewire\Pages;

use App\View\Components\Layouts\Main;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(Main::class, ['title' => 'Página Inicial'])]
class Home extends Component
{
    public function render()
    {
        return view('livewire.pages.home');
    }
}
