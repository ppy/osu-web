<?php

return [
    'secret' => env('RECAPTCHA_SECRET', ''),
    'sitekey' => env('RECAPTCHA_SITEKEY', ''),
    'threshold' => get_int(env('RECAPTCHA_THRESHOLD')) ?? 2,
    'options' => [
        'timeout' => 30,
    ],
];
