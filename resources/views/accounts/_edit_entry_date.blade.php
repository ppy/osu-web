{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
<div class="account-edit-entry js-account-edit" data-account-edit-auto-submit="1">
    <input
        class="account-edit-entry__input js-account-edit__input"
        type="date"
        min="1900-01-01"
        max="{{ Carbon\Carbon::now()->toDateString() }}"
        name="user[{{ $field }}]"
        maxlength="10"
        placeholder="yyyy-mm-dd"
        data-last-value="{{ Auth::user()->$field->toDateString() }}"
        value="{{ Auth::user()->$field->toDateString() }}"
    >

    <div class="account-edit-entry__label">
        {{ trans("accounts.edit.profile.user.{$field}") }}
    </div>

    @include('accounts._edit_entry_status')
</div>
