<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpresaProduto extends Pivot
{
    protected $table = 'empresas_produtos';
}
