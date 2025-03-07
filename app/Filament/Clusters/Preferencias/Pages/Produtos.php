<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;

class Produtos extends AbstractRelationManager
{

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $title = 'Benefícios';

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            TextInput::make('url')
        ]);
    }

    public function getRelationshipName(): string
    {
        return 'produtos';
    }

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn() => $this->getRelationship())
            ->headerActions([
                AttachAction::make()->recordTitleAttribute('nome')->preloadRecordSelect()->slideOver()
            ])
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('parceiro.nome')->label('Fornecedor')->badge(),
            ])
            ->actions([
                DetachAction::make()->recordTitleAttribute('nome')
            ]);
    }
}
