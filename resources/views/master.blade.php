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
@php
    $legacyFont = $legacyFont ?? true;

    if (!isset($title)) {
        $titleTree = [];

        if (isset($titlePrepend)) {
            $titleTree[] = $titlePrepend;
        }

        $titleTree[] = trans("layout.menu.{$currentSection}.{$currentAction}");
        $titleTree[] = trans("layout.menu.{$currentSection}._");

        $title = implode(' · ', $titleTree);
    }

    $title .= ' | osu!';
    $currentHue = $currentHue ?? section_to_hue_map($currentSection);
@endphp
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
    <head>
        @include("layout.metadata")
        <title>{{ $title }}</title>
    </head>

    <body
        class="
            osu-layout
            osu-layout--body
            t-section
            action-{{ $currentAction }}
            {{ $bodyAdditionalClasses ?? '' }}
        "
    >
        <style>
            :root {
                @if (!$legacyFont)
                    --font-default-override: var(--font-default-torus);
                    --font-content-override: var(--font-content-inter);
                @endif
                --base-hue: {{ $currentHue }};
                --base-hue-deg: {{ $currentHue }}deg;
            }
        </style>
        <div id="overlay" class="blackout blackout--overlay" style="display: none;"></div>
        <div class="blackout js-blackout" data-visibility="hidden"></div>

        @if (Auth::user() && Auth::user()->isRestricted())
            @include('objects._notification_banner', [
                'type' => 'alert',
                'title' => trans('users.restricted_banner.title'),
                'message' => trans('users.restricted_banner.message'),
            ])
        @endif

        @if (!isset($blank))
            @include("layout.header")

            <div class="osu-page osu-page--notification-banners js-notification-banners">
                @stack('notification_banners')
            </div>
        @endif
        <div class="osu-layout__section osu-layout__section--full js-content {{ $currentSection }}_{{ $currentAction }}">
            @include("layout.popup")
            @if (View::hasSection('content'))
                @yield('content')
            @else
                <div class="osu-layout__row osu-layout__row--page">
                    <h1 class="text-center">
                        <span class="dark">{{ $currentSection }}</span>
                        /
                        <span class="dark">{{ $currentAction }}</span>
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
        @include('layout.popup-container')

        @yield("script")
    </body>
</html>
