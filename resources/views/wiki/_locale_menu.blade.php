{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $userLocale = app()->getLocale();

    // always show current user locale as first item in menu (when showing other locale)
    if ($displayLocale !== $userLocale) {
        $userLocaleIndex = array_search_null($userLocale, $otherLocales);
        if ($userLocaleIndex !== null) {
            unset($otherLocales[$userLocaleIndex]);
        }
        array_unshift($otherLocales, $userLocale);
    }

    $showLocalesMenu = count($otherLocales) > 0;
@endphp
<a
    href="{{ wiki_url($path, $displayLocale) }}"
    class="btn-osu-big btn-osu-big--rounded-thin js-click-menu"
    data-click-menu-target="wiki-locales"
>
    <span class="btn-osu-big__content">
        <span class="btn-osu-big__icon-inline btn-osu-big__icon-inline--left">
            @include('objects._flag_country', [
                'countryCode' => locale_flag($displayLocale),
                'modifiers' => ['flat'],
            ])
        </span>

        {{ locale_name($displayLocale) }}

        @if ($showLocalesMenu)
            <span class="btn-osu-big__icon-inline btn-osu-big__icon-inline--right">
                <i class="fas fa-angle-down"></i>
            </span>
        @endif
    </span>
</a>

@if ($showLocalesMenu)
    <div
        class="simple-menu simple-menu--wiki-locales js-click-menu"
        data-visibility="hidden"
        data-click-menu-id="wiki-locales"
    >
        <div class="simple-menu__content">
            @foreach ($otherLocales as $locale)
                <a class="simple-menu__item" href="{{ wiki_url($path, $locale) }}">
                    <span class="nav2-locale-item nav2-locale-item--no-padding">
                        <span class="nav2-locale-item__flag">
                            @include('objects._flag_country', [
                                'countryCode' => locale_flag($locale),
                                'modifiers' => ['flat'],
                            ])
                        </span>

                        {{ locale_name($locale) }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@endif
