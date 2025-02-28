<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use App\Filament\Clusters\Configuracoes\Resources\LinkResource;
use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Livewire\Attributes\Computed;
use Filament\Tables\Columns\TextColumn;

class Links extends AbstractRelationManager
{
    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $title = 'Links';

    #[Computed]
    protected function empresa(): Empresa
    {
        return Filament::auth()->user()->empresa;
    }

    public function getRelationshipName(): string
    {
        return 'links';
    }

    public function form(Form $form): Form
    {
        return LinkResource::form($form);
    }


    public function table(Table $table): Table
    {
        return $table
            ->query($this->getRelationshipQuery())
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('url')->searchable(),
            ])
            ->actions([
                $this->editAction()
            ]);
    }


}
