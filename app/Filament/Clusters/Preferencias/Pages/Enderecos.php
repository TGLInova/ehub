<?php
namespace App\Filament\Clusters\Preferencias\Pages;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Configuracoes\Resources\EnderecoResource;

class Enderecos extends AbstractRelationManager
{
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $title = 'Endereços';

    public function getRelationshipName(): string
    {
        return 'enderecos';
    }

    public function form(Form $form): Form
    {
        return EnderecoResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getRelationshipQuery())

            ->columns([
                TextColumn::make('logradouro')->searchable(),
                TextColumn::make('cidade')->searchable(),
                TextColumn::make('uf')->label('UF')->searchable(),
                TextColumn::make('cep')->searchable(),
                TextColumn::make('numero')->label('Número'),
                TextColumn::make('bairro')->searchable(),
                TextColumn::make('complemento'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('whatsapp')
            ])
            ->actions([
                $this->editAction()
            ]);
    }
}
