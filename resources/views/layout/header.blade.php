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
<nav class="osu-layout__section osu-layout__section--minimum no-print js-header--main">
    @include("layout.mobile-header")

    <!-- Main style -->
    <div id="nav-background" class="hidden-xs">
        <div id="nav-triangles-1" class="nav-triangles"></div>
        <div id="nav-triangles-2" class="nav-triangles"></div>
        <div id="nav-triangles-3" class="nav-triangles"></div>
        <div id="nav-gradient-overlay"></div>
    </div>

    <div class="hidden-xs osu-layout__row" id="nav-sm">
        <a class="flex-none nav-logo" href="/"></a>

        <div id="nav-links">
            <div id="nav-menu" class="js-menu osu-nav__menu">
                @foreach (nav_links() as $section => $links)
                    <a
                        class="js-menu osu-nav__link {{ $current_section === $section ? "osu-nav__link--active" : ""}}"
                        data-menu-target="header--{{ $section }}"
                        href="{{ array_values($links)[0] }}"
                    >
                            {{ trans("layout.menu.$section._") }}
                    </a>
                @endforeach

                <a class="osu-nav__link yellow-normal" href="{{ route("support-the-game") }}">support the game</a>

                <a class="osu-nav__link" href="{{ config("osu.urls.social.facebook") }}" target="_blank"><i class="fa fa-facebook-f"></i></a>

                <a class="osu-nav__link" href="{{ config("osu.urls.social.twitter") }}" target="_blank"><i class="fa fa-twitter"></i></a>
            </div>

            <div id="nav-page-title">
                <div class="osu-nav__title-menu js-header-menu--page-title">
                    <span class="osu-nav__link osu-nav__link--large">
                        <span class="sub1">{{ trans("layout.menu.$current_section._") }}</span>
                    </span>

                    <span class="osu-nav__link osu-nav__link--large">
                        <span class="sub2">{{ trans("layout.menu.$current_section.$current_action") }}</span>
                    </span>
                </div>

                @foreach (nav_links() as $section => $links)
                    <div
                        class="osu-nav__title-menu js-menu"
                        data-menu-id="header--{{ $section }}"
                        data-visibility="hidden"
                    >
                        <span class="osu-nav__link osu-nav__link--large osu-nav__link--title">
                            {{ trans("layout.menu.$section._") }}
                        </span>

                        @foreach ($links as $action => $link)
                            <a class="osu-nav__link osu-nav__link--large" href="{{ $link }}">
                                {{ trans("layout.menu.$section.$action") }}
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex-none nav-user-bar-container">
            @include("objects.user-dropdown")
        </div>
    </div>
</nav>

@include('layout.popup-container')
