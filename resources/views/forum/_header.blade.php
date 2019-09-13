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
<div class="js-header--main {{ class_with_modifiers('header-v4', $modifiers) }}">
    <div class="header-v4__bg-container">
        <div
            class="header-v4__bg js-forum-cover--header"
            {!! background_image($background ?? null, false) !!}
        ></div>
    </div>

    <div class="header-v4__content">
        <div class="header-v4__row header-v4__row--title">
            <div class="header-v4__icon"></div>
            <div class="header-v4__title">
                <span class="header-v4__title-section">
                    {{ trans('layout.header.community._') }}
                </span>
                <span class="header-v4__title-action">
                    {{ trans('layout.header.community.forum') }}
                </span>
            </div>
        </div>

        <div class="header-v4__row header-v4__row--bar">
            @include('forum._header_breadcrumb')
        </div>
    </div>
</div>
