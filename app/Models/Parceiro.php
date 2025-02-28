<?php

namespace App\Models;

use App\Enums\Proporcao;
use App\Observers\ParceiroObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy(ParceiroObserver::class)]
class Parceiro extends Model
{
    protected $table = 'parceiros';

    protected $fillable = ['nome', 'descricao'];

    public function imagens(): MorphMany
    {
        return $this->morphMany(Midia::class, 'model');
    }

    public function icone()
    {
        return $this->imagens()->one()->ofMany(['id' => 'MAX'], fn ($query) => $query->where('proporcao', '=', Proporcao::QUADRADO));
    }

    public function imagem()
    {
        return $this->imagens()->one()->ofMany(['id' => 'MAX'], fn ($query) => $query->whereNull('proporcao'));
    }

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'parceiro_id');
    }
}
