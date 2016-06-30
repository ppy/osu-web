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
<nav class="osu-layout__section osu-layout__section--minimum no-print js-header--main js-nav-popup">
    <div class="visible-xs">
        @include('layout._header_mobile')
    </div>

    <!-- Main style -->
    <div class="hidden-xs osu-nav">
        <div class="bg u-section-bg">
            <div class="bg__triangles bg__triangles--1"></div>
            <div class="bg__triangles bg__triangles--2"></div>
            <div class="bg__triangles bg__triangles--3"></div>
            <div class="bg__gradient-overlay u-section-gradient-down"></div>
        </div>

        <div class="osu-nav__content">
            <div class="osu-nav__top">
                <a class="osu-nav__top-col osu-nav__top-col--logo osu-nav__top-col--float" href="/">
                    <span class="logo logo--size-default u-nav-float"></span>
                </a>

                <div class="osu-nav__top-col osu-nav__top-col--title">
                    <div class="js-nav-switch js-nav-switch--active" data-nav-mode="default">
                        <div class="osu-nav__title">
                            {{ trans("layout.menu.{$current_section}._") }}

                            <span class="osu-nav__title-separator">
                                <i class="fa fa-angle-right"></i>
                            </span>

                            {{ trans("layout.menu.{$current_section}.{$current_action}") }}
                        </div>

                        <div class="osu-nav__highlight-bar">
                            <span class="bar"></span>
                        </div>
                    </div>
                </div>

                <a class="osu-nav__top-col osu-nav__top-col--float js-nav-switch" href="#" data-nav-mode="user">
                    <div>
                        <div class="osu-nav__title">
                            @if (Auth::check())
                                {{ Auth::user()->username }}
                            @else
                                {{ trans("users.anonymous.username") }}
                            @endif
                        </div>

                        <div class="osu-nav__highlight-bar">
                            <span class="bar"></span>
                        </div>
                    </div>

                    <div class="osu-nav__avatar">
                        <div
                            class="
                                avatar
                                avatar--full-rounded
                                {{ Auth::check() ? '' : 'avatar--guest' }}
                                js-nav-avatar
                            "
                            @if (Auth::check())
                                style="background-image: url('{{ Auth::user()->user_avatar }}');"
                            @endif
                        ></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div
        class="osu-layout__row"
    >
        <div
            class="nav-popup-container js-nav-popup--popup"
            data-visibility="hidden"
            data-visibility-animation="none"
        >
            <div class="nav-popup-box">
                <div class="nav-popup-box__content">
                    @include('layout._popup_menu')
                </div>
            </div>

            <div
                class="nav-popup-box nav-popup-box--extra js-nav-switch--menu"
                data-nav-mode="user"
            >
                <div class="nav-popup-box__content">
                    @if (Auth::check())
                        @include('layout._popup_user', ['_user' => Auth::user()])
                    @else
                        @include('layout._popup_login')
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<div id="popup-container">
    <div class="alert alert-dismissable popup-clone col-md-6 col-md-offset-3 text-center" style="display: none">
        <button type="button" data-dismiss="alert" class="close"><i class="fa fa-close"></i></button>
        <span class="popup-text"></span>
    </div>
</div>
