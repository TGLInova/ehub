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

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Fornecedor';

    protected static ?string $pluralModelLabel = 'Fornecedores';


    protected static function fileUploadField(callable $callback, ?Proporcao $proporcao = null)
    {

        return Fc\Group::make()->schema([
            Fc\Hidden::make('proporcao')->formatStateUsing(fn() => $proporcao?->value),

            Fc\FileUpload::make('caminho')
                ->acceptedFileTypes(['image/png', 'image/webp', 'image/gif'])
                ->when(true, $callback)
                ->imageEditor()
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
                static::fileUploadField(static function (Fc\FileUpload $component) {
                    $component->label('Logo')->required();
                })->relationship('imagem'),
                static::fileUploadField(
                    fn(Fc\FileUpload $component) => $component->label('Ícone'),
                    Proporcao::QUADRADO
                )->relationship('icone', fn($state) => filled($state['caminho'])),
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
