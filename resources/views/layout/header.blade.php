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
@include('layout._header_mobile')

<nav class="osu-layout__section osu-layout__section--minimum no-print js-header--main hidden-xs">
    <div class="bg u-section-bg">
        <div class="bg__triangles bg__triangles--1"></div>
        <div class="bg__triangles bg__triangles--2"></div>
        <div class="bg__triangles bg__triangles--3"></div>
        <div class="bg__gradient-overlay u-section--gradient-down"></div>
    </div>

    <!-- Main style -->
    <div class="osu-nav js-nav-popup js-nav-search--popup-width-reference">
        <a class="osu-nav__col osu-nav__col--logo u-nav-float" href="{{ route('home') }}">
            @include('objects._logo')
        </a>

        <div class="osu-nav__col osu-nav__col--title js-nav-switch js-nav-switch--active" data-nav-mode="default">
            <div class="osu-nav__title u-ellipsis-overflow">
                {{ trans("layout.menu.{$current_section}._") }}

                <span class="osu-nav__title-separator">
                    <i class="fa fa-angle-right"></i>
                    {{-- for title attribute --}}
                    <span class="hidden">-</span>
                </span>

                {{ trans("layout.menu.{$current_section}.{$current_action}") }}

                <div class="osu-nav__highlight-bar">
                    <span class="bar"></span>
                </div>
            </div>
        </div>

        @if (Auth::check())
            <div class="osu-nav__col js-nav-switch js-nav-search--input-container" data-nav-mode="search" data-nav-mode-switch="0">
                <div class="osu-nav__highlight-bar">
                    <span class="bar"></span>
                </div>

                <label class="header-search-box">
                    <input
                        class="header-search-box__input js-nav-search--input"
                        name="query"
                        data-min-length="{{ config('osu.search.minimum_length') }}"
                    />
                    <button type="button" class="js-nav-search--run-link header-search-box__icon">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                </label>
            </div>
        @endif

        @if (Auth::check())
            <div class="osu-nav__col">
                <a
                    href="{{ osu_url('user.inbox') }}"
                    class="notification-icon{{Auth::user()->notificationCount() > 0 ? ' notification-icon--glow' : ''}}"
                >
                    @if (Auth::user()->notificationCount() > 0)
                        <span class="notification-icon__count">{{ number_format(Auth::user()->notificationCount())  }}</span>
                    @endif
                    <i class="fa fa-inbox"></i>
                </a>
            </div>
        @endif

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

@if (Auth::user() && Auth::user()->isRestricted())
    <div class="osu-page">
        @include('objects._notification_banner', [
            'type' => 'alert',
            'title' => trans('users.restricted_banner.title'),
            'message' => trans('users.restricted_banner.message'),
        ])
    </div>
@endif
