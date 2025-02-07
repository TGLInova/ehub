<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpresaPaginaResource\Pages;
use App\Filament\Resources\EmpresaPaginaResource\RelationManagers;
use App\Models\EmpresaPagina;
use App\Models\Parceiro;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Components as Fc;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Components\ViewEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class EmpresaPaginaResource extends Resource
{
    protected static ?string $model = EmpresaPagina::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Fc\Repeater::make('componentes')
                    ->relationship('componentes')
                    ->collapsible()
                    ->extraItemActions([
                        Forms\Components\Actions\Action::make('preview')
                            ->icon('heroicon-o-eye')
                            ->slideOver()
                            ->size(ActionSize::ExtraLarge)
                            ->modalContent(function (array $arguments, Fc\Repeater $component) {
                                $data = $component->getRawItemState($arguments['item']);

                                $data['produtos'] = Produto::take(4)->get();
                                $data['parceiros'] = Parceiro::take(4)->get();

                                $html = view('components.filament.empresa-paginas.preview', $data)->render();

                                return new HtmlString(Blade::render(<<<'HTML'
                                    <iframe srcdoc="{{ $html }}" seamless class="w-full" style="zoom: 0.7" width="1600" height="100%" src="about:blank"></iframe>
                                HTML, compact('html')));

                            })
                    ])
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\Group::make()->schema([
                            Forms\Components\Select::make('componente')
                                ->required()
                                ->live()
                                ->options([
                                    'ui.empresa-hero' => 'Banner',
                                    'produtos.list'   => 'Produtos',
                                    'parceiros.index'  => 'Parceiros',
                                ]),
                            Forms\Components\Fieldset::make()->statePath('dados')->default([])->columns(1)->schema(static function ($get) {

                                $result = match ($get('componente')) {
                                    'ui.empresa-hero'  => static::componentBanner(),
                                    'produtos.list' => static::componentProdutos(),
                                    'parceiros.index' => static::componentParceiros(),
                                    default => []
                                };

                                return $result;
                            }),


                        ])
                    ]),

                Fc\Section::make()->columnSpan(1)->schema([
                    Forms\Components\TextInput::make('nome')
                        ->required()
                        ->maxLength(80),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('descricao')
                        ->maxLength(200),
                ])
            ]);
    }

    private static function componentBanner()
    {
        return [
            Fc\TextInput::make('title')->label('Título')->maxLength(80)->required(),
            Fc\Textarea::make('description')->label('Descrição')->maxLength(200)->required(),
            Fc\TextInput::make('buttonUrl')->label('Link do Cta'),
            Fc\TextInput::make('buttonText')->label('Texto do Cta')->maxLength(30)->default(fn() => 'Saiba mais'),
        ];
    }

    private static function componentProdutos()
    {
        return [
            Fc\TextInput::make('title')->label('Título')->maxLength(80)->required(),
            Fc\Textarea::make('subtitle')->label('Subtitulo')->maxLength(200)->required(),
        ];
    }

    private static function componentParceiros()
    {
        return [
            Fc\TextInput::make('title')->label('Título')->maxLength(80)->required(),
            Fc\Textarea::make('subtitle')->label('Subtitulo')->maxLength(200)->required(),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descricao')
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
