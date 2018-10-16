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
<div class="visible-xs no-print js-header--main">
    <div class="navbar-mobile-before"></div>

    <div
        class="
            navbar-mobile
            u-section--bg
        "
        role="navigation"
    >
        <div class="container">
            <div class="navbar-header navbar-mobile__header">
                <div class="navbar-mobile__header-section">
                    <a class="navbar-mobile__logo" href="{{ route('home') }}"></a>
                    <span class="navbar-mobile__brand navbar-brand u-ellipsis-overflow">
                        {{ trans("layout.menu.$currentSection.$currentAction") }}
                    </span>
                </div>

                <div class="navbar-mobile__header-section navbar-mobile__header-section--buttons">
                    @if (Auth::check())
                        <a
                            href="{{ osu_url('user.inbox') }}"
                            class="notification-icon notification-icon--mobile{{Auth::user()->notificationCount() > 0 ? ' notification-icon--glow' : ''}}"
                        >
                            <i class="fas fa-lg fa-fw fa-inbox notification-icon__inbox"></i>
                            <span class="notification-icon__count">{{ Auth::user()->notificationCount() > 0 ? number_format(Auth::user()->notificationCount()) : '' }}</span>
                        </a>

                        <a
                            href="{{ route('users.show', Auth::user()->user_id) }}"
                            class="avatar avatar--navbar-mobile js-navbar-mobile--top-icon"
                            style="background-image: url('{{ Auth::user()->user_avatar }}');"
                        >
                        </a>
                    @else
                        <a
                            href="#"
                            title="{{ trans('users.anonymous.login_link') }}"
                            class="avatar avatar--navbar-mobile avatar--guest js-navbar-mobile--top-icon js-user-link"
                        >
                        </a>
                    @endif

                    <button
                        type="button"
                        class="navbar-toggle navbar-mobile__toggle u-section--color-hover"
                        data-toggle="collapse" data-target="#xs-navbar"
                    >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-mobile__toggle-icon">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse navbar-mobile__menu js-navbar-mobile--menu" id="xs-navbar">
        <ul class="nav navbar-nav navbar-mobile__menu-items">
            @include('layout.header_mobile.user')
            @include('layout.header_mobile.nav')
            @include('layout.header_mobile.locale')
        </ul>
    </div>

    @if (Auth::check() && !($currentSection === 'home' && $currentAction === 'search'))
        <form action="{{ route('search') }}" class="navbar-mobile-search">
            <input class="navbar-mobile-search__input" name="query" />
            <button class="navbar-mobile-search__icon">
                <i class="fas fa-search"></i>
            </button>
        </form>
    @endif
</div>
