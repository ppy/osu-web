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
@include('layout._header_mobile')

<div
    class="
    js-pinned-header
    hidden-xs
    no-print
    nav2-header
    {{ optional(Auth::user())->isRestricted() ? 'nav2-header--restricted' : '' }}
">
    <div class="nav2-header__body">
        <div class="nav2-header__menu-bg js-nav2--menu-bg" data-visibility="hidden"></div>
        <div class="nav2-header__triangles"></div>
        <div class="nav2-header__transition-overlay"></div>

        <div class="osu-page">
            @include('layout._nav2')
        </div>
    </div>
    @include('layout._sticky_header')
</div>

@if (Auth::user() === null)
    @include('layout._popup_login')
@endif


<div class="js-user-verification--reference"></div>
@include('layout._user_verification_popup')
