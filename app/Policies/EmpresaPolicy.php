<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class EmpresaPolicy
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
    public function view(Usuario $usuario, Empresa $empresa): bool
    {
        return $usuario->empresa_id === null;
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
    public function update(Usuario $usuario, Empresa $empresa): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Empresa $empresa): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Empresa $empresa): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Empresa $empresa): bool
    {
        return $usuario->empresa_id === null;
    }
}
