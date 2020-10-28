{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $otherLocales = $page->otherLocales();
    $showLocalesMenu = count($otherLocales) > 0;
@endphp
<div class="header-buttons">
    <div class="header-buttons__item">
        <a
            class="btn-osu-big btn-osu-big--rounded-thin"
            href="{{ $page->editUrl() }}"
            title="{{ trans('wiki.show.edit.link') }}"
        >
            <i class="fab fa-github"></i>
        </a>
    </div>

    @if (priv_check('WikiPageRefresh')->can())
        <div class="header-buttons__item">
            <button
                type="button"
                class="btn-osu-big btn-osu-big--rounded-thin"
                data-remote="true"
                data-url="{{ wiki_url($page->path) }}"
                data-method="PUT"
                title="{{ trans('wiki.show.edit.refresh') }}"
            >
                <i class="fas fa-sync"></i>
            </button>
        </div>
    @endif

    <div class="header-buttons__item">
        <a
            href="{{ wiki_url($page->path, $page->locale) }}"
            class="btn-osu-big btn-osu-big--rounded-thin js-click-menu"
            data-click-menu-target="wiki-locales"
        >
            <span class="btn-osu-big__content">
                <span class="btn-osu-big__icon-inline btn-osu-big__icon-inline--left">
                    @include('objects._flag_country', [
                        'countryCode' => locale_flag($page->locale),
                        'modifiers' => ['flat'],
                    ])
                </span>

                {{ locale_name($page->locale) }}

                @if ($showLocalesMenu)
                    <span class="btn-osu-big__icon-inline btn-osu-big__icon-inline--right">
                        <i class="fas fa-angle-down"></i>
                    </span>
                @endif
            </span>
        </a>

        @if ($showLocalesMenu)
            <div class="header-buttons__item-menu">
                <div
                    class="simple-menu simple-menu--wiki-locales js-click-menu"
                    data-visibility="hidden"
                    data-click-menu-id="wiki-locales"
                >
                    <div class="simple-menu__content">
                        @foreach ($otherLocales as $locale)
                            <a class="simple-menu__item" href="{{ wiki_url($page->path, $locale) }}">
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
            </div>
        @endif
    </div>
</div>
