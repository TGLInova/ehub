<?php
namespace App\Filament\Clusters\Preferencias\Pages\Concerns;

use Filament\Pages\SubNavigationPosition;

trait HasSubnavigationOnTop
{
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
}
