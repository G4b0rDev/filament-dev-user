<?php

declare(strict_types=1);

namespace G4b0rDev\FilamentDevUser\Tests\Filament;

use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->default();
    }
}
