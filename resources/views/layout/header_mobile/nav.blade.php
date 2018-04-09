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
@foreach (nav_links() as $section => $links)
    <li class="navbar-mobile-item dropdown">
        <a
            data-toggle="dropdown"
            class="navbar-mobile-item__main dropdown-toggle"
            href="{{ $links['_'] ?? array_values($links)[0] }}"
        >
            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--closed">
                <i class="fa fa-chevron-right"></i>
            </span>

            <span class="navbar-mobile-item__icon navbar-mobile-item__icon--main navbar-mobile-item__icon--opened">
                <i class="fa fa-chevron-down"></i>
            </span>

            {{ trans("layout.menu.{$section}._") }}
        </a>

        <ul class="dropdown-menu" role="menu" aria-labelledby="expand-{{ $section }}">
            @foreach ($links as $action => $link)
                @if ($action === '_')
                    @continue
                @endif
                <li>
                    <a
                        class="navbar-mobile-item__submenu"
                        href="{{ $link }}"
                        data-toggle="collapse"
                        data-target=".js-navbar-mobile--menu"
                    >
                        <span class="navbar-mobile-item__icon">
                            <i class="fa fa-chevron-right"></i>
                        </span>

                        {{ trans("layout.menu.$section.$action") }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endforeach
