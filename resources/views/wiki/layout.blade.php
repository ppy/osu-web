{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $translatedPages = [];
    foreach ([$page->requestedLocale, ...$page->otherLocales()] as $l) {
        $translatedPages[$l] = wiki_url($page->path, $l);
    }
@endphp

@extends('master', [
    'translatedPages' => $translatedPages,
])
