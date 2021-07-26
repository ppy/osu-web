{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentLocaleMeta = current_locale_meta();
    $navLinks = nav_links();
@endphp

@extends('master', [
    'titleOverride' => osu_trans('home.landing.title'),
    'blank' => 'true',
    'bodyAdditionalClasses' => 'osu-layout--body-landing'
])

@section('content')
    <nav class="osu-layout__row">
        <!-- Mobile Navigation -->
        @include('layout._header_mobile')

        <!-- Desktop Navigation -->
        <div class="landing-nav hidden-xs">
            <div class="landing-nav__section">
                @foreach ($navLinks as $section => $links)
                    <a
                        href="{{ array_first($links) }}"
                        class="landing-nav__link {{ ($section == "home") ? "landing-nav__link--bold" : "" }}"
                    >
                        {{ osu_trans("layout.menu.$section._") }}
                    </a>
                @endforeach

                <div class="landing-nav__locale-menu-link">
                    <span class="landing-nav__link js-menu" data-menu-target="landing--locale">
                        <span class="landing-nav__locale-flag">
                            @include('objects._flag_country', [
                                'countryCode' => $currentLocaleMeta->flag(),
                            ])
                        </span>

                        {{ $currentLocaleMeta->name() }}
                    </span>

                    <div
                        class="js-menu landing-nav__locale-menu"
                        data-menu-id="landing--locale"
                        data-visibility="hidden"
                    >
                        @foreach (config('app.available_locales') as $locale)
                            @php
                                $localeMeta = locale_meta($locale);
                            @endphp
                            <button
                                type="button"
                                class="landing-nav__locale-button"
                                @if ($localeMeta !== $currentLocaleMeta)
                                    data-url="{{ route('set-locale', ['locale' => $locale]) }}"
                                    data-remote="1"
                                    data-method="POST"
                                @endif
                            >
                                <span class="landing-nav__link landing-nav__link--locale">
                                    <span class="landing-nav__locale-link-pointer">
                                        <span class="fas fa-chevron-right"></span>
                                    </span>

                                    <span class="landing-nav__locale-flag">
                                        @include('objects._flag_country', [
                                            'countryCode' => $localeMeta->flag(),
                                        ])
                                    </span>

                                    {{ $localeMeta->name() }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="landing-nav__section">
                <a
                    href="#"
                    class="landing-nav__link js-nav-toggle js-click-menu js-user-login--menu"
                    data-click-menu-target="nav2-login-box"
                >
                    {{ osu_trans("users.login._") }}
                </a>
            </div>
        </div>

    </nav>

    <div class="js-nav-data" id="nav-data-landing" data-turbolinks-permanent></div>
    @include('layout._popup_login', ['modifiers' => ['landing']])

    <div class="osu-page">
        <div class="landing-hero">
            <div class="landing-hero__bg-container">
                <div class="landing-hero__bg-inner-container js-scale" data-scale="ws">
                    {{--
                        playsinline is for iphone autoplay
                        reference: https://webkit.org/blog/6784/new-video-policies-for-ios/
                    --}}
                    <video
                        class="landing-hero__bg js-autoplay"
                        autoplay
                        loop
                        muted
                        playsinline
                        src="{{ config('osu.landing.video_url') }}"
                    ></video>
                </div>
            </div>

            <div class="landing-hero__pippi">
                <div class="landing-hero__pippi-logo"></div>
            </div>

            <div class="landing-hero__info">
                {!! osu_trans("home.landing.players", ['count' => i18n_number_format($stats->totalUsers)]) !!},
                {!! osu_trans("home.landing.online", [
                    'players' => i18n_number_format($stats->currentOnline),
                    'games' => i18n_number_format($stats->currentGames)]
                ) !!}
            </div>

            <div class="landing-hero__messages">
                <div class="landing-hero__message-extra-container">
                    <div class="landing-hero__message-extra landing-hero__message-extra--top">
                        <div class="landing-hero__logo"></div>
                    </div>
                </div>

                <div class="landing-hero__slogan">
                    <h1 class="landing-hero__slogan-main">
                        {{ osu_trans('home.landing.slogan.main') }}
                    </h1>

                    <h2 class="landing-hero__slogan-sub">
                        {{ osu_trans('home.landing.slogan.sub') }}
                    </h2>
                </div>

                <div class="landing-hero__message-extra-container">
                    <div class="landing-hero__message-extra landing-hero__message-extra--bottom">
                        <a href="{{ route('download') }}" class="btn-osu-big btn-osu-big--download-landing">
                            <span class="btn-osu-big__content">
                                <span class="btn-osu-big__left">
                                    <span class="btn-osu-big__text-top">
                                        {{ osu_trans("home.landing.download") }}
                                    </span>
                                </span>

                                <span class="btn-osu-big__icon">
                                    <span class="fas fa-download"></span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="landing-hero__graph js-landing-graph"></div>

            <script id="json-stats" type="application/json">
                {!! json_encode($stats->graphData) !!}
            </script>
        </div>
    </div>

    <div class="osu-page js-react--landing-news">
    </div>

    <footer class="osu-layout__section osu-layout__section--landing-footer">
        <div class="osu-layout__row osu-layout__row--landing-sitemap landing-sitemap">
            <div class="osu-layout__col-container osu-layout__col-container--landing-sitemap">
                @foreach (footer_landing_links() as $section => $links)
                    <div class="osu-layout__col osu-layout__col--sm-4">
                        <ul class="landing-sitemap__list">
                            <li class="landing-sitemap__item">
                                <div class="landing-sitemap__header">{{ osu_trans("layout.footer.$section._") }}</div>
                            </li>
                            @foreach ($links as $transKey => $link)
                                <li class="landing-sitemap__item"><a href="{{ $link }}" class="landing-sitemap__link">{{ osu_trans($transKey) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="landing-footer-social">
            <a href="{{ route('support-the-game') }}" class="landing-footer-social__icon landing-footer-social__icon--support">
                <span class="fas fa-heart"></span>
            </a>
            <a href="{{ osu_url("social.twitter") }}" class="landing-footer-social__icon landing-footer-social__icon--twitter">
                <span class="fab fa-twitter"></span>
            </a>
        </div>

        @include('layout.footer', ['modifiers' => ['landing'], 'withLinks' => false])
    </footer>

    @include('layout.popup-container')
@endsection

@section ("script")
    @parent

    <script id="json-posts" type="application/json">
        {!! json_encode($news) !!}
    </script>
@endsection
