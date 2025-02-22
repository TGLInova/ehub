<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoOrcamento extends Model
{
    protected $fillable = ['produto_id', 'empresa_id', 'nome', 'email', 'telefone'];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
