<?php

namespace App\Policies;

use App\Models\EmpresaPagina;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class EmpresaPaginaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $this->create($usuario);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, EmpresaPagina $empresaPagina): bool
    {
        return $usuario->empresa_id === null || $usuario->empresa_id === $empresaPagina->empresa_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return filled($usuario->empresa_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, EmpresaPagina $empresaPagina): bool
    {
        return $usuario->empresa_id === $empresaPagina->empresa_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, EmpresaPagina $empresaPagina): bool
    {
        return $usuario->empresa_id === $empresaPagina->empresa_id;
    }
}
