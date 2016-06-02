<?php

return [
    'dsn' => env('APP_SENTRY'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),
];
