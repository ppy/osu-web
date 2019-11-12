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
                        'additionalClass'=> 'js-account-edit__input',
                        'checked' => auth()->user()->user_notify,
                        'name' => 'user[user_notify]',
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

        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <div class="account-edit-entry__checkboxes-label">
                    {{ trans('accounts.notifications.beatmapset_discussion_qualified_problem') }}
                </div>
                <form
                    class="account-edit-entry__checkboxes js-account-edit"
                    data-account-edit-auto-submit="1"
                    data-account-edit-type="array"
                    data-url="{{ route('account.notification-options', [
                        'name' => App\Models\Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
                    ]) }}"
                    data-field="user_notification_option[details][modes]"
                >
                    @php
                        $modes = $notificationOptions[App\Models\Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM]->details['modes'] ?? [];
                    @endphp
                    @foreach (App\Models\Beatmap::MODES as $key => $_value)
                        <label class="account-edit-entry__checkbox account-edit-entry__checkbox--inline">
                            @include('objects._switch', [
                                'checked' => in_array($key, $modes, true),
                                'value' => $key,
                            ])

                            <span class="account-edit-entry__checkbox-label">
                                {{ trans("beatmaps.mode.{$key}") }}
                            </span>
                        </label>
                    @endforeach

                    <div class="account-edit-entry__checkboxes-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </form>
            </div>
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry account-edit-entry--no-label">
                <div class="account-edit-entry__checkboxes-label">
                    {{ trans('accounts.notifications.mail._') }}
                </div>
                <div class="account-edit-entry__checkboxes account-edit-entry__checkboxes--vertical">
                    @foreach (App\Models\UserNotificationOption::HAS_MAIL_NOTIFICATION as $name)
                        <label
                            class="account-edit-entry__checkbox account-edit-entry__checkbox--inline js-account-edit"
                            data-account-edit-auto-submit="1"
                            data-skip-ajax-error-popup="1"
                            data-url="{{ route('account.notification-options', compact('name')) }}"
                        >
                            @include('objects._switch', [
                                'additionalClass'=> 'js-account-edit__input',
                                'checked' => $notificationOptions[$name]->details['mail'] ?? true,
                                'defaultValue' => '0',
                                'name' => 'user_notification_option[details][mail]',
                            ])

                            <span class="account-edit-entry__checkbox-label">
                                {{ trans("accounts.notifications.mail.{$name}") }}
                            </span>

                            <div class="account-edit-entry__checkbox-status">
                                @include('accounts._edit_entry_status')
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
