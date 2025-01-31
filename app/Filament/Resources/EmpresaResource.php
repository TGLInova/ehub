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
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Nette\Utils\ImageColor;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fc\Group::make([
                    Fc\FileUpload::make('caminho')->required()->directory('empresas')->image()->imageEditor()
                ])->relationship('imagem'),
                Fc\TextInput::make('nome')
                    ->required(),
                Fc\TextInput::make('razao_social'),

                Fc\ColorPicker::make('cor')
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
            'links'     => Pages\ManageLinks::route('{record}/links')
        ];
    }
}
