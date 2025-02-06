<?php

namespace App\Models;

use App\Observers\ParceiroObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(ParceiroObserver::class)]
class Parceiro extends Model
{
    protected $table = 'parceiros';

    protected $fillable = ['nome', 'descricao'];

    public function imagem()
    {
        return $this->morphOne(Midia::class, 'model');
    }

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'parceiro_id');
    }
}
