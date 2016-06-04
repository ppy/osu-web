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
    'blank' => 'true',
    'body_additional_classes' => 'osu-layout--body-landing'
])

@section("content")
    <div class="js-react--landing-page">
    </div>
    <nav class="osu-layout__section osu-layout__section--minimum">
        <div class="osu-layout__row landing-nav">
            <div class="landing-nav__section">
                <a href="#" class="landing-nav__section__link landing-nav__section__link--bold">home</a>
                <a href="#" class="landing-nav__section__link">community</a>
                <a href="#" class="landing-nav__section__link">help</a>
                <a href="#" class="landing-nav__section__link">store</a>
            </div>
            <div class="landing-nav__center">
                <img class="landing-nav__logo-wrapper__logo" src="/images/layout/osu-logo@2x.png" alt="osu!">
            </div>
            <div class="landing-nav__section landing-nav__section--right">
                <a href="#" class="landing-nav__section__link">login</a>
                <a href="#" class="landing-nav__section__link">sign up</a>
            </div>
        </div>
    </nav>
    <div class="osu-layout__section osu-layout__section--full">

    </div>
@endsection

@section ("script")
    @parent

    <script src="{{ elixir("js/react/landing-page.js") }}" data-turbolinks-track></script>
@endsection
