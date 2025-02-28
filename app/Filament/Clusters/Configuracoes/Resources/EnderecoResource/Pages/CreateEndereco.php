<?php

namespace App\Filament\Clusters\Configuracoes\Resources\EnderecoResource\Pages;

use App\Filament\Clusters\Configuracoes\Resources\EnderecoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEndereco extends CreateRecord
{
    protected static string $resource = EnderecoResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
