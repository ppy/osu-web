{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
