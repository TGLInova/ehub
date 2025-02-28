<?php

namespace App\Filament\Clusters\Preferencias\Pages;

use App\Filament\Clusters\Preferencias;
use App\Filament\Clusters\Preferencias\Pages\Concerns\HasSubnavigationOnTop;
use App\Filament\Resources\EmpresaResource;
use App\Models\Empresa;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Support\Exceptions\Halt;
use Livewire\Attributes\Computed;

class EditEmpresa extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $title = 'Dados da Empresa';

    protected static string $view = 'filament.clusters.form';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $cluster = Preferencias::class;

    public ?array $data = [];

    #[Computed]
    protected function empresa(): ?Empresa
    {
        return Filament::auth()->user()->empresa;
    }

    public function mount(): void
    {
        $this->form->fill(
            $this->empresa->attributesToArray()
        );
    }

    public function form(Form $form): Form
    {
        return EmpresaResource::form($form)->model($this->empresa)->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $this->empresa->update($data);

            Notification::make()->title('Dados da sua empresa salvos com sucesso!')->success()->send();

        } catch (Halt $exception) {
            return;
        }
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public static function canAccess(): bool
    {
        return Filament::auth()->user()->empresa_id !== null;
    }
}
