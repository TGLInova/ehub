<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use Filament\Tables;
use App\Models\Empresa;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Livewire\Attributes\Computed;
use Filament\Forms\Contracts\HasForms;
use App\Filament\Clusters\Preferencias;
use Filament\Tables\Contracts\HasTable;
use Filament\Pages\SubNavigationPosition;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Clusters\Preferencias\Pages\Concerns\HasSubnavigationOnTop;

abstract class AbstractRelationManager extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $cluster = Preferencias::class;

    protected static string $view = 'filament.clusters.table';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    abstract public function getRelationshipName(): string;

    #[Computed]
    protected function empresa(): Empresa
    {
        return Filament::auth()->user()->empresa;
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->createAction()
        ];
    }

    protected function getRelationshipQuery()
    {
        return $this->empresa()->{$this->getRelationshipName()}()->getQuery();
    }

    /**
     * Essa implementação é necessaria para o BelognsToMany
     */
    public function getRelationship()
    {
        return $this->empresa()->{$this->getRelationshipName()}();
    }

    public function createAction()
    {
        $empresa = $this->empresa;

        return Action::make('create')
            ->label('Criar')
            ->slideOver()
            ->form($this->form(...))
            ->action(function (Action $action, array $data) use ($empresa) {
                $empresa->{$this->getRelationshipName()}()->create($data);
                $action->successNotificationTitle('Criado com sucesso!');
                $action->success();
            });
    }

    public function editAction()
    {
        return Tables\Actions\Action::make('edit')
            ->slideOver()
            ->icon('heroicon-o-pencil-square')
            ->fillForm(fn($record) => $record->attributesToArray())
            ->form($this->form(...))
            ->label('Editar')
            ->action(function ($record, Tables\Actions\Action $action, array $data) {
                $record->update($data);
                $action->successNotificationTitle('Salvo com sucesso!');
                $action->success();
            });
    }

    public static function canAccess(): bool
    {
        return Filament::auth()->user()->empresa_id !== null;
    }
}
