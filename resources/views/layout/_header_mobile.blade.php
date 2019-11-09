{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                        <div class="js-react--notification" data-notification-type="mobile">
                            <div class="nav-button nav-button--mobile">
                                <span class="notification-icon notification-icon--mobile">
                                    <i class="fas fa-inbox"></i>
                                    <span class="notification-icon__count">...</span>
                                </span>
                            </div>
                        </div>

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
            @foreach ($searchParams ?? [] as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
            @endforeach
            <input class="navbar-mobile-search__input" name="query" />
            <button class="navbar-mobile-search__icon">
                <i class="fas fa-search"></i>
            </button>
        </form>
    @endif
</div>
