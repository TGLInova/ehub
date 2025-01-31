<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'bairro',
        'cep',
        'cidade',
        'complemento',
        'ibge',
        'logradouro',
        'numero',
        'uf'
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
