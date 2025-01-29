<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nome', 'razao_social', 'cor'];

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }
}
