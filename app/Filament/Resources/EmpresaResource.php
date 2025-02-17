<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components as Fc;
use App\Filament\Resources\EmpresaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Nette\Utils\ImageColor;
use WallaceMaxters\FilamentImageColorPicker\ImageColorPicker;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;


    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Fc\Group::make([
                    Fc\FileUpload::make('caminho')->required()->directory('empresas')->image()->imageEditor()
                ])->relationship('imagem')->columnSpanFull(),

                Fc\TextInput::make('nome')->required()->live(onBlur: true)->afterStateUpdated(function ($set, ?string $state) {
                    $set('slug', str($state)->slug());
                }),

                Fc\TextInput::make('razao_social')->label('Razão Social'),

                Fc\TextInput::make('email')->email()->required()->label('E-mail'),

                Fc\ColorPicker::make('cor')->suffixAction(
                    Fc\Actions\Action::make('pick_image_color')
                        ->icon('heroicon-o-eye-dropper')
                        ->slideOver()
                        ->form([
                            ImageColorPicker::make('cor')->required()->image(fn (Empresa $record) => $record->imagem?->url)->hex(),
                        ])->action(function (array $data, $set) {
                            $set('cor', $data['cor']);
                        })
                ),

                Fc\TextInput::make('slug')->unique(ignoreRecord: true)->maxLength(20)->required(),

                Fc\Fieldset::make('Endereço')->columns(4)->relationship('endereco')->schema([
                    Cep::make('cep')->viaCep(setFields: [
                        'logradouro' => 'logradouro',
                        'uf'         => 'uf',
                        'bairro'     => 'bairro',
                        'cidade'     => 'localidade',
                    ]),
                    Forms\Components\TextInput::make('logradouro')->columnSpan(2),
                    Forms\Components\TextInput::make('numero')->label('Nº'),
                    Forms\Components\TextInput::make('complemento'),
                    Forms\Components\TextInput::make('bairro')->required(),
                    Forms\Components\TextInput::make('cidade')->required(),
                    Forms\Components\TextInput::make('uf')->label('UF')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('razao_social')
                    ->label('Razão Social')
                    ->searchable(),
                TextColumn::make('produtos_count')->counts('produtos')->label('Produtos')->badge(),
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
                Tables\Actions\Action::make('preview')
                    ->icon('heroicon-o-eye')
                    ->label('Visualizar página')
                    ->url(
                        fn(Empresa $record) => route('empresa.home', ['empresa' => $record]),
                        true
                    ),
                Tables\Actions\Action::make('produtos')
                    ->label('Produtos')
                    ->icon('heroicon-o-star')
                    ->url(fn (Empresa $record) => static::getUrl('produtos', ['record' => $record])),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditEmpresa::class,
            Pages\ManageProdutos::class,
            Pages\ManageLinks::class,
            Pages\ManageTelefones::class
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
            'index'     => Pages\ListEmpresas::route('/'),
            'create'    => Pages\CreateEmpresa::route('/create'),
            'edit'      => Pages\EditEmpresa::route('/{record}/edit'),
            'produtos'  => Pages\ManageProdutos::route('{record}/produtos'),
            'links'     => Pages\ManageLinks::route('{record}/links'),
            'telefones' => Pages\ManageTelefones::route('{record}/telefones')
        ];
    }
}
