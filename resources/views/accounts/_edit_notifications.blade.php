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
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.notifications.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label js-account-edit" data-account-edit-auto-submit="1" data-skip-ajax-error-popup="1">
                <label class="account-edit-entry__checkbox">
                    @include('objects._switch', [
                        'attributes' => [
                            'name' => 'user[user_notify]',
                            'type' => 'checkbox',
                            'value' => 1,
                        ],
                        'checked' => auth()->user()->user_notify,
                        'additionalClass'=> 'js-account-edit__input',
                    ])

                    <span class="account-edit-entry__checkbox-label">
                        {{ trans('accounts.notifications.topic_auto_subscribe') }}
                    </span>

                    <div class="account-edit-entry__checkbox-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
