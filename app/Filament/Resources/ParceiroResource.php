<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Enums\Proporcao;
use App\Models\Parceiro;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Nette\Utils\ImageColor;
use Filament\Resources\Resource;
use Filament\Forms\Components as Fc;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ParceiroResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ParceiroResource\RelationManagers;

class ParceiroResource extends Resource
{
    protected static ?string $model = Parceiro::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Fc\Repeater::make('imagens')
                ->relationship()
                ->deletable(false)
                ->addable(false)
                ->maxItems(2)
                ->itemLabel(fn ($state) => Proporcao::tryFrom($state['proporcao'])?->name ?? 'Logo')
                ->formatStateUsing(fn ($state, $operation) => $state && $operation === 'edit' ? $state : [
                    ['proporcao' => Proporcao::QUADRADO->value],
                    ['proporcao' => null]
                ])
                ->columnSpanFull()
                ->grid(2)
                ->schema(fn ($operation) => [
                    Fc\FileUpload::make('caminho')
                        ->required()
                        ->acceptedFileTypes(['image/png', 'image/webp'])
                        ->label('Imagem')
                        ->imageEditor()
                        ->downloadable()
                        ->imageCropAspectRatio(fn ($get) => Proporcao::tryFrom($get('proporcao'))?->value)
                        ->directory('parceiros'),
                    Fc\Hidden::make('proporcao')
                ]),
                Fc\TextInput::make('nome')->required(),
                Fc\Textarea::make('descricao')->label('Descrição')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem.caminho')->height(20)->grow(false),
                Tables\Columns\TextColumn::make('nome')->grow(true)
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
            'index' => Pages\ListParceiros::route('/'),
            'create' => Pages\CreateParceiro::route('/create'),
            'edit' => Pages\EditParceiro::route('/{record}/edit'),
        ];
    }
}
