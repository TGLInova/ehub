<?php

namespace App\Filament\Resources\EmpresaPaginaResource\Pages;

use App\Filament\Resources\EmpresaPaginaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmpresaPagina extends EditRecord
{
    protected static string $resource = EmpresaPaginaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
