<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpresaProduto extends Pivot
{
    protected $table = 'empresas_produtos';

    public $timestamps = false;

    protected $fillable = ['empresa_id', 'produto_id', 'url'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
