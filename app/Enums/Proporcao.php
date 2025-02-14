<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Proporcao: string implements HasLabel
{
    case QUADRADO = '1:1';
    case WIDESCREEN = '16:9';
    case RETRATO = '3:4';
    case PAISAGEM = '4:3';
    case ULTRAWIDE = '21:9';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
