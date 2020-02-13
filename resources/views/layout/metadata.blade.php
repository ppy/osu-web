{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ config('osu.static') }}/apple-touch-icon.png">
<link rel="icon" sizes="32x32" href="{{ config('osu.static') }}/favicon-32x32.png">
<link rel="icon" sizes="16x16" href="{{ config('osu.static') }}/favicon-16x16.png">
<link rel="manifest" href="{{ config('osu.static') }}/site.webmanifest">
<link rel="mask-icon" href="{{ config('osu.static') }}/safari-pinned-tab.svg" color="#e2609a">
<meta name="msapplication-TileColor" content="#603cba">
<meta name="theme-color" content="hsl({{ $currentHue }}, 10%, 40%)"> {{-- @osu-colour-b1 --}}

<meta charset="utf-8">
<meta name="description" content="{{ $pageDescription ?? trans('layout.defaults.page_description') }}">
<meta name="keywords" content="osu, peppy, ouendan, elite, beat, agents, ds, windows, game, taiko, tatsujin, simulator, sim, xna, ddr, beatmania, osu!, osume">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@if (isset($opengraph))
    @php
        $siteName = 'osu!';

        if (isset($opengraph['section'])) {
            $siteName .= ' » '.$opengraph['section'];
        }
    @endphp

    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $opengraph['title'] }}">
    <meta property="og:image" content="{{ $opengraph['image'] }}">

    @if (isset($pageDescription))
        <meta property="og:description" content="{{ $pageDescription }}">
    @endif
@endif

<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="turbolinks-cache-control" content="no-preview">

@if(config("services.ga.tracking_id") !== '')
    <meta name="ga-tracking-id" content="{{ config("services.ga.tracking_id") }}">
@endif

<link href='//fonts.googleapis.com/css?family=Exo+2:300,300italic,200,200italic,400,400italic,500,500italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i' rel='stylesheet' type='text/css'>

@if (App::getLocale() === 'vi')
    <link href='//fonts.googleapis.com/css?family=Exo:300,300italic,200,200italic,400,400italic,500,500italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <style>
        :root {
            --font-default-override: var(--font-default-vi);
        }
    </style>
@elseif (App::getLocale() === 'zh')
    <style>
        :root {
            --font-default-override: var(--font-default-zh);
        }
    </style>
@elseif (App::getLocale() === 'zh-tw')
    <style>
        :root {
            --font-default-override: var(--font-default-zh-tw);
        }
    </style>
@endif
<link rel="stylesheet" media="all" href="/vendor/_photoswipe-default-skin/default-skin.css">
<link rel="stylesheet" media="all" href="{{ mix("css/app.css") }}" data-turbolinks-track="reload">

<script>
    var currentLocale = {!! json_encode(App::getLocale()) !!};
    var fallbackLocale = {!! json_encode(config('app.fallback_locale')) !!};
</script>

<script src="{{ mix("js/vendor.js") }}" data-turbolinks-track="reload"></script>
@if(config('services.sentry.public_dsn') !== '')
    <script src="https://browser.sentry-cdn.com/5.1.0/bundle.min.js" crossorigin="anonymous"></script>
    <script>
        Sentry.init({
            debug: {!! json_encode(config('app.debug')) !!},
            dsn: {!! json_encode(config('services.sentry.public_dsn')) !!},
            ignoreErrors: [
                // Random plugins/extensions
                'top.GLOBALS',
                /class is a reserved identifier$/
            ],
            ignoreUrls: [
                // Chrome/Firefox extensions
                /extensions\//i,
                /^chrome:\/\//i,
                /^resource:\/\//i,
                // Errors caused by spyware/adware junk
                /^\/loaders\//i
            ],
            release: {!! json_encode(config('osu.git-sha')) !!},
            whitelistUrls: [/^{!! preg_quote(config('app.url'), '/') !!}\/.*\.js(?:\?.*)?$/],
        });
    </script>
@endif
<script src="{{ mix("js/app-deps.js") }}" data-turbolinks-track="reload"></script>
<script src="{{ mix('/js/locales/'.app()->getLocale().'.js') }}" data-turbolinks-track="reload"></script>
@if (config('app.fallback_locale') !== app()->getLocale())
    <script src="{{ mix('/js/locales/'.config('app.fallback_locale').'.js') }}" data-turbolinks-track="reload"></script>
@endif

<script src="{{ mix("js/commons.js") }}" data-turbolinks-track="reload"></script>
<script src="{{ mix("js/app.js") }}" data-turbolinks-track="reload"></script>
<script src="/vendor/js/timeago-locales/jquery.timeago.{{ locale_for_timeago(Lang::getLocale()) }}.js" data-turbolinks-track="reload"></script>

@if (($momentLocale = locale_for_moment(Lang::getLocale())) !== null)
    <script src="/vendor/js/moment-locales/{{ $momentLocale }}.js" data-turbolinks-track="reload"></script>
@endif

@if (isset($atom))
    <link rel="alternate" type="application/atom+xml" title="{{ $atom['title'] }}" href="{{ $atom['url'] }}">
@endif

@if (isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif
