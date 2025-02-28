<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;

class Produtos extends AbstractRelationManager
{

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $title = 'Benefícios';

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getRelationshipName(): string
    {
        return 'produtos';
    }

    public function form(Form $form): Form
    {
        return TelefoneResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getRelationshipQuery())
            ->relationship(fn() => $this->getRelationship())
            ->headerActions([
                AttachAction::make()->recordTitleAttribute('nome')
            ])
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('parceiro.nome')->label('Fornecedor')->badge(),
            ])
            ->actions([
                DetachAction::make()
            ]);
    }
}
