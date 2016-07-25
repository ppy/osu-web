{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
    class="nav-popup-container js-nav-popup js-nav-popup--popup"
    data-visibility="hidden"
    data-visibility-animation="none"
>
    <div class="nav-popup-box">
        <div class="nav-popup-box__content">
            @include('layout._popup_menu')
        </div>
    </div>

    <div
        class="nav-popup-box nav-popup-box--extra js-nav-switch--animated js-nav-switch--menu"
        data-nav-mode="user"
    >
        <div class="nav-popup-box__content">
            @if (Auth::check())
                @include('layout._popup_user', ['_user' => Auth::user()])
            @else
                @include('layout._popup_login')
            @endif
        </div>
    </div>
</div>
