<?php

declare(strict_types=1);

namespace G4b0rDev\FilamentDevUser\Tests;

use Filament\FilamentServiceProvider;
use G4b0rDev\FilamentDevUser\FilamentDevUserServiceProvider;
use G4b0rDev\FilamentDevUser\Tests\Filament\AdminPanelProvider;
use G4b0rDev\FilamentDevUser\Tests\Models\User;
use Illuminate\Contracts\Config\Repository;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Attributes\WithEnv;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\TestCase as Orchestra;

#[WithEnv('DB_CONNECTION', 'testing')]
#[WithMigration]
class TestCase extends Orchestra
{
    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set('filament-dev-user.user_model', User::class);
            $config->set('filament-dev-user.user.admin_name', 'Test Admin');
            $config->set('filament-dev-user.user.admin_email', 'admin@test.com');
            $config->set('filament-dev-user.user.admin_password', 'password123');
            $config->set('auth.providers.users.model', User::class);
        });
    }

    protected function getPackageProviders($app): array
    {
        return [
            FilamentServiceProvider::class,
            LivewireServiceProvider::class,
            AdminPanelProvider::class,
            FilamentDevUserServiceProvider::class,
        ];
    }
}
