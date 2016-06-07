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
    <!-- Mobile Navigation -->
    @include('objects.smartphone-header', ['navLinks' => landing_nav_links(), 'subLinks' => false])

    <!-- Desktop Navigation -->
    <div class="osu-layout__row landing-nav hidden-xs">
        <div class="landing-nav__section landing-nav__section--left">
            @foreach (landing_nav_links() as $section => $links)
            <a href="{{ array_values($links)[0] }}" class="landing-nav__section__link {{ ($section == "home") ? "landing-nav__section__link--bold" : "" }}">{{ trans("layout.menu.$section._") }}</a>
            @endforeach
        </div>
        <a href="#" class="landing-nav__logo"><h1>osu!</h1></a>
        <div class="landing-nav__section landing-nav__section--right js-nav-avatar">
            <a href="#" class="landing-nav__section__link" title="{{ trans("users.anonymous.login_link") }}" data-toggle="modal" data-target="#user-dropdown-modal">{{ trans("users.login._") }}</a>
            <a href="{{ route("users.register") }}" class="landing-nav__section__link">{{ trans("users.signup._") }}</a>
        </div>
    </div>
    <div id="user-dropdown-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal__dialog js-user-dropdown-modal__dialog">
            @if (Auth::check())
            <div class="js-react--user-card"></div>
            @else
            <div class="modal-content modal-content--no-shadow">
                <div class="modal-header modal-header--login"><h1 class="modal-header__title">{{ trans("users.login._") }}</h1></div>
                <div class="modal-body modal-body--user-dropdown modal-body--no-rounding">
                    <h2 class="modal-body__title modal-body__title">{{ trans("users.login.title") }}</h2>

                    {!! Form::open(["url" => route("users.login"), "id" => "login-form", "class" => "modal-body__form form", "data-remote" => true]) !!}
                    <div class="form__input-group form-group form-group--compact">
                        <input class="modal-af form-group__control form-control form-group__control--compact" name="username" type="text" placeholder="{{ trans("users.login.username") }}" required>
                        <input class="form-group__control form-control form-group__control--compact" name="password" type="password" placeholder="{{ trans("users.login.password") }}" required>
                    </div>

                    <button class="btn-osu btn-osu-default form__button" type="submit"><i class="fa fa-sign-in"></i></button>
                    {!! Form::close() !!}

                    <p class="modal-body__paragraph"><a href="{{ route("users.forgot-password") }}" target="_blank">{{ trans("users.login.forgot") }}</a></p>
                    <p class="modal-body__paragraph"><a href="{{ route("users.register") }}" target="_blank">{{ trans("users.login.register") }}</a></p>
                </div>
            </div>
            @endif
        </div>
    </div>
</nav>
<div id="popup-container">
    <div class="alert alert-dismissable popup-clone col-md-6 col-md-offset-3 text-center" style="display: none">
        <button type="button" data-dismiss="alert" class="close"><i class="fa fa-close"></i></button>
        <span class="popup-text"></span>
    </div>
</div>
<header class="osu-layout__section osu-layout__section--full">
    <div class="osu-layout__row osu-layout__row--page-compact landing-hero">
        <div class="landing-hero-slider">
            @for($i = 1; $i <= 2; $i++)
            <a href="#" class="landing-slide">
                <span class="landing-slide__bg">
                    <img class="landing-slide__bg--image" src="/images/layout/landing-page/home-slider-{{$i}}.jpg" alt="pippi">
                </span>
                <span class="landing-slide__cta">
                    <span class="landing-slide__cta__content">{!! trans("home.landing.slogans.$i") !!}</span>
                </span>
            </a>
            @endfor
        </div>
        <div class="landing-hero-download">
            <div class="landing-hero-download__inner">
                <a href="http://m1.ppy.sh/r/osu!install.exe" class="landing-download-button shadow-hover">
                    <span class="fa fa-2x fa-cloud-download landing-download-button__icon hidden-xs"></span>
                    <span class="landing-download-button__content">
                        <span class="landing-download-button__content--top">{{ trans("home.landing.download._") }}</span>
                        <span class="landing-download-button__content--bottom js-download-platform"></span>
                    </span>
                </a>
                <a href="{{ route('download') }}" class="landing-download-other js-download-other"></a>
            </div>
        </div>
    </div>
</header>
<main>

</main>
<footer>

</footer>
@endsection

@section ("script")
@parent

<script src="{{ elixir("js/react/landing-page.js") }}" data-turbolinks-track></script>
@endsection
