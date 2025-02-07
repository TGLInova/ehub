<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPagina extends Model
{
    protected $table = 'empresa_paginas';

    protected $fillable = ['nome', 'slug', 'descricao', 'empresa_id'];

    public function componentes()
    {
        return $this->hasMany(EmpresaPaginaComponente::class, 'empresa_pagina_id');
    }
}
