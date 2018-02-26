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
            <i class="fa fa-sign-out"></i>
        </a>
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
