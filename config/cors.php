<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],

    'allowed_origins' => env('APP_ENV') === 'production'
        ? [env('CORS_ALLOWED_ORIGINS')]
        : ['*'], // В dev разрешаем все запросы

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],
    //'allowed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],
    //'exposed_headers' => ['Authorization', 'X-RateLimit-Remaining'],
    'max_age' => 86400,

    'supports_credentials' => true,

];
