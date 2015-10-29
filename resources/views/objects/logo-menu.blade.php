{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}

<div class="logo-menu">
    <div class="logo-menu__logo">
    </div>

    <ul class="logo-menu__menu logo-menu__menu--main">
        @foreach (nav_links() as $section => $links)
            <li class="logo-menu__menu-item logo-menu__menu-item--main">
                <a href="{{ array_values($links)[0] }}" class="logo-menu__menu-link bg-hover--{{ $section }}">
                    <div class="logo-menu__menu-stripe logo-menu__menu-stripe--hover bg--{{ $section }}"></div>
                    <span class="logo-menu__menu-text logo-menu__menu-text--main">
                        {{ trans("layout.menu.{$section}._") }}

                        <i class="fa fa-angle-right logo-menu__menu-link-icon"></i>
                    </span>
                </a>

                <ul class="logo-menu__menu logo-menu__menu--sub">
                    @foreach ($links as $action => $link)
                        <li class="logo-menu__menu-item">
                            <a href="{{ $link }}" class="logo-menu__menu-link logo-menu__menu-link">
                                <div class="logo-menu__menu-stripe bg--{{ $section }}"></div>
                                <span class="logo-menu__menu-text logo-menu__menu-text--sub">
                                    {{ trans("layout.menu.{$section}.{$action}") }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
