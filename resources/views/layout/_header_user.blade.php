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
    $class = 'avatar
        avatar--nav2
        js-current-user-avatar
        js-click-menu
        js-user-login--menu
        js-user-header';
@endphp
@if (Auth::user() === null)
    <button
        class="{{ $class }} avatar--guest"
        data-click-menu-target="nav2-login-box"
        title="{{ trans('users.anonymous.login_link') }}"
    ></button>
@else
    <a
        class="{{ $class }} {{ Auth::user()->isRestricted() ? 'avatar--restricted' : '' }}"
        data-click-menu-target="nav2-user-popup"
        href="{{ route('users.show', Auth::user()) }}"
        {!! background_image(Auth::user()->user_avatar, false) !!}
    ></a>
@endif
