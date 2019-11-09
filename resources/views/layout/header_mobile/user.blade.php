{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<li class="navbar-mobile-item navbar-mobile-item--user">
    @if (Auth::check())
        <a
            class="navbar-mobile-item__main navbar-mobile-item__main--user"
            href="{{ route('users.show', Auth::user()) }}"
            data-toggle="collapse"
            data-target=".js-navbar-mobile--menu"
        >
            <span
                class="avatar avatar--navbar-mobile"
                style="background-image: url('{{ Auth::user()->user_avatar }}');"
            ></span>

            {{ Auth::user()->username }}
        </a>

        <button
            class="navbar-mobile-item__main navbar-mobile-item__main--logout js-logout-link"
            type="button"
            data-url="{{ route('logout') }}"
            data-method="DELETE"
            data-confirm="{{ trans('users.logout_confirm') }}"
            data-remote="1"
            data-toggle="collapse"
            data-target=".js-navbar-mobile--menu"
        >
            <i class="fas fa-sign-out-alt"></i>
        </button>
    @else
        <a
            class="js-user-link navbar-mobile-item__main navbar-mobile-item__main--user"
            href="#"
            title="{{ trans('users.anonymous.login_link') }}"
            data-toggle="collapse"
            data-target=".js-navbar-mobile--menu"
        >
            <span class="avatar avatar--guest avatar--navbar-mobile"></span>

            {{ trans('users.anonymous.username') }}
        </a>
    @endif
</li>
