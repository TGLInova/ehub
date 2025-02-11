<?php

namespace App\Filament\Clusters\Configuracoes\Resources;

use App\Filament\Clusters\Configuracoes;
use App\Filament\Clusters\Configuracoes\Resources\LinkResource\Pages;
use App\Filament\Clusters\Configuracoes\Resources\LinkResource\RelationManagers;
use App\Models\Link;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $cluster = Configuracoes::class;

    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->empresa_id === null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('nome')->required()->maxLength(50),
                TextInput::make('url')->url()->required()->prefixIcon('heroicon-o-link')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->whereNull('model_type'))
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('url')->searchable(),
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
            'index' => Pages\ListLinks::route('/'),
            // 'create' => Pages\CreateLink::route('/create'),
            // 'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
