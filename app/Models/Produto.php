<?php

namespace App\Models;

use App\Enums\Proporcao;
use App\Observers\ProdutoObserver;
use App\Services\Workspace;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(ProdutoObserver::class)]
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

    public function imagemCapa()
    {
        return $this->imagens()->one()->ofMany(['id' => 'MAX'], fn ($query) => $query->where('proporcao', '=', Proporcao::ULTRAWIDE));
    }

    public function parceiro(): BelongsTo
    {
        return $this->belongsTo(Parceiro::class, 'parceiro_id');
    }

    public function empresas(): BelongsToMany
    {
        return $this->belongsToMany(Empresa::class, 'empresas_produtos')->withPivot(['url']);
    }

    public function empresaProdutos()
    {
        return $this->hasMany(EmpresaProduto::class, 'produto_id');
    }

    public function orcamentos(): HasMany
    {
        return $this->hasMany(ProdutoOrcamento::class, 'produto_id');
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categorias_produtos');
    }

    // public function getUrlAttribute()
    // {
    //     return route(
    //         'empresa.produto.show',
    //         ['empresa' => app('workspace.empresa'), 'produto' => $this]
    //     );
    // }

    public function getUrl(Empresa $empresa)
    {
        return route(
            'empresa.produto.show',
            ['empresa' => $empresa, 'produto_id' => $this->getKey()]
        );
    }
}
