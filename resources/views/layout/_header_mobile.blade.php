{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                {{ page_title() }}
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
                        <span class="mobile-menu-tab__avatar">
                            <span
                                class="avatar avatar--full-rounded"
                                style="background-image: url('{{ $user->user_avatar }}');"
                            ></span>
                        </span>

                        <span class="u-ellipsis-overflow">
                            {{ $user->username }}
                        </span>
                    </a>
                @else
                    <button
                        class="mobile-menu-tab mobile-menu-tab--user js-user-link"
                    >
                        <span class="mobile-menu-tab__avatar">
                            <span class="avatar avatar--full-rounded avatar--guest"></span>
                        </span>

                        <span class="u-ellipsis-overflow">
                            {{ osu_trans('layout.popup_login.button') }}
                        </span>
                    </button>
                @endif

                <button class="mobile-menu-tab js-click-menu" data-click-menu-target="mobile-nav">
                    <span class="fas fa-sitemap"></span>
                </button>

                @if (isset($user))
                    <button class="mobile-menu-tab js-click-menu" data-click-menu-target="mobile-search">
                        <span class="fas fa-search"></span>
                    </button>

                    <button
                        class="mobile-menu-tab js-click-menu js-react--chat-icon"
                        data-click-menu-target="mobile-chat-notification"
                        data-turbolinks-permanent
                        data-type='mobile'
                        id="notification-widget-chat-icon-mobile"
                    >
                        <span class="notification-icon notification-icon--mobile">
                            <i class="fas fa-comment-alt"></i>
                            <span class="notification-icon__count">...</span>
                        </span>
                    </button>

                    <button class="mobile-menu-tab js-click-menu js-react--main-notification-icon"
                        data-click-menu-target="mobile-notification"
                        data-turbolinks-permanent
                        data-type='mobile'
                        id="notification-widget-icon-mobile"
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
                    data-click-menu-id="mobile-chat-notification"
                    data-notification-widget="{{ json_encode(['only' => 'channel']) }}"
                    data-visibility="hidden"
                    data-turbolinks-permanent
                    id="notification-widget-chat-mobile"
                ></div>

                <div
                    class="mobile-menu__item js-click-menu js-react--notification-widget"
                    data-click-menu-id="mobile-notification"
                    data-notification-widget="{{ json_encode(['excludes' => ['channel']]) }}"
                    data-visibility="hidden"
                    data-turbolinks-permanent
                    id="notification-widget-mobile"
                ></div>
            @endif
        </div>
    </div>
</div>
