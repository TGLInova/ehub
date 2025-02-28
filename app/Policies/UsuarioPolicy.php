<?php

namespace App\Policies;

use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class UsuarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $auth): bool
    {
        return $auth->empresa_id === null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Usuario $auth): bool
    {
        return $auth->empresa_id === null || $usuario->id === $auth->id;
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
    public function update(Usuario $usuario, Usuario $auth): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Usuario $auth): bool
    {
        return $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Usuario $auth): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Usuario $auth): bool
    {
        return false;
    }
}
