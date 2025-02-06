<?php

namespace App\Filament\Clusters\Configuracoes\Resources\TelefoneResource\Pages;

use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTelefone extends EditRecord
{
    protected static string $resource = TelefoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
