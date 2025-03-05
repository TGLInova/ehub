<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Preferencias\Pages\EditEmpresa;
use Filament\Forms;
use Filament\Tables;
use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components as Fc;
use App\Filament\Resources\EmpresaResource\Pages;
use App\Filament\Resources\ParceiroResource\Pages\EditParceiro;
use Filament\Facades\Filament;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Nette\Utils\ImageColor;
use WallaceMaxters\FilamentImageColorPicker\ImageColorPicker;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Cliente';

    protected static ?string $pluralModelLabel = 'Clientes';

    public static function form(Form $form): Form
    {
        /**
         * @var Usuario
         */
        $usuario = Filament::auth()->user();

        return $form
            ->columns(['lg' => 3])
            ->schema([
                Fc\Group::make([
                    Fc\FileUpload::make('caminho')->label('Logo')->required()->directory('empresas')->image()->imageEditor()
                ])->relationship('imagem')->columnSpanFull(),

                Fc\Fieldset::make('Dados Principais')->columns(3)->schema([
                    Fc\TextInput::make('nome')->required()->live(onBlur: true)->afterStateUpdated(function ($set, ?string $state) {
                        $set('slug', str($state)->slug());
                    }),

                    Fc\TextInput::make('razao_social')->columnSpan(['lg' => 2])->label('Razão Social'),

                    Fc\TextInput::make('email')->email()->required()->label('E-mail'),

                    Fc\TextInput::make('slug')
                        ->disabled(fn($operation) => $operation === EditEmpresa::class && $usuario->empresa_id !== null)
                        ->unique(ignoreRecord: true)->maxLength(20)->required()->suffix('.ehub.com.br')->label('Domínio'),


                    Fc\ColorPicker::make('cor')
                        ->hex()
                        ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/i')
                        ->validationMessages(['regex' => 'Código inválido! Adicione # antes do código da cor.'])
                        ->suffixAction(
                            Fc\Actions\Action::make('pick_image_color')
                                ->icon('heroicon-o-eye-dropper')
                                ->slideOver()
                                ->visible(fn($record) => $record?->imagem !== null)
                                ->form([
                                    ImageColorPicker::make('cor')->required()->image(fn(Empresa $record) => $record->imagem?->url)->hex(),
                                ])->action(function (array $data, $set) {
                                    $set('cor', $data['cor']);
                                })
                        ),
                ]),



                Fc\Fieldset::make('Endereço')->columns(['lg' => 4])->relationship('endereco')->schema([
                    Cep::make('cep')->viaCep(setFields: [
                        'logradouro' => 'logradouro',
                        'uf'         => 'uf',
                        'bairro'     => 'bairro',
                        'cidade'     => 'localidade',
                    ]),
                    Forms\Components\TextInput::make('logradouro')->columnSpan(['lg' => 2]),
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
                TextColumn::make('produtos_count')->counts('produtos')->label('Benefícios')->badge(),


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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('preview')
                        ->icon('heroicon-o-eye')
                        ->label('Visualizar página')
                        ->visible(fn(Empresa $record) => $record->paginas()->count())
                        ->url(
                            fn(Empresa $record) => $record->paginas()->first()->url,
                            true
                        ),
                    Tables\Actions\Action::make('produtos')
                        ->label('Benefícios')
                        ->icon('heroicon-o-star')
                        ->url(fn(Empresa $record) => static::getUrl('produtos', ['record' => $record])),

                    Tables\Actions\Action::make('links')
                        ->label('Links')
                        ->icon('heroicon-o-link')
                        ->url(fn(Empresa $record) => static::getUrl('links', ['record' => $record])),

                    Tables\Actions\Action::make('telefone')
                        ->label('Telefones')
                        ->icon('heroicon-o-phone')
                        ->url(fn(Empresa $record) => static::getUrl('telefones', ['record' => $record])),
                ])
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
