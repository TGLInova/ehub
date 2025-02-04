<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Telefone extends Model
{
    protected $fillable = ['numero', 'nome', 'whatsapp'];

    protected $casts = [
        'whatsapp' => 'boolean'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::make(get: function ($_, array $data) {

            $numero = preg_replace('/\D+/', '', $this->numero);

            $template = $this->whatsapp ? 'https://wa.me/55%d' : 'tel:+55%d';

            return sprintf($template, $numero);

        })->shouldCache(true);
    }
}
