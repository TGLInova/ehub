<?php

namespace App\Observers;

use App\Models\Empresa;
use Illuminate\Support\Facades\File;

class EmpresaObserver
{
    /**
     * Handle the Empresa "created" event.
     */
    public function created(Empresa $empresa): void
    {

        $paginas = json_decode(File::get(__DIR__ . '/../../database/seeders/EmpresaPaginasPadrao.json'), true);

        $empresa->paginas()->createMany($paginas);
    }

    /**
     * Handle the Empresa "updated" event.
     */
    public function updated(Empresa $empresa): void
    {
        //
    }

    /**
     * Handle the Empresa "deleted" event.
     */
    public function deleted(Empresa $empresa): void
    {
        //
    }

    /**
     * Handle the Empresa "restored" event.
     */
    public function restored(Empresa $empresa): void
    {
        //
    }

    /**
     * Handle the Empresa "force deleted" event.
     */
    public function forceDeleted(Empresa $empresa): void
    {
        //
    }
}
