<?php

return [


    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),

    ],


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'company' => [
            'driver' => 'session',
            'provider' => 'companies',
        ],
        'recruiter' => [
            'driver' => 'session',
            'provider' =>'recruiters',
        ],
        'webadmin' => [
            'driver' => 'session',
            'provider' => 'webadminlogin',
        ],
        'thirdparty' => [
            'driver' => 'session',
            'provider' =>'thirdpartylogin',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'companies' => [
            'driver' => 'eloquent',
            'model' => App\Models\Company::class,
        ],
        'recruiters' => [
            'driver' => 'eloquent',
            'model' => App\Models\Recruiter::class,
        ],
        'webadminlogin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Webadmin::class,
        ],
        'thirdpartylogin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Thirdparty::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
        
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'companies' => [
        'provider' => 'companies',
        'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
        'expire' => 60,
        'throttle' => 60,
        ],

        'recruiters' => [
            'provider' => 'recruiters',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'webadminlogin' => [
            'provider' => 'webadminlogin',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'thirdpartylogin' => [
            'provider' => 'thirdpartylogin',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        
    ],


    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
