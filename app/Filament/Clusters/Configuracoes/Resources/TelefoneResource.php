<?php

namespace App\Filament\Clusters\Configuracoes\Resources;

use App\Filament\Clusters\Configuracoes;
use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource\Pages;
use App\Filament\Clusters\Configuracoes\Resources\TelefoneResource\RelationManagers;
use App\Models\Telefone;
use Filament\Facades\Filament;
use Filament\Forms\Components as Fc;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TelefoneResource extends Resource
{
    protected static ?string $model = Telefone::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $cluster = Configuracoes::class;

    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->empresa_id === null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fc\TextInput::make('nome')
                ->placeholder('ex: Comercial, Contato, Sac, Ouvidoria, Financeiro')
                ->columnSpanFull(),
            Fc\TextInput::make('numero')->required()->mask(RawJs::make(<<<'JS'
                $input.length >= 15 ? '(99) 99999-9999' : '(99) 9999-9999'
            JS)),
            Fc\Toggle::make('whatsapp')->label('Este número possui whatsapp?')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('ordem')
            ->modifyQueryUsing(fn($query) => $query->whereNull('model_type'))
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('numero')->label('Número'),
                IconColumn::make('whatsapp')->boolean()->label('Tem Whatsapp?')
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
            'index' => Pages\ListTelefones::route('/'),
        ];
    }
}
