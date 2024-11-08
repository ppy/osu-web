{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $appUrl = $GLOBALS['cfg']['app']['url'];
    $currentLocale = App::getLocale();
    $fallbackLocale = $GLOBALS['cfg']['app']['fallback_locale'];
    $opengraph = Request::instance()->attributes->get('opengraph');

    $opengraph['description'] ??= $pageDescription ?? null;
@endphp
<link rel="apple-touch-icon" sizes="180x180" href="{{ $appUrl }}/images/favicon/apple-touch-icon.png">
<link rel="icon" sizes="32x32" href="{{ $appUrl }}/images/favicon/favicon-32x32.png">
<link rel="icon" sizes="16x16" href="{{ $appUrl }}/images/favicon/favicon-16x16.png">
<link rel="manifest" href="{{ $appUrl }}/site.webmanifest">
<link rel="mask-icon" href="{{ $appUrl }}/images/favicon/safari-pinned-tab.svg" color="#e2609a">
<meta name="msapplication-TileColor" content="#603cba">
<meta name="theme-color" content="{{ hsl_to_hex($currentHue, 0.1, 0.4) }}"> {{-- @osu-colour-b1 --}}

<meta charset="utf-8">
<meta name="description" content="{{ $opengraph['description'] ?? osu_trans('layout.defaults.page_description') }}">
<meta name="keywords" content="osu, peppy, ouendan, elite, beat, agents, ds, windows, game, taiko, tatsujin, simulator, sim, xna, ddr, beatmania, osu!, osume">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="turbo-cache-control" content="no-preview">
<meta name="turbo-prefetch" content="false">

<link rel="search" type="application/opensearchdescription+xml" title="osu! search" href="{{ $appUrl }}/opensearch.xml">

<meta property="og:site_name" content="osu!">
<meta property="og:type" content="website">

@if (isset($canonicalUrl))
    <meta property="og:url" content="{{ $canonicalUrl }}">
@endif

@foreach ($opengraph as $key => $value)
    @if (present($value))
        @if ($key === 'title')
            <meta property="og:{{ $key }}" content="{{ $value }} · {{ page_title() }}">
        @else
            <meta property="og:{{ $key }}" content="{{ $value }}">
        @endif
    @endif
@endforeach

@if ($noindex ?? false)
    <meta name="robots" content="noindex">
@endif

<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ $currentUser === null ? '' : csrf_token() }}">

<meta name="turbolinks-cache-control" content="no-preview">

@switch($currentLocale)
    @case('vi')
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap&subset=vietnamese" rel="stylesheet">
        <style>
            :root {
                --font-default-override: var(--font-default-vi);
            }
        </style>
        @break
    @case('zh')
        <style>
            :root {
                --font-default-override: var(--font-default-zh);
            }
        </style>
        @break
    @case('zh-tw')
        <style>
            :root {
                --font-default-override: var(--font-default-zh-tw);
            }
        </style>
        @break
    @case('th')
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap&subset=thai" rel="stylesheet">
        <style>
            :root {
                --font-default-override: var(--font-default-th);
            }
        </style>
        @break
@endswitch

<link rel="stylesheet" media="all" href="{{ unmix('css/app.css') }}" data-turbo-track="reload">

<script>
    var currentLocale = {!! json_encode($currentLocale) !!};
    var fallbackLocale = {!! json_encode($fallbackLocale) !!};
    var experimentalHost = {!! json_encode(osu_url('experimental_host')) !!}
</script>

<script src="{{ unmix('js/runtime.js') }}" data-turbo-eval="false"></script>
<script src="{{ unmix('js/vendor.js') }}" data-turbo-eval="false"></script>

<script src="{{ unmix("js/locales/{$currentLocale}.js") }}" data-turbo-eval="false"></script>
@if ($fallbackLocale !== $currentLocale)
    <script src="{{ unmix("js/locales/{$fallbackLocale}.js") }}" data-turbo-eval="false"></script>
@endif

<script src="{{ unmix('js/commons.js') }}" data-turbo-eval="false"></script>
<script src="{{ unmix('js/app.js') }}" data-turbo-eval="false"></script>

<script
    src="{{ unmix("js/moment-locales/{$currentLocaleMeta->moment()}.js") }}"
    data-turbo-eval="false"
></script>

@if (isset($atom))
    <link rel="alternate" type="application/atom+xml" title="{{ $atom['title'] }}" href="{{ $atom['url'] }}">
@endif

@if (isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif

@if (isset($translatedPages))
    @foreach ($translatedPages as $l => $url)
        <link rel="alternate" hreflang="{{ $l }}" href="{{ $url }}" />
    @endforeach
@endif
