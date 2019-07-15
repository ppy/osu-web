<?php

return [
    'dsn' => env('APP_SENTRY'),

    // capture release as git sha
    'release' => config('osu.git-sha'),

    // Copied from [1] to prevent E_NOTICE and E_WARNING (and maybe others)
    // from either being reported twice or incorrectly reported after caught.
    // There's probably better set of types but it's easier to just copy whatever
    // used by the old library.
    // [1] https://github.com/getsentry/raven-php/blob/a90cdcf681a373b5150ee2b430db28d9f670abea/lib/Raven/ErrorHandler.php#L71
    'error_types' => E_ERROR
        | E_PARSE
        | E_CORE_ERROR
        | E_CORE_WARNING
        | E_COMPILE_ERROR
        | E_COMPILE_WARNING
        | E_STRICT,
];
