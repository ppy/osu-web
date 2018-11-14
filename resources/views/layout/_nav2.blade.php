{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
    $legacyNav ?? ($legacyNav = true);
@endphp
<div class="nav2 js-nav-button">
    <div class="nav2__colgroup nav2__colgroup--menu js-nav-button--container">
        <div class="nav2__col nav2__col--logo">
            <a href="{{ route('home') }}" class="nav2__logo-link">
                <div class="nav2__logo nav2__logo--bg"></div>
                <div class="nav2__logo"></div>
            </a>
        </div>

        @foreach (nav_links() as $section => $links)
            <div class="nav2__col nav2__col--menu">
                <a
                    class="nav2__menu-link-main js-menu"
                    href="{{ $links['_'] ?? array_first($links) }}"
                    data-menu-target="nav2-menu-popup-{{ $section }}"
                    data-menu-show-delay="0"
                >
                    <span class="nav2__menu-link-main-text">
                        {{ trans("layout.menu.{$section}._") }}

                        @if ($section === $currentSection && !($isSearchPage ?? false))
                            <span class="nav2__menu-link-bar u-section--bg-normal"></span>
                        @endif
                    </span>
                </a>

                <div class="nav2__menu-popup">
                    <div
                        class="
                            simple-menu
                            simple-menu--nav2
                            simple-menu--nav2-left-aligned
                            {{ $legacyNav ? '' : 'simple-menu--nav2-transparent' }}
                            js-menu
                        "
                        data-menu-id="nav2-menu-popup-{{ $section }}"
                        data-visibility="hidden"
                    >
                        @foreach ($links as $action => $link)
                            @if ($action === '_')
                                @continue
                            @endif
                            <a class="simple-menu__item u-section-{{ $section }}--before-bg-normal" href="{{ $link }}">
                                {{ trans("layout.menu.{$section}.{$action}") }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="nav2__col nav2__col--menu">
            <a
                href="{{ route('search') }}"
                class="
                    nav2__menu-link-main
                    nav2__menu-link-main--search
                    {{ isset($isSearchPage) ? 'u-section--bg-normal' : '' }}
                "
            >
                <span class="fas fa-search"></span>
            </a>
        </div>
    </div>
    <div class="nav2__colgroup js-nav-button--container">
        <div class="nav2__col js-nav-button--item">
            <a
                href="{{ osu_url('social.twitter') }}"
                class="nav2__button nav2__button--social"
                title="Twitter"
            >
                <span class="fab fa-twitter"></span>
            </a>
        </div>

        <div class="nav2__col js-nav-button--item">
            <a
                href="{{ osu_url('social.facebook') }}"
                class="nav2__button nav2__button--social"
                title="Facebook"
            >
                <span class="fab fa-facebook"></span>
            </a>
        </div>

        <div class="nav2__col">
            <a
                href="{{ route('support-the-game') }}"
                class="nav2__button nav2__button--support"
                title="{{ trans('layout.menu.home.supportTheGame') }}"
            >
                <span class="fas fa-heart"></span>
            </a>
        </div>

        <div class="nav2__col">
            <button
                class="nav2__button nav2__button--stadium js-click-menu"
                data-click-menu-target="nav2-locale-popup"
            >
                <img
                    class="nav2__locale-current-flag"
                    alt="{{ App::getLocale() }}"
                    src="{{ flag_path(locale_flag(App::getLocale())) }}"
                >
            </button>

            <div class="nav2__click-popup">
                <div
                    class="simple-menu simple-menu--nav2 simple-menu--nav2-locales js-click-menu js-nav2--centered-popup"
                    data-click-menu-id="nav2-locale-popup"
                    data-visibility="hidden"
                >
                    <div class="simple-menu__content">
                        @foreach (config('app.available_locales') as $locale)
                            <button
                                type="button"
                                class="
                                    simple-menu__item
                                    {{ $locale === App::getLocale() ? 'simple-menu__item--active' : '' }}
                                "
                                @if ($locale !== App::getLocale())
                                    data-url="{{ route('set-locale', ['locale' => $locale]) }}"
                                    data-remote="1"
                                    data-method="POST"
                                @endif
                            >
                                <span class="nav2-locale-item">
                                    <img
                                        src="{{ flag_path(locale_flag($locale)) }}"
                                        alt="{{ $locale }}"
                                        class="nav2-locale-item__flag"
                                    >

                                    {{ locale_name($locale) }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user() !== null)
            <div class="nav2__col">
                <a
                    href="{{ osu_url('user.inbox') }}"
                    class="nav2__button nav2__button--stadium"
                >
                    <span
                        class="
                            notification-icon
                            {{ Auth::user()->notificationCount() > 0 ? 'notification-icon--glow' : '' }}
                        "
                    >
                        <i class="fas fa-inbox"></i>

                        <span class="notification-icon__count">
                            {{ number_format(Auth::user()->notificationCount()) }}
                        </span>
                    </span>
                </a>
            </div>
        @endif

        <div class="nav2__col nav2__col--avatar">
            @include('layout._header_user')

            <div class="nav2__click-popup nav2__click-popup--user js-user-header-popup">
                @if (Auth::user() !== null)
                    @include('layout._popup_user')
                @endif
            </div>
        </div>
    </div>
</div>
