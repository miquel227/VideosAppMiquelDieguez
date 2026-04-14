<?php

return [

    'default_user' => [
        'name'     => env('DEFAULT_USER_NAME', 'User'),
        'email'    => env('DEFAULT_USER_EMAIL', 'user@videosapp.com'),
        'password' => env('DEFAULT_USER_PASSWORD', 'password'),
    ],

    'default_professor' => [
        'name'     => env('DEFAULT_PROFESSOR_NAME', 'Professor'),
        'email'    => env('DEFAULT_PROFESSOR_EMAIL', 'professor@videosapp.com'),
        'password' => env('DEFAULT_PROFESSOR_PASSWORD', 'password'),
    ],

];
