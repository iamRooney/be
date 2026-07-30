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

    'allowed_methods' => ['*'],

    // The Next.js frontend runs on :3000 during local dev. Add production
    // domains here once deployed (e.g. 'https://exbhex.com').
    'allowed_origins' => explode(',', env('FRONTEND_URLS', 'http://localhost:3000,http://127.0.0.1:3000')),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // We authenticate with a Sanctum bearer token (Authorization header),
    // not cookies, so credentials support isn't required. Flip to true only
    // if you switch to Sanctum's cookie-based SPA auth.
    'supports_credentials' => false,

];
