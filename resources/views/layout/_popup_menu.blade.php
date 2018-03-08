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
<div class="js-nav-popup-auto-size hidden-xs nav-popup nav-popup--main">
    @foreach (nav_links() as $section => $links)
        <div class="nav-popup__menu">
            <a
                class="
                    js-menu
                    {{ $current_section === $section ? 'nav-popup__menu-head--active' : '' }}
                    nav-popup__menu-head
                "
                data-menu-default="{{ $current_section === $section }}"
                data-menu-target="header--{{ $section }}"
                href="{{ $links['_'] ?? array_values($links)[0] }}"
            >
                <div class="nav-popup__menu-head-bar">
                    <span class="bar bar--double"></span>
                </div>

                <div
                    class="fake-bold"
                    data-content="{{ trans("layout.menu.$section._") }}"
                >
                    {{ trans("layout.menu.$section._") }}
                </div>
            </a>

            <div class="nav-popup__submenu-container">
                <div
                    class="js-menu js-nav-submenu nav-popup__submenu"
                    data-menu-id="header--{{ $section }}"
                    data-visibility="hidden"
                    data-visibility-animation="none"
                >
                    @foreach ($links as $action => $link)
                        @if ($action === '_')
                            @continue
                        @endif
                        <a class="nav-popup__link" href="{{ $link }}">
                            {{ trans("layout.menu.$section.$action") }}

                            <div class="nav-popup__link-marker">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class="nav-popup__menu nav-popup__menu--locale">
        <a
            class="js-menu nav-popup__menu-head"
            data-menu-default="{{ $current_section === $section }}"
            data-menu-target="header--locale"
            href="#"
        >
            <div class="nav-popup__menu-head-bar">
                <span class="bar bar--double bar--locale"></span>
            </div>

            <div
                class="nav-popup__menu-icon"
                style="background-image: url('{{ flag_path(locale_flag(App::getLocale())) }}')"
            ></div>

            <div
                class="fake-bold"
                data-content="{{ locale_name(App::getLocale()) }}"
            >
                {{ locale_name(App::getLocale()) }}
            </div>
        </a>

        <div class="nav-popup__submenu-container">
            <div
                class="js-menu js-nav-submenu nav-popup__submenu"
                data-menu-id="header--locale"
                data-visibility="hidden"
                data-visibility-animation="none"
            >
                @foreach (config('app.available_locales') as $locale)
                    <a
                        class="nav-popup__link"
                        href="{{ route('set-locale', ['locale' => $locale]) }}"
                        data-remote="1"
                        data-method="POST"
                    >
                        <div
                            class="nav-popup__menu-icon"
                            style="background-image: url('{{ flag_path(locale_flag($locale)) }}')"
                        ></div>

                        {{ locale_name($locale) }}

                        <div class="nav-popup__link-marker">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="nav-popup__socials">
        <a href="{{ route('support-the-game') }}" class="nav-popup__social nav-popup__social--support" title="{{ trans('layout.menu.home.supportTheGame') }}">
            <span class="fa fa-heart"></span>
        </a>
        <a href="{{ wiki_url('Twitter') }}" class="nav-popup__social nav-popup__social--twitter">
            <span class="fa fa-twitter"></span>
        </a>
        <a href="{{ osu_url("social.facebook") }}" class="nav-popup__social nav-popup__social--facebook">
            <span class="fa fa-facebook-official"></span>
        </a>
    </div>
    <div class="nav-popup__bar">
        <span class="bar u-section-bg"></span>
    </div>
</div>
