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
<!DOCTYPE html>
<html>
    <head>
        @include("layout.metadata")
        <title>
            @if (isset($title))
                {{ $title }}
            @elseif (isset($titlePrepend))
                {{
                    $titlePrepend.
                    ' · '.
                    trans("layout.menu.$current_section.$current_action").
                    ' · '.
                    trans("layout.menu.$current_section._")
                }}
            @else
                {{ trans("layout.menu.$current_section.$current_action") }} · {{ trans("layout.menu.$current_section._") }}
            @endif
            | osu!
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body
        class="
            osu-layout
            osu-layout--body
            t-section-{{ $current_section or "error" }}
            action-{{ $current_action }}
            {{ $body_additional_classes or "" }}
        "
    >
        <div id="overlay" class="blackout blackout--overlay" style="display: none;"></div>
        <div class="blackout js-blackout" data-visibility="hidden"></div>

        @if (!isset($blank))
            @include("layout.header")
        @endif
        <div class="osu-layout__section osu-layout__section--full js-content {{ $current_section }}_{{ $current_action }}">
            @include("layout.popup")
            @if (View::hasSection('content'))
                @yield('content')
            @else
                <div class="osu-layout__row osu-layout__row--page">
                    <h1 class="text-center">
                        <span class="dark">{{ $current_section }}</span>
                        /
                        <span class="dark">{{ $current_action }}</span>
                        is <span class="normal">now printing</span> <span class="light">♪</span>
                    </h1>
                </div>
            @endif
        </div>
        @if (!isset($blank))
            @include("layout.gallery_window")
            @include("layout.footer")
        @endif

        <div
            class="fixed-bar
                js-fixed-element
                js-fixed-bottom-bar
                js-sticky-footer--fixed-bar"
        >
            <div
                class="js-permanent-fixed-footer
                    js-sync-height--reference"
                data-sync-height-target="permanent-fixed-footer"
            >
                @yield('permanent-fixed-footer')
            </div>
        </div>
        <audio class="js-audio" preload="auto"></audio>

        @include("layout._global_variables")
        @include('layout._loading_overlay')

        @yield("script")
    </body>
</html>
