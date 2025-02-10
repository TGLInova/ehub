<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPagina extends Model
{
    protected $table = 'empresa_paginas';

    protected $fillable = ['nome', 'slug', 'descricao', 'empresa_id', 'dados'];


    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    protected function casts(): array
    {
        return [
            'dados' => 'array',
        ];
    }
}
