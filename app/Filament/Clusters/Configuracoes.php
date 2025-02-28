<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;
use Filament\Facades\Filament;

class Configuracoes extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'Configurações';

    protected static ?int $navigationSort = 1000;

    protected static ?string $navigationGroup = 'Site Institucional';

}
