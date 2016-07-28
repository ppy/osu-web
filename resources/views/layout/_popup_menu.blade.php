{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
<div class="nav-popup">
    @foreach (nav_links() as $section => $links)
        <div class="nav-popup__menu">
            <a
                class="
                    js-menu
                    nav-popup__menu-head
                    {{ $current_section === $section ? 'nav-popup__menu-head--active' : '' }}
                "
                data-menu-target="header--{{ $section }}"
                href="{{ array_values($links)[0] }}"
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

            <div
                class="js-menu nav-popup__submenu"
                data-menu-id="header--{{ $section }}"
                data-visibility="hidden"
                data-visibility-animation="none"
            >
                @foreach ($links as $action => $link)
                    <a class="nav-popup__link" href="{{ $link }}">
                        {{ trans("layout.menu.$section.$action") }}

                        <div class="nav-popup__link-marker">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="nav-popup__bar">
        <span class="bar u-section-bg"></span>
    </div>
</div>
