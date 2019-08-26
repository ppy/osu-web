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
<div class="account-edit-entry js-account-edit js-form-error js-form-error--field" data-account-edit-auto-submit="1" data-skip-ajax-error-popup="1">
    <input
        class="account-edit-entry__input js-account-edit__input"
        name="user[{{ $field }}]"
        data-last-value="{{ Auth::user()->$field }}"
        @if (($maxLength = App\Models\User::MAX_FIELD_LENGTHS[$field]) !== null)
            maxlength="{{ $maxLength }}"
        @endif
        value="{{ Auth::user()->$field }}"
    >

    <div class="account-edit-entry__label">
        {{ trans("accounts.edit.profile.user.{$field}") }}
    </div>

    @include('accounts._edit_entry_status')

    <span class="account-edit-entry__error js-form-error--error"></span>
</div>
