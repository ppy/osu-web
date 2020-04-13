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
                    data-url="{{ route('account.notification-options') }}"
                    data-field="user_notification_option[{{ App\Models\Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM }}][details][modes]"
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
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">
                    {{ trans('accounts.notifications.options._') }}
                </div>

                <form
                    class="account-edit-entry__grid js-account-edit"
                    data-account-edit-auto-submit="1"
                    data-account-edit-type="multi"
                    data-skip-ajax-error-popup="1"
                    data-url="{{ route('account.notification-options') }}"
                >
                    <div class="account-edit-entry__checkbox">{{ trans('accounts.notifications.options.mail') }}</div>
                    <div class="account-edit-entry__checkbox">{{ trans('accounts.notifications.options.push') }}</div>
                    <div class="account-edit-entry__checkbox"></div>

                    @foreach (App\Models\UserNotificationOption::HAS_NOTIFICATION as $name)
                        <label
                            class="account-edit-entry__checkbox account-edit-entry__checkbox--grid"
                        >
                            @include('objects._switch', [
                                'additionalClass'=> 'js-account-edit__input',
                                'checked' => $notificationOptions[$name]->details['mail'] ?? true,
                                'defaultValue' => '0',
                                'name' => "user_notification_option[{$name}][details][mail]",
                            ])
                        </label>

                        <label
                            class="account-edit-entry__checkbox account-edit-entry__checkbox--grid"
                        >
                            @include('objects._switch', [
                                'additionalClass'=> 'js-account-edit__input',
                                'checked' => $notificationOptions[$name]->details['push'] ?? true,
                                'defaultValue' => '0',
                                'name' => "user_notification_option[{$name}][details][push]",
                            ])
                        </label>

                        <span class="account-edit-entry__checkbox-label">
                            {{ trans("accounts.notifications.options.{$name}") }}
                        </span>
                    @endforeach
                    <div class="account-edit-entry__checkboxes-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
