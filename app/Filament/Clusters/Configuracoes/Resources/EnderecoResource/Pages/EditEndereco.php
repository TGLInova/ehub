<?php

namespace App\Filament\Clusters\Configuracoes\Resources\EnderecoResource\Pages;

use App\Filament\Clusters\Configuracoes\Resources\EnderecoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEndereco extends EditRecord
{
    protected static string $resource = EnderecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
