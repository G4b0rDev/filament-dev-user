<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Test User Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the default admin user credentials that will be created
    | automatically when running migrations in local or testing environments.
    |
    */
    'user' => [
        'admin_email' => env('FILAMENT_ADMIN_EMAIL', 'test@example.com'),
        'admin_password' => env('FILAMENT_ADMIN_PASSWORD', 'password'),
        'admin_name' => env('FILAMENT_ADMIN_NAME', 'admin'),
    ],

    /*
    |--------------------------------------------------------------------------
    | User Model Configuration
    |--------------------------------------------------------------------------
    */
    'user_model' => App\Models\User::class,
];
