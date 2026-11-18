<?php

return [
    'admin' => [
        'name' => env('BIMBELPRO_ADMIN_NAME', 'Admin BimbelPro'),
        'email' => env('BIMBELPRO_ADMIN_EMAIL', 'admin@bimbelpro.com'),
        'password' => env('BIMBELPRO_ADMIN_PASSWORD'),
    ],

    'tutor' => [
        'name' => env('BIMBELPRO_TUTOR_NAME', 'Tutor BimbelPro'),
        'email' => env('BIMBELPRO_TUTOR_EMAIL', 'tutor@bimbelpro.com'),
        'password' => env('BIMBELPRO_TUTOR_PASSWORD'),
    ],
];