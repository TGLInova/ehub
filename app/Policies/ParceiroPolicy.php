<?php

namespace App\Policies;

use App\Models\Parceiro;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class ParceiroPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Parceiro $parceiro): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Parceiro $parceiro): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Parceiro $parceiro): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Parceiro $parceiro): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Parceiro $parceiro): bool
    {
        return false;
    }
}
