<?php

namespace App\Filament\Clusters\Configuracoes\Resources\TelefoneResource\Pages;

use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTelefones extends ListRecords
{
    protected static string $resource = TelefoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver(),
        ];
    }
}
