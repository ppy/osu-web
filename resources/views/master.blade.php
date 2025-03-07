{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentRoute = app('route-section')->getCurrent();

    $currentSection = $currentRoute['section'];
    $currentAction = $currentRoute['action'];

    $currentUser = Auth::user();

    $legacyScoreMode = App\Libraries\Search\ScoreSearchParams::showLegacyForUser($currentUser) === true;

    $titleTree = [];

    if (isset($titleOverride)) {
        $titleTree[] = $titleOverride;
    } else {
        if (isset($titlePrepend)) {
            $titleTree[] = $titlePrepend;
        }

        $titleTree[] = page_title();
    }

    $title = '';
    foreach ($titleTree as $i => $titlePart) {
        // Reset text direction (202c = reset, 202d = force ltr).
        $title .= e($titlePart)."\u{202c}";

        if ($i + 1 === count($titleTree)) {
            // Titles ending with phrase containing "osu!" like "osu!store" don't need the suffix.
            if (strpos($titlePart, 'osu!') === false) {
                $title .= " | \u{202d}osu!\u{202c}";
            }
        } else {
            $title .= ' · ';
        }
    }

    $defaultHue = section_to_hue_map($currentSection);
    $currentHue ??= $defaultHue;

    $navLinks ??= nav_links();
    $currentLocaleMeta ??= current_locale_meta();
@endphp
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ $contentLocale ?? $currentLocaleMeta->html() }}">
    <head>
        @include("layout.metadata")
        <title>{!! $title !!}</title>
        <base href="{{ Request::getSchemeAndHttpHost().Request::getRequestUri() }}" />
    </head>

    <body
        class="
            t-section
            {{ class_with_modifiers('osu-layout', 'body', ['body-lazer' => !$legacyScoreMode]) }}
            {{ $bodyAdditionalClasses ?? '' }}
        "
        style="--base-hue-default: {{ $defaultHue }}; --base-hue-override: {{ $currentHue }}"
    >
        <div id="overlay" class="blackout blackout--overlay" style="display: none;"></div>
        <div class="blackout js-blackout" data-visibility="hidden"></div>

        @if ($currentUser !== null && $currentUser->isRestricted())
            @include('objects._notification_banner', [
                'type' => 'alert',
                'title' => osu_trans('users.restricted_banner.title'),
                'message' => osu_trans('users.restricted_banner.message', [
                    'link' => link_to(
                        osu_url('user.restriction'),
                        osu_trans('users.restricted_banner.message_link')
                    ),
                ]),
            ])
        @endif

        @if (!isset($blank))
            @include("layout.header")

            <div
                class="osu-page osu-page--notification-banners js-notification-banners js-sync-height--reference"
                data-sync-height-target="notification-banners"
            >
                @stack('notification_banners')
            </div>
        @endif
        <div class="osu-layout__section osu-layout__section--full">
            @yield('content')
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

                @if ($GLOBALS['cfg']['osu']['is_development_deploy'])
                    <div class="development-deploy-footer">
                        This is a development instance of the <a href="https://osu.ppy.sh" class="development-deploy-footer__link">osu! website</a>. Please do not login with your osu! credentials.
                    </div>
                @endif
            </div>
        </div>

        <div id="main-player" class="audio-player-floating" data-turbo-permanent>
            <div class="js-audio--main"></div>
            <div class="js-sync-height--target" data-sync-height-id="permanent-fixed-footer"></div>
        </div>
        {{--
            Components:
            - lib/utils/estimate-min-lines.ts (main)
            - less/bem/estimate-min-lines.less (styling)
            - views/master.blade.php (placeholder)
        --}}
        <div id="estimate-min-lines" class="estimate-min-lines" data-turbo-permanent>
            <div class="estimate-min-lines__content js-estimate-min-lines"></div>
        </div>
        @include("layout._global_variables")
        @include('layout._loading_overlay')
        @include('layout.popup-container')

        <script id="json-route-section" type="application/json">
            {!! json_encode($currentRoute) !!}
        </script>

        @yield("script")
    </body>
</html>
