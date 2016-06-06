{{--
    Copyright 2015 ppy Pty. Ltd.

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
    'body_additional_classes' => 'osu-layout--body-landing'
])

@section("content")
    <nav class="osu-layout__section osu-layout__section--minimum">
        <div class="osu-layout__row landing-nav">
            <div class="landing-nav__section landing-nav__section--left">
                @foreach (landing_nav_links() as $section => $links)
                <a href="{{ array_values($links)[0] }}" class="landing-nav__section__link {{ ($section == "home") ? "landing-nav__section__link--bold" : "" }}">{{ trans("layout.menu.$section._") }}</a>
                @endforeach
            </div>
            <a href="#" class="landing-nav__logo"><h1>osu!</h1></a>
            <div class="landing-nav__section landing-nav__section--right">
                <a href="#" class="landing-nav__section__link" data-toggle="modal" data-target="#user-dropdown-modal">{{ trans("users.login._") }}</a>
                <a href="{{ route("users.register") }}" class="landing-nav__section__link">{{ trans("users.signup._") }}</a>
            </div>
        </div>
    </nav>
    <header class="osu-layout__section osu-layout__section--full">
        <div class="osu-layout__row osu-layout__row--page-compact landing-hero">
            <div class="landing-hero-slider">
                <a href="#" class="landing-slide">
                    <span class="landing-slide__bg">
                        <img class="landing-slide__bg--image" src="/images/layout/landing-page/home-slider-1.jpg" alt="pippi">
                    </span>
                    <span class="landing-slide__cta">
                        <span class="landing-slide__cta__content">free-to-win<br>productivity killer</span>
                    </span>
                </a>
                <a href="#" class="landing-slide">
                    <span class="landing-slide__bg">
                        <img class="landing-slide__bg--image" src="/images/layout/landing-page/home-slider-2.jpg" alt="blue">
                    </span>
                    <span class="landing-slide__cta">
                        <span class="landing-slide__cta__content">join us now<br>with benefits ;)</span>
                    </span>
                </a>
            </div>
            <div class="landing-hero-download">
                <div class="landing-hero-download__inner">
                    <a href="#" class="landing-download-button shadow-hover">
                        <span class="fa fa-2x fa-cloud-download landing-download-button__icon"></span>
                        <span class="landing-download-button__content">
                            <span class="landing-download-button__content--top">Download now</span>
                            <span class="landing-download-button__content--bottom">for Mac OS X</span>
                        </span>
                    </a>
                    <a href="#" class="landing-download-other">click here for Windows or Linux</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        
    </main>
    <footer>
        
    </footer>
    <div class="flex-none nav-user-bar-container">
        @include("objects.user-dropdown")
    </div>
@endsection

@section ("script")
    @parent

    <script src="{{ elixir("js/react/landing-page.js") }}" data-turbolinks-track></script>
@endsection
