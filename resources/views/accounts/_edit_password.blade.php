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
{!! Form::open([
    'route' => 'account.password',
    'method' => 'PUT',
    'data-remote' => true,
    'data-skip-ajax-error-popup' => '1',
    'class' => 'js-form-clear js-form-error js-account-edit account-edit'
]) !!}
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.edit.password.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <label class="account-edit-entry" data-password-field="current_password">
                <input
                    class="account-edit-entry__input"
                    name="user[current_password]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ trans('accounts.edit.password.current') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </label>
        </div>

        <div class="account-edit__input-group">
            <label class="account-edit-entry" data-password-field="password">
                <input
                    class="account-edit-entry__input js-form-confirmation"
                    name="user[password]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ trans('accounts.edit.password.new') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </label>

            <label
                class="account-edit-entry"
                data-password-field="password_confirmation"
            >
                <input
                    class="account-edit-entry__input js-form-confirmation"
                    name="user[password_confirmation]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ trans('accounts.edit.password.new_confirmation') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </label>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <button class="btn-osu-big btn-osu-big--account-edit" type="submit" data-disable-with="{{ trans('common.buttons.saving') }}">
                    <div class="btn-osu-big__content">
                        <div class="btn-osu-big__left">
                            {{ trans('accounts.update_password.update') }}
                        </div>

                        <div class="btn-osu-big__icon">
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                </button>

                @include('accounts._edit_entry_status')
            </div>
        </div>
    </div>
{!! Form::close() !!}
