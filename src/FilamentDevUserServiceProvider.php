<?php

declare(strict_types=1);

namespace G4b0rDev\FilamentDevUser;

use G4b0rDev\FilamentDevUser\Listeners\CreateFilamentUserAfterMigrations;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentDevUserServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-dev-user')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        if ($this->isListenerAlreadyRegistered()) {
            return;
        }

        Event::listen(
            MigrationsEnded::class,
            CreateFilamentUserAfterMigrations::class
        );
    }

    protected function isListenerAlreadyRegistered(): bool
    {
        return collect(Event::getListeners(MigrationsEnded::class))
            ->contains(fn ($listener) => $listener instanceof CreateFilamentUserAfterMigrations);
    }
}
