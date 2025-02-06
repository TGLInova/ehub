<?php

namespace App\Observers;

use App\Models\Parceiro;
use Filament\Notifications\Notification;

class ParceiroObserver
{
    /**
     * Handle the Parceiro "created" event.
     */
    public function created(Parceiro $parceiro): void
    {
        //
    }

    /**
     * Handle the Parceiro "updated" event.
     */
    public function updated(Parceiro $parceiro): void
    {
        //
    }

    /**
     * Handle the Parceiro "deleted" event.
     */
    public function deleting(Parceiro $parceiro)
    {
        if ($parceiro->produtos()->count() > 0) {
            Notification::make()
                ->title('Não foi possível deletar, pois o parceiro possui produtos.')
                ->send();
            return false;
        }

        $parceiro->imagem()->delete();
    }

    /**
     * Handle the Parceiro "restored" event.
     */
    public function restored(Parceiro $parceiro): void
    {
        //
    }

    /**
     * Handle the Parceiro "force deleted" event.
     */
    public function forceDeleted(Parceiro $parceiro): void
    {
        //
    }
}
