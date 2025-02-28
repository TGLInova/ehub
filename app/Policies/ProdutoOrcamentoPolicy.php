<?php

namespace App\Policies;

use App\Models\ProdutoOrcamento;
use App\Models\Usuario;
use Illuminate\Auth\Access\Response;

class ProdutoOrcamentoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, ProdutoOrcamento $produtoOrcamento): bool
    {
        return $usuario->empresa_id === $produtoOrcamento->empresa_id || $usuario->empresa_id === null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, ProdutoOrcamento $produtoOrcamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, ProdutoOrcamento $produtoOrcamento): bool
    {
        return $usuario->empresa_id === $produtoOrcamento->empresa_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, ProdutoOrcamento $produtoOrcamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, ProdutoOrcamento $produtoOrcamento): bool
    {
        return false;
    }
}
