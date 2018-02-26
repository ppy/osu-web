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
@extends("master", [
    'title' => 'osu!',
    'blank' => 'true',
    'body_additional_classes' => 'osu-layout--body-dark'
])

@section("content")
    <nav class="osu-layout__row">
        <!-- Mobile Navigation -->
        @include('layout._header_mobile')

        <!-- Desktop Navigation -->
        <div class="landing-nav hidden-xs">
            <div class="landing-nav__section">
                @foreach (nav_links() as $section => $links)
                    <a
                        href="{{ $links['_'] ?? array_values($links)[0] }}"
                        class="landing-nav__link {{ ($section == "home") ? "landing-nav__link--bold" : "" }}"
                    >
                        {{ trans("layout.menu.$section._") }}
                    </a>
                @endforeach

                <div class="landing-nav__locale-menu-link">
                    <span class="landing-nav__link js-menu" data-menu-target="landing--locale">
                        <img
                            class="landing-nav__locale-flag"
                            src="{{ flag_path(locale_flag(App::getLocale())) }}"
                            alt="{{ App::getLocale() }}"
                        >
                        {{ locale_name(App::getLocale()) }}
                    </span>

                    <div
                        class="js-menu landing-nav__locale-menu"
                        data-menu-id="landing--locale"
                        data-visibility="hidden"
                    >
                        @foreach (config('app.available_locales') as $locale)
                            <a
                                class="landing-nav__link landing-nav__link--locale"
                                href="{{ route('set-locale', ['locale' => $locale]) }}"
                                data-remote="1"
                                data-method="POST"
                            >
                                <span class="landing-nav__locale-link-pointer">
                                    <span class="fa fa-chevron-right"></span>
                                </span>

                                <img
                                    class="landing-nav__locale-flag"
                                    src="{{ flag_path(locale_flag($locale)) }}"
                                    alt="{{ $locale }}"
                                >

                                {{ locale_name($locale) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="landing-nav__section">
                <a
                    href="#"
                    class="landing-nav__link js-nav-toggle"
                    data-nav-mode="user"
                    data-nav-sub-mode="login"
                    title="{{ trans("users.anonymous.login_link") }}"
                >
                    {{ trans("users.login._") }}
                </a>

                <a
                    href="{{ osu_url('user.signup') }}"
                    class="landing-nav__link js-nav-toggle"
                    data-nav-mode="user"
                    data-nav-sub-mode="signup"
                >
                    {{ trans("users.signup._") }}
                </a>
            </div>
        </div>

    </nav>

    <div class="js-nav-data" id="nav-data-landing" data-turbolinks-permanent></div>
    @include('layout._popup')

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
                {!! trans("home.landing.players", ['count' => number_format($stats->totalUsers)]) !!},
                {!! trans("home.landing.online", [
                    'players' => number_format($stats->currentOnline),
                    'games' => number_format($stats->currentGames)]
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
                        {{ trans('home.landing.slogan.main') }}
                    </h1>

                    <h2 class="landing-hero__slogan-sub">
                        {{ trans('home.landing.slogan.sub') }}
                    </h2>
                </div>

                <div class="landing-hero__message-extra-container">
                    <div class="landing-hero__message-extra landing-hero__message-extra--bottom">
                        <a href="{{ route('download') }}" class="btn-osu-big btn-osu-big--download-landing">
                            <span class="btn-osu-big__content">
                                <span class="btn-osu-big__left">
                                    <span class="btn-osu-big__text-top">
                                        {{ trans("home.landing.download") }}
                                    </span>
                                </span>

                                <span class="btn-osu-big__icon">
                                    <span class="fa fa-cloud-download"></span>
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

    <div class="osu-page osu-page--landing-buttons">
        <div class="landing-middle-buttons">
            <a
                href="{{ route('support-the-game') }}"
                class="landing-middle-buttons__button landing-middle-buttons__button--support"
            ></a>

            <a
                href="{{ action('StoreController@getListing') }}"
                class="landing-middle-buttons__button landing-middle-buttons__button--store"
            ></a>

            <a
                href="https://blog.ppy.sh/"
                class="landing-middle-buttons__button landing-middle-buttons__button--blog"
            ></a>
        </div>
    </div>

    <footer class="osu-layout__section osu-layout__section--landing-footer">
        <div class="osu-layout__row osu-layout__row--landing-sitemap landing-sitemap">
            <div class="osu-layout__col-container osu-layout__col-container--landing-sitemap">
                @foreach (footer_landing_links() as $section => $links)
                    <div class="osu-layout__col osu-layout__col--sm-3">
                        <ul class="landing-sitemap__list">
                            <li class="landing-sitemap__item">
                                <div class="landing-sitemap__header">{{ trans("layout.footer.$section._") }}</div>
                            </li>
                            @foreach ($links as $action => $link)
                                <li class="landing-sitemap__item"><a href="{{ $link }}" class="landing-sitemap__link">{{ trans("layout.footer.$section.$action") }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="landing-footer-social">
            <a href="{{ route('support-the-game') }}" class="landing-footer-social__icon landing-footer-social__icon--support">
                <span class="fa fa-heart"></span>
            </a>
            <a href="{{ osu_url("social.twitter") }}" class="landing-footer-social__icon landing-footer-social__icon--twitter">
                <span class="fa fa-twitter"></span>
            </a>
            <a href="{{ osu_url("social.facebook") }}" class="landing-footer-social__icon landing-footer-social__icon--facebook">
                <span class="fa fa-facebook-official"></span>
            </a>
        </div>

        @include('layout.footer', ['modifiers' => ['landing'], 'withLinks' => false])
    </footer>

    @include('layout.popup-container')
@endsection

@section ("script")
    @parent
@endsection
