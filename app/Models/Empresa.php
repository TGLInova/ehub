<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Empresa extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'razao_social',
        'cor',
        'slug'
    ];

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'empresas_produtos')->using(EmpresaProduto::class);
    }

    public function links(): MorphMany
    {
        return $this->morphMany(Link::class, 'model');
    }

    public function telefones(): MorphMany
    {
        return $this->morphMany(Telefone::class, 'model');
    }

    public function endereco(): MorphOne
    {
        return $this->morphOne(Endereco::class, 'model');
    }
}
