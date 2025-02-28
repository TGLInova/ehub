<?php

namespace App\View\Components\Ui;

use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Link;
use App\Models\Telefone;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public ?Empresa $empresa = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $dark = false,
        $empresa = null
    ) {
        $this->empresa = $empresa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $telefones = $this->empresa?->telefones ?? Telefone::whereNull('model_type')->get();
        $endereco  = $this->empresa?->endereco ?? Endereco::whereNull('model_type')->first();
        $links     = $this->empresa?->links ?? Link::whereNull('model_type')->get();

        $siteLinks = [
            [
                'nome' => 'Página Inicial',
                'url' => $this->empresa ? '/' : route('home')
            ],
        ];

        if ($this->empresa) {

            $siteLinks[] = [
                'nome' => 'Todos os Benefícios',
                'url' => route('empresa.produtos', ['empresa' => $this->empresa])
            ];

            $siteLinks[] = [
                'nome' => 'Categorias',
                'url'  => route('empresa.categorias', ['empresa' => $this->empresa])
            ];
        }

        return view('components.ui.footer', [
            'logo' => $this->empresa?->imagem?->url,
            'telefones' => $telefones,
            'endereco'  => $endereco,
            'links'     => $links,
            'siteLinks' => $siteLinks
        ]);
    }
}
