<?php

namespace App\Filament\Clusters\Configuracoes\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Endereco;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components as Fc;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Configuracoes;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Configuracoes\Resources\EnderecoResource\Pages;
use App\Filament\Clusters\Configuracoes\Resources\EnderecoResource\RelationManagers;
use Filament\Facades\Filament;

class EnderecoResource extends Resource
{
    protected static ?string $model = Endereco::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $modelLabel = 'Endereço';

    protected static ?string $pluralModelLabel = 'Endereços';

    protected static ?string $cluster = Configuracoes::class;

    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->empresa_id === null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                Cep::make('cep')->viaCep(setFields: [
                    'logradouro' => 'logradouro',
                    'uf'         => 'uf',
                    'bairro'     => 'bairro',
                    'cidade'     => 'localidade',
                ]),
                Fc\TextInput::make('logradouro')->columnSpan(2),
                Fc\TextInput::make('numero')->label('Nº'),
                Fc\TextInput::make('complemento'),
                Fc\TextInput::make('bairro')->required(),
                Fc\TextInput::make('cidade')->required(),
                Fc\TextInput::make('uf')->label('UF')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->whereNull('model_type'))
            ->columns([
                TextColumn::make('logradouro')->searchable(),
                    TextColumn::make('cidade')->searchable(),
                TextColumn::make('uf')->searchable(),
                TextColumn::make('cep')
                    ->searchable(),
                TextColumn::make('numero')
                    ->searchable(),
                TextColumn::make('bairro')
                    ->searchable(),
                TextColumn::make('complemento')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Data de Criação')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Última Atualização')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnderecos::route('/'),
            'create' => Pages\CreateEndereco::route('/create'),
            'edit' => Pages\EditEndereco::route('/{record}/edit'),
        ];
    }
}
