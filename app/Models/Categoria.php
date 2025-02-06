<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
    protected $fillable = ['nome', 'icone', 'descricao'];

    protected $table = 'categorias';

    public $timestamps = false;

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'categorias_produtos');
    }
}
