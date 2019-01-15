<?php

// Fixes laravel/framework#12065.
function e($value)
{
    if ($value instanceof Illuminate\Contracts\Support\Htmlable) {
        return $value->toHtml();
    }

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', true);
}

function trans($key = null, $replace = [], $locale = null)
{
    $translator = app('translator');

    if (is_null($key)) {
        return $translator;
    }

    if ($translator->hasForLocale($key, $locale)) {
        $translated = presence($translator->get($key, $replace, $locale, false));
    }

    return $translated ??
        $translator->get($key, $replace, config('app.fallback_locale'), false);
}

function trans_choice($key, $number, array $replace = [], $locale = null)
{
    $translator = app('translator');

    if ($translator->hasForLocale($key, $locale)) {
        $translated = presence($translator->transChoice($key, $number, $replace, $locale));
    }

    return $translated ??
        $translator->transChoice($key, $number, $replace, config('app.fallback_locale'));
}
