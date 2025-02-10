<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmpresaPaginaResource\Pages;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use App\Filament\Resources\EmpresaPaginaResource\RelationManagers;

class EmpresaPaginaResource extends Resource
{
    protected static ?string $model = EmpresaPagina::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $pluralModelLabel = 'Páginas';

    protected static ?string $modelLabel = 'Página';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([

                Fc\Builder::make('dados')
                    ->blockPreviews(areInteractive: true)
                    ->columnSpan(2)
                    ->addAction(fn($action) => $action->slideOver())
                    ->editAction(fn($action) => $action->slideOver())
                    ->collapsible()
                    ->blocks([
                        Block::make('ui.empresa-hero')->label('Banner')->schema(
                            static::componentBanner()
                        ),

                        Block::make('produtos.index')
                            ->label('Seção de Produtos')
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

                        Block::make('produtos.slider')
                            ->label('Slides de Produto')
                            ->previewData(fn() => [
                                'empresa'  => Filament::auth()->user()->empresa,
                                'produtos' => Produto::take(4)->get(),
                            ])
                            ->schema([]),
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
                            ->rules(fn(?EmpresaPagina $record) => [
                                Rule::unique(EmpresaPagina::class, 'slug')
                                    ->when($record, fn($query) => $query->where('empresa_id', $record?->empresa_id))
                                    ->ignore($record?->getKey())
                            ])
                            ->suffixAction(Fc\Actions\Action::make('home')
                                ->icon('heroicon-o-home')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Página')
                    ->url(fn(EmpresaPagina $record) => route('empresa.dinamica', ['empresa' => $record->empresa, 'slug' => $record->slug]), true)
                    ->searchable(),
                // Tables\Columns\TextColumn::make('descricao')->searchable(),
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
