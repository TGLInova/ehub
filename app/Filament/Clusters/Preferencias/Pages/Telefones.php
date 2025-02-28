<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource;

class Telefones extends AbstractRelationManager
{

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $title = 'Telefones';

    public function getRelationshipName(): string
    {
        return 'telefones';
    }

    public function form(Form $form): Form
    {
        return TelefoneResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getRelationshipQuery())
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('numero')->label('Número'),
                IconColumn::make('whatsapp')->boolean()
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('whatsapp')
            ])
            ->actions([
                $this->editAction()
            ]);
    }
}
