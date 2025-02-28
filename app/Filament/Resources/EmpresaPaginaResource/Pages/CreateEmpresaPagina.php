<?php

namespace App\Filament\Resources\EmpresaPaginaResource\Pages;

use App\Filament\Resources\EmpresaPaginaResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateEmpresaPagina extends CreateRecord
{
    protected static string $resource = EmpresaPaginaResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['empresa_id'] = Filament::auth()->user()->empresa_id;

        return $data;
    }
}
