{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\UserNotificationOption;
@endphp
<div class="account-edit">
    <div class="account-edit__section">
        <h2 class="account-edit__section-title">
            {{ trans('accounts.notifications.title') }}
        </h2>
    </div>

    <div class="account-edit__input-groups">
        <div class="account-edit__input-group">
            <div
                class="account-edit-entry account-edit-entry--no-label js-account-edit"
                data-account-edit-auto-submit="1"
                data-url="{{ route('account.options') }}"
            >
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

            <div
                class="account-edit-entry account-edit-entry--no-label js-account-edit"
                data-account-edit-auto-submit="1"
                data-url="{{ route('account.notification-options') }}"
            >
                <label class="account-edit-entry__checkbox">
                    @php
                        $name = App\Models\Notification::COMMENT_NEW;
                        $option = UserNotificationOption::COMMENT_REPLY;
                    @endphp
                    @include('objects._switch', [
                        'additionalClass'=> 'js-account-edit__input',
                        'checked' => $notificationOptions[$name]->details[$option] ?? true,
                        'name' => "user_notification_option[{$name}][details][{$option}]",
                    ])

                    <span class="account-edit-entry__checkbox-label">
                        {{ trans('accounts.notifications.comment_reply') }}
                    </span>

                    <div class="account-edit-entry__checkbox-status">
                        @include('accounts._edit_entry_status')
                    </div>
                </label>
            </div>
        </div>

        <div class="account-edit__input-group">
            @foreach (UserNotificationOption::BEATMAPSET_DISQUALIFIABLE_NOTIFICATIONS as $notificationType)
                <div class="account-edit-entry account-edit-entry--no-label">
                    <div class="account-edit-entry__checkboxes-label">
                        {{ trans("accounts.notifications.$notificationType") }}
                    </div>
                    <form
                        class="account-edit-entry__checkboxes js-account-edit"
                        data-account-edit-auto-submit="1"
                        data-account-edit-type="array"
                        data-url="{{ route('account.notification-options') }}"
                        data-field="{{ "user_notification_option[{$notificationType}][details][modes]" }}"
                    >
                        @php
                            $modes = $notificationOptions[$notificationType]->details['modes'] ?? [];
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
            @endforeach
        </div>

        <div class="account-edit__input-group">
            <div class="account-edit-entry">
                <div class="account-edit-entry__label account-edit-entry__label--top-pinned">
                    {{ trans('accounts.notifications.options._') }}
                </div>

                <form
                    class="account-edit-entry__delivery-options js-account-edit"
                    data-account-edit-auto-submit="1"
                    data-account-edit-type="multi"
                    data-url="{{ route('account.notification-options') }}"
                >
                    @foreach (UserNotificationOption::DELIVERY_MODES as $mode)
                        <div>{{ trans("accounts.notifications.options.{$mode}") }}</div>
                    @endforeach

                    <div>@include('accounts._edit_entry_status')</div>

                    @foreach (UserNotificationOption::HAS_DELIVERY_MODES as $name)
                        @foreach (UserNotificationOption::DELIVERY_MODES as $mode)
                            <label
                                class="account-edit-entry__checkbox account-edit-entry__checkbox--grid"
                            >
                                @include('objects._switch', [
                                    'additionalClass'=> 'js-account-edit__input',
                                    'checked' => $notificationOptions[$name]->details[$mode] ?? UserNotificationOption::DELIVERY_MODE_DEFAULTS[$mode],
                                    'defaultValue' => '0',
                                    'modifiers' => ['grid'],
                                    'name' => "user_notification_option[{$name}][details][{$mode}]",
                                ])
                            </label>
                        @endforeach

                        <span class="account-edit-entry__checkbox-label account-edit-entry__checkbox-label--grid">
                            {{ trans("accounts.notifications.options.{$name}") }}
                        </span>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
