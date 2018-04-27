<?php

// Fixes laravel/framework#12065.
function e($value)
{
    if ($value instanceof Illuminate\Contracts\Support\Htmlable\Htmlable) {
        return $value->toHtml();
    }

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', true);
}

function trans_choice($key, $number, array $replace = [], $locale = null)
{
    $translator = app('translator');

    if ($translator->hasForLocale($key, $locale)) {
        return $translator->transChoice($key, $number, $replace, $locale);
    } else {
        return $translator->transChoice($key, $number, $replace, config('app.fallback_locale'));
    }
}
