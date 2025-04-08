<?php

return [
    'user_model' => \App\Models\User::class,
    'grant_type' => [
        'password' => [
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
        ],
        'client_credentials' => [
            'client_id' => env('PASSPORT_CLIENT_CREDENTIALS_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_CREDENTIALS_CLIENT_SECRET'),
        ]
    ]
];
