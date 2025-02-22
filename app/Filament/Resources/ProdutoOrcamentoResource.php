<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoOrcamentoResource\Pages;
use App\Filament\Resources\ProdutoOrcamentoResource\RelationManagers;
use App\Models\ProdutoOrcamento;
use App\Models\Usuario;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoOrcamentoResource extends Resource
{
    protected static ?string $model = ProdutoOrcamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Orçamento';

    protected static ?string $pluralModelLabel = 'Orçamentos';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->columns(2)->schema([
            TextEntry::make('nome')->columnSpanFull(),
            TextEntry::make('telefone')->icon('heroicon-o-phone'),
            TextEntry::make('email')->label('E-mail')->icon('heroicon-o-envelope'),
            TextEntry::make('empresa.nome')->badge(),
            TextEntry::make('produto.nome')->badge(),
            TextEntry::make('created_at')->dateTime()->label('Data do Envio')
        ]);
    }

    public static function table(Table $table): Table
    {
        /**
         * @var Usuario
         */
        $usuario = Filament::auth()->user();

        return $table
            ->modifyQueryUsing(fn ($query) => $query->where('empresa_id', $usuario->empresa_id))
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('empresa.id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->label('E-mail')->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('telefone')
                    ->icon('heroicon-o-phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('produto.nome')->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Data do Envio'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProdutoOrcamentos::route('/'),
            'view' => Pages\ViewProdutoOrcamento::route('/{record}'),
        ];
    }
}
