<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components as Fc;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\EmpresaResource;
use Filament\Resources\Pages\ManageRelatedRecords;

class ManageLinks extends ManageRelatedRecords
{
    protected static string $resource = EmpresaResource::class;

    protected static string $relationship = 'links';

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $title = 'Links da Empresa';

    public static function getNavigationLabel(): string
    {
        return 'Links';
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Fc\TextInput::make('nome')->required()->maxLength(50),
                Fc\TextInput::make('url')->url()->required()->prefixIcon('heroicon-o-link')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('url')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->slideOver(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
