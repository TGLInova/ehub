<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmpresaResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageProdutos extends ManageRelatedRecords
{
    protected static string $resource = EmpresaResource::class;

    protected static string $relationship = 'produtos';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $title = 'Produtos da Empresa';

    public static function getNavigationLabel(): string
    {
        return 'Produtos';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('parceiro.nome')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ]);
    }
}
