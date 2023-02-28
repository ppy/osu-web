{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if (isset($page)) {
        $availableLocales = $page->availableLocales();
        $canonicalUrl = $page->isVisible() ? wiki_url($page->path, $page->locale) : null;
        $path = $page->path;
        $urlFn = fn (string $locale): string => wiki_url($path, $locale);
    }

    $translatedPages = [];
    foreach ($availableLocales as $l) {
        $translatedPages[$l] = $urlFn($l);
    }
@endphp

@extends('master', compact('canonicalUrl', 'translatedPages'))
