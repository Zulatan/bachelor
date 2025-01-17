<?php
return [
    'paths' => ['*', 'api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'], # what type of https request are allowed? GET, POST PUT etc etc
    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:3000')], #what origins are allowed to send requests
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
  