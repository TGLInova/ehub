<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPaginaComponente extends Model
{
    protected $fillable = ['empresa_pagina_id', 'componente', 'ordem', 'dados'];

    protected function casts()
    {
        return [
            'dados' => 'collection',
        ];
    }
}
