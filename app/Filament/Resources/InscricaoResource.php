<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscricaoResource\Pages;
use App\Models\Inscricao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InscricaoResource extends Resource
{
    protected static ?string $model = Inscricao::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $pluralModelLabel = 'Inscrições';

    protected static ?string $modelLabel = 'Inscrição';

    protected static ?string $navigationGroup = 'Site Institucional';

    protected static ?string $slug = 'inscricoes';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('area_atuacao')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cargo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area_atuacao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cargo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver(),
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
            'index' => Pages\ListInscricoes::route('/'),
        ];
    }
}
