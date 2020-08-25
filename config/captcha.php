<?php

return [
    'secret' => env('RECAPTCHA_SECRET', ''),
    'sitekey' => env('RECAPTCHA_SITEKEY', ''),
    'options' => [
        'timeout' => 30,
    ],
];
