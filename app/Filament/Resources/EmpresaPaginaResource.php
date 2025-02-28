<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Empresa;
use App\Models\Produto;
use Filament\Forms\Set;
use App\Models\Parceiro;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\EmpresaPagina;
use Filament\Facades\Filament;
use App\Forms\Components\Block;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components as Fc;
use Illuminate\Support\Facades\Blade;
use Filament\Support\Enums\ActionSize;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmpresaPaginaResource\Pages;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use App\Filament\Resources\EmpresaPaginaResource\RelationManagers;
use App\Models\Categoria;
use App\Services\Workspace;
use Filament\Tables\Columns\ToggleColumn;

class EmpresaPaginaResource extends Resource
{
    protected static ?string $model = EmpresaPagina::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $pluralModelLabel = 'Páginas';

    protected static ?string $modelLabel = 'Página';

    public static function form(Form $form): Form
    {
        $usuario = Filament::auth()->user();
        $empresa = $usuario->empresa;

        return $form
            ->columns(3)
            ->schema([

                Fc\Builder::make('dados')
                    ->blockPreviews(areInteractive: false)
                    ->label(false)
                    ->columnSpan(2)
                    ->addAction(fn($action) => $action->slideOver())
                    ->editAction(fn($action) => $action->slideOver())
                    ->collapsible()
                    ->blocks([
                        Block::make('ui.empresa-hero')->label('Banner')->schema(
                            static::componentBanner()
                        ),

                        Block::make('categorias.index')
                            ->label('Seção de Categorias')
                            ->previewData(fn() => [
                                'empresa'    => $empresa,
                                'categorias' => Categoria::get(),
                            ])
                            ->schema([]),


                        Block::make('produtos.index')
                            ->label('Seção de Produtos/Serviços')
                            ->previewData(fn() => [
                                'produtos' => Produto::take(4)->get(),
                            ])
                            ->schema(static::componentProdutos()),

                        Block::make('parceiros.index')
                            ->label('Seção de Parceiros')
                            ->previewData(fn() => [
                                'parceiros' => Parceiro::take(6)->get(),
                            ])
                            ->schema(static::componentParceiros()),

                        Block::make('produtos.destaque')
                            ->label('Produto/Serviço em Destaque')
                            ->previewData(fn() => [
                                'empresa'  => $empresa,
                            ])
                            ->schema(static::componentsProdutoDestaque()),
                    ]),


                Fc\Section::make()
                    ->columnSpan(1)
                    ->schema([

                        Forms\Components\TextInput::make('nome')
                            ->required()

                            ->live(onBlur: true)
                            ->afterStateUpdated(static function (?string $state, string $operation, Set $set) {

                                if ($operation === 'create') {

                                    if (str($state)->lower()->is(['home', 'inicio', 'página inicial'])) {
                                        $slug = '/';
                                    } else {
                                        $slug = str($state)->rtrim('/')->slug('-')->start('/');
                                    }


                                    $set('slug', $slug);
                                }
                            })
                            ->maxLength(80),
                        Fc\TextInput::make('slug')
                            ->required()
                            ->live(onBlur: 500)
                            ->helperText(fn ($state) => 'A página será: https://' . $empresa->slug . '.ehubbrasil.com.br/' . ltrim($state, '/'))
                            ->rules(fn(?EmpresaPagina $record) => [
                                Rule::unique(EmpresaPagina::class, 'slug')
                                    ->when($record, fn($query) => $query->where('empresa_id', $record?->empresa_id))
                                    ->ignore($record?->getKey())
                            ])
                            ->suffixAction(Fc\Actions\Action::make('home')
                                ->icon('heroicon-o-home')
                                ->label('Tornar a página principal')
                                ->requiresConfirmation()
                                ->action(function (Set $set) {
                                    $set('slug', '/');
                                }))
                            ->maxLength(255),
                        Forms\Components\Textarea::make('descricao')->label('Descrição')->maxLength(200),
                    ])
            ]);
    }

    private static function componentBanner()
    {
        return [
            Fc\FileUpload::make('image')
                ->label('Imagem')
                ->multiple(false)
                ->image()
                ->imageEditor()
                ->maxSize(2000)
                ->directory('empresas_paginas'),
            Fc\TextInput::make('title')->label('Título')->maxLength(80)->required(),
            Fc\Textarea::make('description')->label('Descrição')->maxLength(200)->required(),

            Fc\Grid::make(['lg' => 2])->schema([
                Fc\TextInput::make('buttonUrl')->label('Link do Cta')->suffixIcon('heroicon-o-link'),
                Fc\TextInput::make('buttonText')->label('Texto do Cta')->maxLength(30)->default(fn() => 'Saiba mais'),
            ])

        ];
    }

    private static function componentProdutos()
    {
        return [
            Fc\TextInput::make('title')
                ->label('Título')
                ->maxLength(80)
                ->required(),
            Fc\Textarea::make('subtitle')->label('Subtitulo')->maxLength(200)->required(),
        ];
    }

    private static function componentParceiros()
    {
        return [
            Fc\TextInput::make('title')->label('Título')->maxLength(80)
                ->required()
                ->formatStateUsing(fn($state) => $state === null ? 'Empresas que trabalham para gente' : $state),
        ];
    }

    private static function componentsProdutoDestaque()
    {
        return static function () {

            $empresa = Filament::auth()->user()->empresa;
            /**
             * @var Collection
             */
            $produtos = $empresa ? $empresa->produtos()->get() : Produto::get();

            return [
                Fc\Select::make('produto_id')->label('Produto')->hint('Opcional')->options($produtos->pluck('nome', 'id'))->live()->afterStateUpdated(function ($state, Set $set) use ($empresa, $produtos) {
                    $produto = $produtos->first(fn($item) => $item->id == $state);
                    if ($produto === null) return;

                    $set('title', $produto->nome);
                    $set('text', $produto->descricao);
                    $produto->imagemCapa?->caminho && $set('image',  [$produto->imagemCapa?->caminho]);
                    $set('url', route('empresa.produto.show', [
                        'empresa' => $empresa,
                        'produto' => $produto,
                    ]));
                }),
                Fc\TextInput::make('title')->label('Título')->required(),
                Fc\Textarea::make('text')->label('Descrição')->required(),
                Fc\FileUpload::make('image')->image()->imageEditor()->required()->directory('empresas_paginas'),
                Fc\TextInput::make('url')->label('Link do Botão')->required(),
            ];
        };
    }

    public static function table(Table $table): Table
    {
        $usuario = Filament::auth()->user();

        return $table
            ->modifyQueryUsing(fn($query) => $query->where('empresa_id', $usuario->empresa_id))
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Página')
                    ->url(fn(EmpresaPagina $record) => $record->url, true)
                    ->searchable(),
                ToggleColumn::make('menu'),
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
            'index' => Pages\ListEmpresaPaginas::route('/'),
            'create' => Pages\CreateEmpresaPagina::route('/create'),
            'edit' => Pages\EditEmpresaPagina::route('/{record}/edit'),
        ];
    }
}
