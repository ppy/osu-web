{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open([
    'route' => 'account.password',
    'method' => 'PUT',
    'data-remote' => true,
    'data-skip-ajax-error-popup' => '1',
    'class' => 'js-form-clear js-form-error js-account-edit js-password-update account-edit'
]) !!}
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ osu_trans('accounts.edit.password.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry js-form-error--field">
                <input
                    class="account-edit-entry__input"
                    name="user[current_password]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ osu_trans('accounts.edit.password.current') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry js-form-error--field">
                <input
                    class="account-edit-entry__input js-form-confirmation"
                    name="user[password]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ osu_trans('accounts.edit.password.new') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </div>

            <div class="account-edit-entry js-form-error--field">
                <input
                    class="account-edit-entry__input js-form-confirmation"
                    name="user[password_confirmation]"
                    type="password"
                    required
                >

                <div class="account-edit-entry__label">
                    {{ osu_trans('accounts.edit.password.new_confirmation') }}
                </div>

                <div class="account-edit-entry__error js-form-error--error"></div>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <button class="btn-osu-big btn-osu-big--account-edit" type="submit" data-disable-with="{{ osu_trans('common.buttons.saving') }}">
                    <div class="btn-osu-big__content">
                        <div class="btn-osu-big__left">
                            {{ osu_trans('accounts.update_password.update') }}
                        </div>

                        <div class="btn-osu-big__icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </button>

                @include('accounts._edit_entry_status')
            </div>
        </div>
    </div>
{!! Form::close() !!}
