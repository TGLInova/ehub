<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Empresa extends Model
{
    protected $fillable = ['nome', 'razao_social', 'cor'];

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'empresas_produtos');
    }
}
