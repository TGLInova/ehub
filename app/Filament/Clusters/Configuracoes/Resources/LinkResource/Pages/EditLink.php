<?php

namespace App\Filament\Clusters\Configuracoes\Resources\LinkResource\Pages;

use App\Filament\Clusters\Configuracoes\Resources\LinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLink extends EditRecord
{
    protected static string $resource = LinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
