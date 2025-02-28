<?php

namespace App\Forms\Components;

use Illuminate\View\View;
use Filament\Forms\Components\Builder\Block as BuilderBlock;

class Block extends BuilderBlock
{
    private array | \Closure $previewData = [];


    public function setUp(): void
    {
        parent::setUp();

        $this->preview('components.filament.empresa-paginas.preview-iframe');
    }

    public function previewData(array | \Closure $data)
    {
        $this->previewData = $data;

        return $this;
    }

    public function renderPreview(array $data): View
    {
        $previewData = (array) $this->evaluate($this->previewData);

        $data += $previewData;

        $data['view'] = $this->getName();

        $html = view('components.filament.empresa-paginas.preview', $data)->render();

        return parent::renderPreview($data + compact('html'));
    }
}
