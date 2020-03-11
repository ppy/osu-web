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
<div class="navbar-mobile-item js-click-menu--close">
    @if (Auth::check())
        <div
            class="navbar-mobile-item__main js-react--user-card"
            data-user="{{ json_encode(Auth::user()->defaultJson()) }}"
        ></div>

        <a
            class="navbar-mobile-item__main"
            href="{{ route('users.show', Auth::user()) }}"
        >
            {{ trans('layout.popup_user.links.profile') }}
        </a>

        <a class="navbar-mobile-item__main" href="{{ route('friends.index') }}">
            {{ trans('layout.popup_user.links.friends') }}
        </a>

        <a class="navbar-mobile-item__main" href="{{ route('account.edit') }}">
            {{ trans('layout.popup_user.links.account-edit') }}
        </a>

        <button
            class="js-logout-link navbar-mobile-item__main"
            type="button"
            data-url="{{ route('logout') }}"
            data-confirm="{{ trans('users.logout_confirm') }}"
            data-method="delete"
            data-remote="1"
        >
            {{ trans('layout.popup_user.links.logout') }}
        </button>
    @else
        <a
            class="js-user-link navbar-mobile-item__main navbar-mobile-item__main--user"
            href="#"
            title="{{ trans('users.anonymous.login_link') }}"
        >
            <span class="avatar avatar--guest avatar--navbar-mobile"></span>

            {{ trans('users.anonymous.username') }}
        </a>
    @endif
</div>
