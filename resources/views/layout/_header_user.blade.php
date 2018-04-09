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
<button
    class="
        avatar
        avatar--nav2
        {{ Auth::user() === null ? 'avatar--guest' : '' }}
        js-current-user-avatar
        js-click-menu
        js-user-login--menu
        js-user-header
    "
    @if (Auth::user() === null)
        title="{{ trans('users.anonymous.login_link') }}"
    @else
        {!! background_image(Auth::user()->user_avatar, false) !!}
    @endif
    data-click-menu-target="{{ Auth::user() === null ? 'nav2-login-box' : 'nav2-user-popup' }}"
></button>
