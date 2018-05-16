<?php

// Fixes laravel/framework#12065.
function e($value)
{
    if ($value instanceof Illuminate\Contracts\Support\Htmlable\Htmlable) {
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

    $locale ?? $locale = $translator->getLocale();

    $translated = null;

    if ($translator->hasForLocale($key, $locale)) {
        $translated = presence($translator->get($key, $replace, $locale, false));
    }

    if ($translated === null) {
        $fallbackLocale = config('app.fallback_locale');

        $translated = $translator->get($key, $replace, $fallbackLocale, false);
    }

    return $translated;
}

function trans_choice($key, $number, array $replace = [], $locale = null)
{
    $translator = app('translator');
    $locale ?? $locale = $translator->getLocale();

    $translated = null;

    if ($translator->hasForLocale($key, $locale)) {
        $translated = presence($translator->transChoice($key, $number, $replace, $locale));
    }

    if ($translated === null) {
        $fallbackLocale = config('app.fallback_locale');

        $translated = $translator->transChoice($key, $number, $replace, $fallbackLocale);
    }

    return $translated;
}
