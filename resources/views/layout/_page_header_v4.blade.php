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
    $backgroundExtraClass = $params['backgroundExtraClass'] ?? '';
    $backgroundImage = $params['backgroundImage'] ?? null;
    $headerExtraClass = $params['headerExtraClass'] ?? '';
    $links = $params['links'] ?? null;
    $linksBreadcrumb = $params['linksBreadcrumb'] ?? false;
    $section = $params['section'] ?? null;
    $subSection = $params['subSection'] ?? null;
    $theme = $params['theme'] ?? null;

    $linksElement = $linksBreadcrumb ? 'ol' : 'ul';
@endphp
<div class="
    header-v4
    {{ isset($theme) ? "header-v4--{$theme}" : '' }}
    {{ (auth()->check() && auth()->user()->isRestricted()) ? 'header-v4--restricted' : '' }}
    {{ $headerExtraClass }}
">
    <div class="header-v4__container header-v4__container--main">
        <div class="header-v4__bg-container">
            <div class="header-v4__bg {{ $backgroundExtraClass }}" {!! background_image($backgroundImage ?? null, false) !!}></div>
        </div>

        <div class="header-v4__content">
            @if ($section !== null || isset($titleAppend))
                <div class="header-v4__row header-v4__row--title">
                    <div class="header-v4__icon"></div>
                    <div class="header-v4__title">
                        <span class="header-v4__title-section">
                            {{ $section }}
                        </span>
                        @if (present($subSection))
                            <span class="header-v4__title-action">
                                {{ $subSection }}
                            </span>
                        @endif
                    </div>

                    {{ $titleAppend ?? null }}
                </div>
            @endif

            {{ $contentAppend ?? null }}
        </div>
    </div>
    @if ($links !== null && count($links) > 0)
        <div class="header-v4__container">
            <div class="header-v4__content">
                <div class="header-v4__row header-v4__row--bar">
                    <{!! $linksElement !!}
                        class="header-nav-v4 header-nav-v4--{{ $linksBreadcrumb ? 'breadcrumb' : 'list' }}"
                    >
                        @foreach ($links as $link)
                            @php
                                $active = $link['active'] ?? false;

                                // also used for mobile nav later
                                if ($active) {
                                    $activeLink = $link;
                                }
                            @endphp
                            <li class="header-nav-v4__item">
                                @if (isset($link['url']))
                                    <a
                                        class="
                                            header-nav-v4__link
                                            {{ $active ? 'header-nav-v4__link--active' : '' }}
                                        "
                                        href="{{ $link['url'] }}"
                                    >
                                        {{ $link['title'] }}
                                    </a>
                                @else
                                    <span class="header-nav-v4__text">{{ $link['title'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </{!! $linksElement !!}>

                    @if (!$linksBreadcrumb)
                        <div class="header-nav-mobile">
                            <a
                                class="header-nav-mobile__toggle js-click-menu"
                                data-click-menu-target="header-nav-mobile"
                                href="{{ $activeLink['url'] }}"
                            >
                                {{ $activeLink['title'] }}

                                <span class="header-nav-mobile__toggle-icon">
                                    <span class="fas fa-chevron-down"></span>
                                </span>
                            </a>

                            <ul
                                class="header-nav-mobile__menu js-click-menu"
                                data-click-menu-id="header-nav-mobile"
                                data-visibility="hidden"
                            >
                                @foreach ($links as $link)
                                    <li>
                                        <a
                                            class="header-nav-mobile__item"
                                            href="{{ $link['url'] }}"
                                        >
                                            {{ $link['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ $navAppend ?? null }}
                </div>
            </div>
        </div>
    @endif
</div>
