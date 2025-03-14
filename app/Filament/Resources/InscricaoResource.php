<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscricaoResource\Pages;
use App\Models\Inscricao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->columns(2)->schema([
            TextEntry::make('nome')->columnSpanFull(),
            TextEntry::make('email')->label('E-mail')->icon('heroicon-o-envelope'),
            TextEntry::make('telefone')->icon('heroicon-o-phone'),
            TextEntry::make('area_atuacao')->label('Área de Atuação'),
            TextEntry::make('cargo')->label('Cargo'),
            TextEntry::make('created_at')->dateTime()->label('Data da Inscrição')->icon('heroicon-o-calendar')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make('email')->label('E-mail')->icon('heroicon-o-envelope')->searchable(),
                TextColumn::make('area_atuacao')->label('Área de Atuação')->searchable(),
                TextColumn::make('cargo')->searchable(),
                TextColumn::make('telefone')->icon('heroicon-o-phone')->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Data da Inscrição')
                    ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->label('Última Atualização')
                //     ->toggleable(isToggledHiddenByDefault: true),
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
