<?php

return [
    'user_model' => \App\Models\User::class,
    'grant_type' => [
        'password' => [
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
        ],
        'personal' => [
            'client_id' => env('PASSPORT_PERSONAL_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PERSONAL_CLIENT_SECRET'),
        ],
    ]
];
