<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    if (!trans_exists($key, $locale)) {
        $locale = config('app.fallback_locale');
    }

    return $translator->get($key, $replace, $locale, false);
}

function trans_choice($key, $number, array $replace = [], $locale = null)
{
    if (!trans_exists($key, $locale)) {
        $locale = config('app.fallback_locale');
    }

    if (is_array($number) || $number instanceof Countable) {
        $number = count($number);
    }

    if (!isset($replace['count_delimited'])) {
        $replace['count_delimited'] = i18n_number_format($number, null, null, null, $locale);
    }

    return app('translator')->choice($key, $number, $replace, $locale);
}
