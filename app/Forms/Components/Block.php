<?php

namespace App\Forms\Components;

use Illuminate\View\View;
use Filament\Forms\Components\Builder\Block as BuilderBlock;

class Block extends BuilderBlock
{
    private array | \Closure $previewData = [];

    private ?int $previewHeight = null;


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

    public function previewHeight(?int $previewHeight)
    {
        $this->previewHeight = $previewHeight;

        return $this;
    }

    public function renderPreview(array $data): View
    {
        $previewData = (array) $this->evaluate($this->previewData);

        $data += $previewData;

        $data['view'] = $this->getName();

        $html = view('components.filament.empresa-paginas.preview', $data)->render();

        return parent::renderPreview($data + ['html' => $html, 'previewHeight' => $this->previewHeight]);
    }
}
