<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = ['ddd', 'numero', 'nome', 'whatsapp'];

    protected $casts = [
        'whatsapp' => 'boolean'
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
