<?php

namespace App\Filament\Resources\ProdutoOrcamentoResource\Pages;

use App\Filament\Resources\ProdutoOrcamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProdutoOrcamento extends EditRecord
{
    protected static string $resource = ProdutoOrcamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
