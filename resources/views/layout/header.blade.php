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
@include('layout._header_mobile')
<div class="nav2-header">
    <div class="bg">
        <div class="bg__triangles"></div>
        <div class="bg__gradient-overlay u-section--gradient-down"></div>
    </div>

    <div class="hidden-xs no-print osu-page">
        @include('layout._nav2')
    </div>
</div>

<div class="js-user-verification--reference"></div>
@include('layout._user_verification_popup')

@if (Auth::user() === null)
    @include('layout._popup_login')
@endif

@if (Auth::user() && Auth::user()->isRestricted())
    <div class="osu-page">
        @include('objects._notification_banner', [
            'type' => 'alert',
            'title' => trans('users.restricted_banner.title'),
            'message' => trans('users.restricted_banner.message'),
        ])
    </div>
@endif
