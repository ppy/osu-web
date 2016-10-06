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
<div class="user-prefs-section__right-section">
    @foreach($elements as $elem)
        <div class="user-prefs-section__right-row">
            <div class="user-prefs-section__label">
                 <span>{{ trans("users.settings.prefs.$elem") }}</span>
            </div>
            <input
                type="text"
                id="{{ $elem }}"
                class="user-prefs-section__textbox js-user-prefs--field"
                value="{{ in_array($elem, $user::EDITABLE, true) ? $user->{$elem} : $user->profileCustomization->{$elem} }}"
            />
            <div id="{{ $elem }}" class="user-prefs-section__saved js-user-prefs--saved">{{ trans('users.settings.saved') }}</div>
        </div>
    @endforeach
</div>
