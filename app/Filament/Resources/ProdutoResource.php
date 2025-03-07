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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Benefícios';

    protected static ?string $pluralModelLabel = 'Benefícios';


    protected static function fileUploadField(Proporcao $proporcao, callable $callback)
    {
        return Fc\Group::make()->schema([
            Fc\Hidden::make('proporcao')->formatStateUsing(fn() => $proporcao->value),
            Fc\FileUpload::make('caminho')
                ->image()
                ->when(true, $callback)
                ->imageEditor()
                ->imageEditorMode(2)
                ->downloadable()
                ->imageCropAspectRatio($proporcao?->value)
                ->directory('parceiros')
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                static::fileUploadField(Proporcao::QUADRADO, function (Fc\FileUpload $component) {
                    $component->label('Imagem do Card (Quadrada)')
                        ->required()
                        ->imageResizeTargetWidth(800)
                        ->imageResizeTargetHeight(800);
                })->relationship('imagem'),
                static::fileUploadField(Proporcao::ULTRAWIDE, function (Fc\FileUpload $component) {
                    $component->label('Banner da Página (Horizontal)')
                        ->imageResizeTargetWidth(2520)
                        ->imageResizeTargetHeight(1080);
                })->relationship('imagemCapa', fn($state) => $state['caminho']),
                Forms\Components\TextInput::make('nome')->maxLength(40)->required(),
                Forms\Components\Select::make('parceiro_id')
                    ->native(false)
                    ->relationship('parceiro', 'nome')
                    ->required()
                    ->label('Fornecedor'),
                Forms\Components\Select::make('categorias')
                    ->relationship('categorias', 'nome')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('Selecione uma ou mais categorias')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('descricao')->maxLength(200)->columnSpanFull()->label('Descrição'),

                Fc\RichEditor::make('texto')->columnSpanFull()->fileAttachmentsDirectory('produtos/texto'),


                Fc\ToggleButtons::make('tem_url')
                    ->live()
                    ->formatStateUsing(fn($get) => $get('url_externa') !== null)
                    ->label('Como funcionará o orçamento para este produto?')
                    ->grouped()
                    ->options([
                        0 => 'Usar Formulário',
                        1 => 'Usar Link'
                    ])
                    ->afterStateUpdated(function ($set) {
                        $set('url', null);
                    })
                    ->dehydrated(true),
                Fc\TextInput::make('url_externa')
                    ->columnSpanFull()
                    ->required()
                    ->visible(fn($get) => $get('tem_url'))
                    ->dehydratedWhenHidden(false)
                    ->label('Link de Contratação')
                    ->placeholder('Copie e cole o link desejado aqui.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('descricao')
                //     ->wrap()
                //     ->label('Descrição')
                //     ->searchable(),
                TextColumn::make('parceiro.nome')->label('Fornecedor'),
                TextColumn::make('categorias.nome')->badge(),

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
