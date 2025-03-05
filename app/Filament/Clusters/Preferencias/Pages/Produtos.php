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
                TextColumn::make('tem_url')
                    ->default(fn ($record) => $record->pivot->url !== null)
                    ->formatStateUsing(fn ($state) => $state ? 'Sim' : 'Não')
                    ->label('Link')
                    ->color(fn ($state) => $state ? 'primary' : 'gray')
                    ->icon(fn ($state) => $state ? 'heroicon-o-link' : 'heroicon-o-document-text'),
            ])
            ->actions([
                $this->editPivot(),
                DetachAction::make()->recordTitleAttribute('nome')
            ]);
    }

    protected function editPivot()
    {
        return Tables\Actions\Action::make('update_pivot')->slideOver()->label('Ação Padrão')->icon('heroicon-o-pencil')->form([
            ToggleButtons::make('tem_url')
                ->live()
                ->formatStateUsing(fn($get) => $get('url') !== null)
                ->label('Deseja adicionar link para o produto?')
                ->grouped()
                ->options([
                    0 => 'Usar Formulário',
                    1 => 'Usar Link'
                ])
                ->afterStateUpdated(function ($set) {
                    $set('url', null);
                })
                ->dehydrated(true),
            TextInput::make('url')->required()->visible(fn($get) => $get('tem_url'))->dehydratedWhenHidden(false)->placeholder('Copie e cole o link desejado aqui.'),
        ])->mountUsing(fn($form, $record) => $form->fill($record->pivot->toArray()))
            ->action(function (array $data, $record) {
                $record->pivot->update($data + ['url' => null]);
            });
    }
}
