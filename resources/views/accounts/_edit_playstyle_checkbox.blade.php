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
<label class="account-edit-entry js-account-edit js-account-edit-playstyle" data-playstyle="{{ $field }}">
    <div class="account-edit-entry__label">
        @lang('accounts.playstyles.'.$field)
    </div>

    <div class="osu-checkbox">
        <input
            value="{{$field}}"
            class="osu-checkbox__input"
            type="checkbox"
            @if (is_array(Auth::user()->osu_playstyle) && in_array($field, Auth::user()->osu_playstyle))
                checked
            @endif
        >
        <span class="osu-checkbox__box"></span>
        <span class="osu-checkbox__tick">
            <i class="fa fa-check"></i>
        </span>
    </div>
    @include('accounts._edit_entry_status')

</label>
