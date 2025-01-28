<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }
}
