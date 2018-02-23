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

<div class="logo-menu">
    <a href="{{ route('home') }}" class="logo-menu__logo-container js-menu js-menu--visible" data-menu-target="logo-menu">
        <div class="logo-menu__logo-hover-bg {{ $logoMenuHoverBgClass or '' }}"></div>
        <div class="logo-menu__logo"></div>
    </a>

    <div class="logo-menu__menu logo-menu__menu--main js-menu" data-menu-id="logo-menu" data-visibility="hidden">
        <div class="logo-menu__menu-item">
            @if (Auth::check())
                <div class="logo-menu__user logo-menu__user--split js-current-user-cover">
                    <a
                        class="logo-menu__user-slice logo-menu__user-slice--avatar logo-menu__user-slice--bg"
                        href="{{ route('users.show', Auth::user()) }}"
                    >
                        <div
                            class="avatar avatar--full-rounded"
                            style="background-image: url('{{ Auth::user()->user_avatar }}');"
                        ></div>
                    </a>

                    <button
                        class="logo-menu__user-slice logo-menu__user-slice--session logo-menu__user-slice--bg js-logout-link"
                        type="button"
                        data-url="{{ route('logout') }}"
                        data-method="delete"
                        data-confirm="{{ trans('users.logout_confirm') }}"
                        data-remote="1"
                    >
                        <i class="fa fa-sign-out"></i>
                    </button>
                </div>
            @else
                <a
                    href="#"
                    title="{{ trans('users.anonymous.login_link') }}"
                    class="logo-menu__user logo-menu__user--full js-user-link"
                >
                    <div class="logo-menu__user-slice logo-menu__user-slice--avatar">
                        <div class="avatar avatar--guest avatar--full-rounded"></div>
                    </div>

                    <span class="logo-menu__user-slice logo-menu__user-slice--session">
                        <i class="fa fa-sign-in"></i>
                    </span>
                </a>
            @endif
        </div>

        <div class="logo-menu__menu-item logo-menu__menu-item--separator"></div>

        @foreach (nav_links() as $section => $links)
            <div class="logo-menu__menu-item">
                <a
                    href="{{ $links['_'] ?? array_values($links)[0] }}"
                    class="logo-menu__menu-link js-menu"
                    data-menu-target="logo-menu--{{ $section }}"
                >
                    <div class="logo-menu__menu-stripe logo-menu__menu-stripe--hover u-section-{{ $section }}--bg"></div>
                    <span class="logo-menu__menu-text logo-menu__menu-text--main">
                        {{ trans("layout.menu.{$section}._") }}

                        <i class="fa fa-angle-right logo-menu__menu-link-icon"></i>
                    </span>
                </a>

                <div class="logo-menu__menu logo-menu__menu--sub js-menu" data-menu-id="logo-menu--{{ $section }}" data-visibility="hidden">
                    <div class="logo-menu__menu-stripe u-section-{{ $section }}--bg"></div>

                    @foreach ($links as $action => $link)
                        @if ($action === '_')
                            @continue
                        @endif
                        <div class="logo-menu__menu-item">
                            <a href="{{ $link }}" class="logo-menu__menu-link logo-menu__menu-link">
                                <span class="logo-menu__menu-text logo-menu__menu-text--sub">
                                    {{ trans("layout.menu.{$section}.{$action}") }}
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="logo-menu__menu-item logo-menu__menu-item--separator"></div>
    </div>
</div>
