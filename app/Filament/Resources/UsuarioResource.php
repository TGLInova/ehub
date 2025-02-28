<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Filament\Resources\UsuarioResource\RelationManagers;
use App\Models\Usuario;
use Filament\Forms;
use Filament\Forms\Components as Fc;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UsuarioResource extends Resource
{
    protected static ?string $model = Usuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'Usuário';

    protected static ?string $slug = 'Usuários';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fc\Fieldset::make('Dados Principais')->columns(3)->schema([
                    Forms\Components\TextInput::make('nome')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('empresa_id')->relationship('empresa', 'nome')->label('Cliente'),
                ]),

                Fc\Fieldset::make('Senha')->schema([
                    Fc\TextInput::make('password')
                        ->password()
                        ->label('Senha')
                        ->revealable()
                        ->confirmed()
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->dehydrated(fn(?string $state): bool => filled($state))
                        ->required(fn(string $operation): bool => $operation === 'create'),

                    Fc\TextInput::make('password_confirmation')->password()
                        ->revealable()
                        ->label('Confirmação de Senha')
                        ->dehydrated(fn(?string $state): bool => filled($state)),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
                Tables\Columns\TextColumn::make('empresa.nome')
                    ->label('Cliente')
                    ->badge()
                    ->sortable(),


                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Data de Criação')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuario::route('/create'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
        ];
    }
}
