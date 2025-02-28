<?php

namespace App\Filament\Resources\ProdutoOrcamentoResource\Pages;

use App\Filament\Resources\ProdutoOrcamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProdutoOrcamento extends ViewRecord
{
    protected static string $resource = ProdutoOrcamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
