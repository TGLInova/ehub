<?php

namespace App\Filament\Resources;

use App\Enums\Proporcao;
use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components as Fc;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Fc\Repeater::make('imagens')
                    ->columnSpanFull()
                    ->deletable(false)
                    ->addable(false)
                    ->grid(2)
                    ->itemLabel(fn ($state) => Proporcao::tryFrom($state['proporcao'])?->name)
                    ->relationship()
                    ->formatStateUsing(fn ($state, string $operation) => $operation === 'edit' && filled($state) ? array_pad($state, 2, ['proporcao' => Proporcao::WIDESCREEN->value]) : [
                        ['proporcao' => '1:1'],
                        ['proporcao' => '21:9']
                    ])
                    ->schema([
                        Fc\FileUpload::make('caminho')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio(fn ($get) => $get('proporcao'))
                            ->imageResizeTargetWidth(fn ($get) => $get('proporcao') === '21:9' ? 2100 : 400)
                            ->imageResizeTargetHeight(fn ($get) => $get('proporcao') === '21:9' ? 900 : 400)
                            ->label('Imagem')
                            ->directory('produtos'),
                        Fc\Hidden::make('proporcao'),
                    ]),
                Forms\Components\TextInput::make('nome')->maxLength(40)->required(),
                Forms\Components\Select::make('parceiro_id')
                    ->native(false)
                    ->relationship('parceiro', 'nome')
                    ->required(),
                Forms\Components\Select::make('categorias')
                    ->relationship('categorias', 'nome')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('Selecione uma ou mais categorias')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('descricao')->maxLength(200)->columnSpanFull()->label('Descrição'),

                Fc\RichEditor::make('texto')->columnSpanFull()->fileAttachmentsDirectory('produtos/texto')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parceiro.nome'),
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
