<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';

    protected $fillable = ['nome', 'area_atuacao', 'email', 'telefone', 'cargo'];
}
