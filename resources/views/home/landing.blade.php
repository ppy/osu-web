{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
    <nav class="osu-layout__row osu-layout__row--landing">
        <!-- Mobile Navigation -->
        @include('layout._header_mobile')

        <!-- Desktop Navigation -->
        <div class="landing-nav hidden-xs">
            <div class="landing-nav__section landing-nav__section--left">
                @foreach (nav_links() as $section => $links)
                    <a
                        href="{{ array_values($links)[0] }}"
                        class="landing-nav__link {{ ($section == "home") ? "landing-nav__link--bold" : "" }}"
                    >
                        {{ trans("layout.menu.$section._") }}
                    </a>
                @endforeach
            </div>

            <a class="landing-nav__section landing-nav__section--center u-nav-float" href="#">
                @include('objects._logo')
            </a>

            <div class="landing-nav__section landing-nav__section--right">
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
                    href="{{ route("users.register") }}"
                    class="landing-nav__link js-nav-toggle"
                    data-nav-mode="user"
                    data-nav-sub-mode="signup"
                >
                    {{ trans("users.signup._") }}
                </a>
            </div>
        </div>

    </nav>

    @include('layout._popup', ['navPopupExtraClasses' => 'osu-layout__row--landing'])
    <header class="osu-layout__row osu-layout__row--landing">
        <div class="landing-hero">
            <div class="js-landing-hero-slider--new js-landing-hero-slider landing-hero__slider">
                @for($i = 1; $i <= 2; $i++)
                    <span class="landing-hero__slide">
                        <span
                            class="landing-hero__slide-bg"
                            style="background: url('/images/layout/landing-page/home-slider-{{$i}}.jpg') no-repeat center center / cover">
                        </span>

                        <span class="landing-hero__cta">

                            <span class="landing-hero__content">
                                {!! trans("home.landing.slogans.$i") !!}
                            </span>
                        </span>
                    </span>
                @endfor
            </div>

            <div class="landing-download">
                <div class="landing-download__inner">
                    <a href="http://m1.ppy.sh/r/osu!install.exe" class="landing-download__button shadow-hover">
                        <span class="fa fa-cloud-download landing-download__icon"></span>
                        <span class="landing-download__content-wrapper">
                            <span class="landing-download__content landing-download__content--top">
                                {{ trans("home.landing.download._") }}
                            </span>
                            <span class="landing-download__content landing-download__content--bottom js-download-platform"></span>
                        </span>
                    </a>

                    <a href="{{ route('download') }}" class="landing-download__other js-download-other"></a>
                </div>
            </div>
            <div class="js-landing-graph landing-graph">
                <div class="landing-graph__info">
                    <b>{{ number_format($totalUsers, 0) }}</b> {{ trans("home.landing.players") }}, <b>{{ number_format($currentOnline, 0) }}</b> {{ trans("home.landing.online") }}
                </div>
            </div>
        </div>
    </header>

    <main class="osu-layout__row osu-layout__row--landing">
        <div class="landing-middle-buttons">
            <div class="osu-layout__col-container">
                <a href="#" class="osu-layout__col osu-layout__col--link osu-layout__col--sm-4 osu-layout__col--lg-4">
                    <img class="landing-middle-buttons__image shadow-hover" src="/images/layout/landing-page/middle-button-1.jpg" alt="Placeholder text!">
                </a>
                <a href="{{ action('StoreController@getListing') }}" class="osu-layout__col osu-layout__col--link osu-layout__col--sm-4 osu-layout__col--lg-4">
                    <img class="landing-middle-buttons__image shadow-hover" src="/images/layout/landing-page/middle-button-2.jpg" alt="osu!store">
                </a>
                <a href="//next.ppy.sh/" class="osu-layout__col osu-layout__col--link osu-layout__col--sm-4 osu-layout__col--lg-4">
                    <img class="landing-middle-buttons__image shadow-hover" src="/images/layout/landing-page/middle-button-3.jpg" alt="osu!next">
                </a>
            </div>
        </div>
    </main>

    <footer class="osu-layout__section osu-layout__section--landing-footer">
        <div class="osu-layout__row osu-layout__row--landing-sitemap landing-sitemap">
            <div class="osu-layout__col-container osu-layout__col-container--landing-sitemap">
                @foreach (footer_links() as $section => $links)
                    <div class="osu-layout__col osu-layout__col--sm-6 osu-layout__col--lg-3">
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
            <a href="{{ route('support-the-game') }}" class="fa fa-heart landing-footer-social__icon"></a>
            <a href="{{ config("osu.urls.social.twitter") }}" class="fa fa-twitter landing-footer-social__icon"></a>
            <a href="{{ config("osu.urls.social.facebook") }}" class="fa fa-facebook-official landing-footer-social__icon"></a>
        </div>

        <div class="landing-footer-bottom">
            <a href="{{ config("osu.urls.legal.tos") }}" class="landing-footer-bottom__link">terms of service</a>
            <a href="{{ config("osu.urls.legal.dmca") }}" class="landing-footer-bottom__link">copyright (DMCA)</a>
            <a href="{{ config("osu.urls.legal.server") }}" class="landing-footer-bottom__link">server status</a>
            <a href="{{ config("osu.urls.legal.osustatus") }}" class="landing-footer-bottom__link landing-footer-bottom__link--no-pad">@osustatus</a>

            <div class="landing-footer-bottom__copyright">ppy powered 2007-2016</div>
        </div>
    </footer>

    @include('layout.popup-container')
@endsection

@section ("script")
    @parent

    <script id="json-stats" type="application/json">
        {!! json_encode($stats) !!}
    </script>
@endsection
