<?php

namespace App\Observers;

use App\Models\Produto;

class ProdutoObserver
{
    /**
     * Handle the Produto "created" event.
     */
    public function created(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "updated" event.
     */
    public function updated(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "deleted" event.
     */
    public function deleting(Produto $produto): void
    {
        $produto->empresas()->detach();
        $produto->categorias()->detach();
    }

    /**
     * Handle the Produto "restored" event.
     */
    public function restored(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "force deleted" event.
     */
    public function forceDeleted(Produto $produto): void
    {
        //
    }
}
