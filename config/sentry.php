<?php

return [
    'dsn' => env('APP_SENTRY'),

    // capture release as git sha
    'release' => config('osu.git-sha'),
];
