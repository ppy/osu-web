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
<div
    class="simple-menu simple-menu--nav2 js-click-menu js-nav2--centered-popup"
    data-click-menu-id="nav2-user-popup"
    data-visibility="hidden"
>
    <a
        href="{{ route('users.show', Auth::user()) }}"
        class="simple-menu__header simple-menu__header--link js-current-user-cover"
        {!! background_image(Auth::user()->cover(), false) !!}
    >
        <img class="simple-menu__header-icon" src="/images/icons/profile.svg" alt="">
        <div>{{ Auth::user()->username }}</div>
    </a>

    <a
        class="simple-menu__item"
        href="{{ route('users.show', Auth::user()) }}"
    >
        {{ trans('layout.popup_user.links.profile') }}
    </a>

    <a class="simple-menu__item" href="{{ route('friends.index') }}">
        {{ trans('layout.popup_user.links.friends') }}
    </a>

    <a class="simple-menu__item" href="{{ route('account.edit') }}">
        {{ trans('layout.popup_user.links.account-edit') }}
    </a>

    <button
        class="js-logout-link simple-menu__item"
        type="button"
        data-url="{{ route('logout') }}"
        data-confirm="{{ trans('users.logout_confirm') }}"
        data-method="delete"
        data-remote="1"
    >
        {{ trans('layout.popup_user.links.logout') }}
    </button>
</div>
