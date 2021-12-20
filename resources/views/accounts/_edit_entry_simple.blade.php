{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
        @if (Auth::user()->isSilenced())
            disabled
        @endif
    >

    <div class="account-edit-entry__label">
        {{ osu_trans("accounts.edit.profile.user.{$field}") }}
    </div>

    @include('accounts._edit_entry_status')

    <span class="account-edit-entry__error js-form-error--error"></span>
</div>
