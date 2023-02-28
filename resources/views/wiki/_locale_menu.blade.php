{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $userLocale = app()->getLocale();
    $displayLocaleMeta = locale_meta($displayLocale);

    $menuLocales = $availableLocales->copy();

    // move user locale to the top if it's not display locale but is available
    $showUserLocale = $displayLocale !== $userLocale && $menuLocales->contains($userLocale);
    $menuLocales->remove($userLocale);
    $menuLocales->remove($displayLocale);
    // unshift isn't available for set
    $menuLocales = $menuLocales->toArray();

    if ($showUserLocale) {
        array_unshift($menuLocales, $userLocale);
    }

    $showLocalesMenu = count($menuLocales) > 0;
@endphp
<a
    href="{{ wiki_url($path, $displayLocale) }}"
    class="btn-osu-big btn-osu-big--rounded-thin js-click-menu"
    data-click-menu-target="wiki-locales"
>
    <span class="btn-osu-big__content">
        <span class="btn-osu-big__icon-inline btn-osu-big__icon-inline--left">
            @include('objects._flag_country', [
                'countryCode' => $displayLocaleMeta->flag(),
                'modifiers' => ['flat'],
            ])
        </span>

        {{ $displayLocaleMeta->name() }}

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
            @foreach ($menuLocales as $locale)
                @php
                    $localeMeta = locale_meta($locale);
                @endphp
                <a class="simple-menu__item" href="{{ wiki_url($path, $locale) }}">
                    <span class="nav2-locale-item nav2-locale-item--no-padding">
                        <span class="nav2-locale-item__flag">
                            @include('objects._flag_country', [
                                'countryCode' => $localeMeta->flag(),
                                'modifiers' => ['flat'],
                            ])
                        </span>

                        {{ $localeMeta->name() }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@endif
