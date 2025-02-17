<?php

namespace App\Models;

use App\Enums\Proporcao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'parceiro_id', 'texto'];

    public function imagens(): MorphMany
    {
        return $this->morphMany(Midia::class, 'model');
    }

    public function imagem()
    {
        return $this->imagens()->one()->ofMany(['id' => 'MAX'], fn ($query) => $query->where('proporcao', '=', Proporcao::QUADRADO));
    }

    public function cover()
    {
        return $this->imagens()->one()->ofMany(['id' => 'MAX'], fn ($query) => $query->where('proporcao', '=', Proporcao::WIDESCREEN));
    }

    public function parceiro(): BelongsTo
    {
        return $this->belongsTo(Parceiro::class, 'parceiro_id');
    }

    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class, 'empresas_produtos');
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categorias_produtos');
    }
}
