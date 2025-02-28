<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components as Fc;
use App\Filament\Resources\EmpresaResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\RawJs;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ManageTelefones extends ManageRelatedRecords
{
    protected static string $resource = EmpresaResource::class;

    protected static string $relationship = 'telefones';

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $title = 'Telefones da Empresa';

    public static function getNavigationLabel(): string
    {
        return 'Telefones';
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Fc\TextInput::make('nome')
                    ->placeholder('ex: Comercial, Contato, Sac, Ouvidoria, Financeiro')
                    ->columnSpanFull(),
                Fc\TextInput::make('numero')->required()->mask(RawJs::make(<<<'JS'
                    $input.length >= 15 ? '(99) 99999-9999' : '(99) 9999-9999'
                JS)),
                Fc\Toggle::make('whatsapp')->label('Este número possui whatsapp?')->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome'),
                TextColumn::make('numero')->label('Número'),
                IconColumn::make('whatsapp')->boolean()->label('Tem Whatsapp?')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->slideOver()->modalWidth(MaxWidth::Medium),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver()->modalWidth(MaxWidth::Medium),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
