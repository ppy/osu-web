{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
    $user = Auth::user();
@endphp
<div class="visible-xs no-print js-header--main">
    <div class="navbar-mobile-before"></div>

    <div class="navbar-mobile" role="navigation">
        <div class="navbar-mobile__header-section">
            <a class="navbar-mobile__logo" href="{{ route('home') }}"></a>
            <span class="navbar-mobile__brand u-ellipsis-overflow">
                {{ trans("layout.menu.$currentSection.$currentAction") }}
            </span>
        </div>

        <div class="navbar-mobile__header-section navbar-mobile__header-section--buttons">
            <button
                type="button"
                class="navbar-mobile__toggle js-click-menu"
                data-click-menu-target="mobile-menu"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-mobile__toggle-icon">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </button>
        </div>
    </div>

    <div
        class="mobile-menu js-click-menu u-fancy-scrollbar"
        data-click-menu-id="mobile-menu"
    >
        <div class="mobile-menu__content">
            <div class="mobile-menu__tabs">
                @if (isset($user))
                    <a
                        href="{{ route('users.show', $user->user_id) }}"
                        data-click-menu-target="mobile-user"
                        class="mobile-menu-tab mobile-menu-tab--user js-click-menu"
                    >
                        <span
                            class="avatar avatar--full-rounded"
                            style="background-image: url('{{ $user->user_avatar }}');"
                        ></span>
                    </a>
                @else
                    <button
                        title="{{ trans('users.anonymous.login_link') }}"
                        class="mobile-menu-tab mobile-menu-tab--user js-navbar-mobile--top-icon js-user-link"
                    >
                        <span class="avatar avatar--full-rounded avatar--guest"></span>
                    </button>
                @endif

                <button class="mobile-menu-tab js-click-menu" data-click-menu-target="mobile-nav">
                    <span class="fas fa-sitemap"></span>
                </button>

                @if (isset($user))
                    <button class="mobile-menu-tab js-click-menu" data-click-menu-target="mobile-search">
                        <span class="fas fa-search"></span>
                    </button>

                    <button class="mobile-menu-tab js-click-menu js-react--notification-icon"
                        data-click-menu-target="mobile-notification"
                        data-notification-icon="{{ json_encode(['type' => 'mobile']) }}"
                    >
                        <span class="notification-icon notification-icon--mobile">
                            <i class="fas fa-inbox"></i>
                            <span class="notification-icon__count">...</span>
                        </span>
                    </button>
                @endif
            </div>

            <div class="mobile-menu__item js-click-menu" data-click-menu-id="mobile-user">
                @include('layout.header_mobile.user')
            </div>

            <div class="mobile-menu__item js-click-menu" data-click-menu-id="mobile-nav">
                @include('layout.header_mobile.nav')
            </div>

            @if (isset($user))
                <div class="mobile-menu__item mobile-menu__item--search js-click-menu js-react--quick-search" data-click-menu-id="mobile-search">
                </div>

                <div
                    class="mobile-menu__item js-click-menu js-react--notification-widget"
                    data-click-menu-id="mobile-notification"
                    data-visibility="hidden"
                ></div>
            @endif
        </div>
    </div>
</div>
