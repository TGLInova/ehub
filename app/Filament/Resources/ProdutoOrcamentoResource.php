<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoOrcamentoResource\Pages;
use App\Filament\Resources\ProdutoOrcamentoResource\RelationManagers;
use App\Models\ProdutoOrcamento;
use App\Models\Usuario;
use Filament\Facades\Filament;
use Filament\Infolists\Components as Ic;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProdutoOrcamentoResource extends Resource
{
    protected static ?string $model = ProdutoOrcamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Orçamento';

    protected static ?string $pluralModelLabel = 'Orçamentos';

    public static function infolist(Infolist $infolist): Infolist
    {
         /**
         * @var Usuario
         */
        $usuario = Filament::auth()->user();

        return $infolist->columns(2)->schema([

            Ic\Fieldset::make('')->schema([
                Ic\TextEntry::make('nome')->columnSpanFull(),
            ]),
            Ic\Fieldset::make('Contato')->schema([
                Ic\TextEntry::make('telefone')->icon('heroicon-o-phone'),
                Ic\TextEntry::make('email')->label('E-mail')->icon('heroicon-o-envelope'),
            ]),
            Ic\Fieldset::make('Detalhes do Benefício')->columns(3)->schema([
                Ic\TextEntry::make('produto.nome')->badge()->label('Benefício'),
                Ic\TextEntry::make('produto.parceiro.nome')->badge()->label('Fornecedor'),
                Ic\TextEntry::make('empresa.nome')->badge()->label('Cliente')->visible($usuario->empresa_id === null),
            ]),
            Ic\Fieldset::make('')->schema([
                Ic\TextEntry::make('created_at')->dateTime()->label('Data do Envio'),
                Ic\TextEntry::make('origem')
                    ->default(fn ($record) => route('empresa.produto.show', ['empresa' => $record->empresa, 'produto' => $record->produto_id]))
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        /**
         * @var Usuario
         */
        $usuario = Filament::auth()->user();

        return $table
            ->modifyQueryUsing(fn ($query) => $query->with('produto.parceiro', 'empresa'))
            ->defaultSort('id', 'desc')
            ->modifyQueryUsing(fn ($query) => $usuario->empresa_id ? $query->where('empresa_id', $usuario->empresa_id) : $query)
            ->columns([
                Tables\Columns\TextColumn::make('nome')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable()->label('E-mail')->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('telefone')
                ->icon('heroicon-o-phone')
                ->searchable(),

                TextColumn::make('produto.nome')->badge(),

                TextColumn::make('produto.parceiro.nome'),

                TextColumn::make('empresa.nome')->label('Cliente')->visible($usuario->empresa_id === null),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Data do Envio'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('empresa_id')->label('Cliente')->relationship('empresa', 'nome')->visible($usuario->empresa_id === null),
                Tables\Filters\SelectFilter::make('produto_id')->label('Benefício')->relationship('produto', 'nome', modifyQueryUsing: function ($query) {
                    $query->has('orcamentos');
                }),
                Tables\Filters\SelectFilter::make('produto.parceiro_id')->label('Fornecedor')->relationship('produto.parceiro', 'nome')
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
