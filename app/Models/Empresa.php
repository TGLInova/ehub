<?php

namespace App\Models;

use App\Observers\EmpresaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

#[ObservedBy(EmpresaObserver::class)]
class Empresa extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'razao_social',
        'cor',
        'slug',
        'email'
    ];

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'empresas_produtos')->using(EmpresaProduto::class)->withPivot(['url']);
    }

    public function links(): MorphMany
    {
        return $this->morphMany(Link::class, 'model');
    }

    public function telefones(): MorphMany
    {
        return $this->morphMany(Telefone::class, 'model');
    }

    public function enderecos(): MorphMany
    {
        return $this->morphMany(Endereco::class, 'model');
    }

    public function endereco(): MorphOne
    {
        return $this->morphOne(Endereco::class, 'model');
    }

    public function paginas()
    {
        return $this->hasMany(EmpresaPagina::class, 'empresa_id');
    }

    public function empresaProdutos()
    {
        return $this->hasMany(EmpresaProduto::class, 'empresa_id');
    }

}
