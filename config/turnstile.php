<?php

return [
    'site_key' => env('TURNSTILE_SITE_KEY') ?? '',
    'secret_key' => env('TURNSTILE_SECRET_KEY') ?? '',

    // Include visitor IP adresse in verify challenge data
    'include_ip' => false,

    // Allow access in case the HTTP request fails with an 5xx error
    'allow_on_failure' => false,
];
