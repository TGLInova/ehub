<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Exceptions\UrlGenerationException;

class EmpresaPagina extends Model
{
    protected $table = 'empresa_paginas';

    protected $fillable = ['nome', 'slug', 'descricao', 'menu', 'empresa_id', 'dados'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function getUrlAttribute()
    {
        try {
            return route('empresa.dinamica', ['empresa' => $this->empresa, 'slug' => $this->slug ?: '']);
        } catch (UrlGenerationException) {
            return null;
        }
    }

    protected function casts(): array
    {
        return [
            'dados' => 'array',
        ];
    }
}
