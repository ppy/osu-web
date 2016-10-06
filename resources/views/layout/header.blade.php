{{--
    Copyright 2015 ppy Pty. Ltd.

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
@include('layout._header_mobile')

<nav class="osu-layout__section osu-layout__section--minimum no-print js-header--main hidden-xs">
    <div class="bg u-section-bg">
        <div class="bg__triangles bg__triangles--1"></div>
        <div class="bg__triangles bg__triangles--2"></div>
        <div class="bg__triangles bg__triangles--3"></div>
        <div class="bg__gradient-overlay u-section--gradient-down"></div>
    </div>

    <!-- Main style -->
    <div class="osu-nav js-nav-popup">
        <a class="osu-nav__col osu-nav__col--logo u-nav-float" href="/">
            @include('objects._logo')
        </a>

        <div class="osu-nav__col osu-nav__col--title">
            <div class="js-nav-switch js-nav-switch--active" data-nav-mode="default">
                <div class="osu-nav__title">
                    {{ trans("layout.menu.{$current_section}._") }}

                    @if(!isset($hideAction))
                        <span class="osu-nav__title-separator">
                            <i class="fa fa-angle-right"></i>
                        </span>

                        {{ trans("layout.menu.{$current_section}.{$current_action}") }}
                    @endif
                </div>

                <div class="osu-nav__highlight-bar">
                    <span class="bar"></span>
                </div>
            </div>
        </div>

        <a class="osu-nav__col u-nav-float js-nav-switch js-user-header" href="#" data-nav-mode="user">
            @include('layout._header_user', ['_user' => Auth::user()])
        </a>
    </div>
</nav>

<div class="js-user-verification--reference"></div>
@include('layout._user_verification_popup')

<div class="js-nav-data" id="nav-data-master" data-turbolinks-permanent></div>
@include('layout._popup')

@include('layout.popup-container')
