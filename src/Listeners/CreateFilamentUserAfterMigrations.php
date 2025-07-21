<?php

declare(strict_types=1);

namespace G4b0rDev\FilamentDevUser\Listeners;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class CreateFilamentUserAfterMigrations
{
    protected ?Model $userModel = null;

    public function handle(MigrationsEnded $event): void
    {
        if (! App::environment(['local', 'testing'])) {
            return;
        }

        $this->userModel = app(config('filament-dev-user.user_model'));

        if ($this->existsUser()) {
            return;
        }

        Artisan::call('make:filament-user', [
            '--name' => config('filament-dev-user.user.admin_name'),
            '--email' => config('filament-dev-user.user.admin_email'),
            '--password' => config('filament-dev-user.user.admin_password'),
        ]);

        $this->verifyUser();
    }

    protected function existsUser(): bool
    {
        return $this->userModel::where('email', config('filament-dev-user.user.admin_email'))->exists();
    }

    protected function verifyUser(): void
    {
        $user = $this->userModel::where('email', config('filament-dev-user.user.admin_email'))->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->save();
        }
    }
}
