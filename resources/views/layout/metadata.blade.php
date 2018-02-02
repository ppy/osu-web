{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<link rel="shortcut icon" href="{{ Config::get("osu.static", "//s.ppy.sh") }}/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="{{ Config::get("osu.static", "//s.ppy.sh") }}/favicon.ico" type="image/vnd.microsoft.icon">
<meta charset="utf-8">
<meta name="description" content="{{ $pageDescription or trans('layout.defaults.page_description') }}">
<meta name="keywords" content="osu, peppy, ouendan, elite, beat, agents, ds, windows, game, taiko, tatsujin, simulator, sim, xna, ddr, beatmania, osu!, osume">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#cc5288">

<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="turbolinks-cache-control" content="no-preview">

@if(config("services.ga.tracking_id") !== '')
    <meta name="ga-tracking-id" content="{{ config("services.ga.tracking_id") }}">
@endif

<link href='//fonts.googleapis.com/css?family=Exo+2:300,300italic,200,200italic,400,400italic,500,500italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>

<link rel="stylesheet" media="all" href="{{ mix("css/app.css") }}" data-turbolinks-track="reload">
<link rel="stylesheet" media="all" href="/vendor/_photoswipe-default-skin/default-skin.css">

<script>
    var currentLocale = {!! json_encode(App::getLocale()) !!};
    var fallbackLocale = {!! json_encode(config('app.fallback_locale')) !!};
</script>

<script src="{{ mix("js/vendor.js") }}" data-turbolinks-track="reload"></script>
@if(config('services.sentry.public_dsn') !== '')
    <script src="//cdn.ravenjs.com/3.17.0/raven.min.js" crossorigin="anonymous"></script>
    <script>
        var ravenOptions = {
            release: '{{ config('osu.git-sha') }}',
            ignoreErrors: [
                // Random plugins/extensions
                'top.GLOBALS'
            ],
            ignoreUrls: [
                // Chrome/Firefox extensions
                /extensions\//i,
                /^chrome:\/\//i,
                /^resource:\/\//i,
                // Disqus
                /embed\.js$/i,
                // Errors caused by spyware/adware junk
                /^\/loaders\//i
            ]
        }
        Raven.config('{{ config('services.sentry.public_dsn') }}', ravenOptions).install();
        Raven.setUserContext({lang: currentLocale});
    </script>
@endif
<script src="{{ mix("js/app-deps.js") }}" data-turbolinks-track="reload"></script>
<script src="{{ mix("js/app.js") }}" data-turbolinks-track="reload"></script>
<script src="/vendor/js/timeago-locales/jquery.timeago.{{ locale_for_timeago(Lang::getLocale()) }}.js" data-turbolinks-track="reload"></script>

@if (($momentLocale = locale_for_moment(Lang::getLocale())) !== null)
    <script src="/vendor/js/moment-locales/{{ $momentLocale }}.js" data-turbolinks-track="reload"></script>
@endif

@if (isset($rss))
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{{ $rss }}">
@endif

@if (isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
@endif
