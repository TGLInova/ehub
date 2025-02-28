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


    public function getEnderecoCompletoAttribute()
    {
        $endereco = $this->logradouro . ', ' . $this->numero;

        if ($this->complemento) {
            $endereco .= ', ' . $this->complemento . ' - ';
        }

        $endereco .= 'Bairro ' . $this->bairro . ' | ';

        $endereco .= $this->cidade . '/' . $this->uf;

        $endereco .= ' - ' . $this->cep;

        return $endereco;
    }

    public function model()
    {
        return $this->morphTo();
    }
}
