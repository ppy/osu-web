{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="user-verification">
    <h1 class="user-verification__row user-verification__row--title">
        {{ osu_trans('user_verification.box.title') }}
    </h1>

    @if ($state->getMethod() === 'mail')
        <p class="user-verification__row user-verification__row--info">
            {!! osu_trans('user_verification.box.sent', [
                'mail' => tag('strong', [], e(obscure_email($state->user->user_email))),
            ]) !!}
        </p>

        <div class="user-verification__row user-verification__row--key">
            <input
                data-verification-key-length="{{ $GLOBALS['cfg']['osu']['user']['verification_key_length_hex'] }}"
                class="user-verification__key js-user-verification--input modal-af"
            />

            <div
                class="user-verification__message js-user-verification--message"
                data-visibility="{{ isset($message) ? '' : 'hidden' }}"
            >
                <span
                    class="user-verification__message-spinner js-user-verification--message-spinner"
                    data-visibility="hidden"
                >
                    {!! spinner() !!}
                </span>

                <span class="js-user-verification--message-text">{{ $message ?? '' }}</span>
            </div>
        </div>

        <p class="user-verification__row user-verification__row--info">
            {{ osu_trans('user_verification.box.info.check_spam') }}
        </p>

        <p class="user-verification__row user-verification__row--info">
            {!! osu_trans('user_verification.box.info.recover', [
                'link' => link_to(
                    osu_url('user.recover'),
                    osu_trans('user_verification.box.info.recover_link'),
                    ['class' => 'user-verification__link']
                ),
            ]) !!}
            {!! osu_trans('user_verification.box.info.reissue', [
                'reissue_link' => link_to(
                    route('account.reissue-code'),
                    osu_trans('user_verification.box.info.reissue_link'),
                    ['class' => 'js-user-verification--reissue user-verification__link']
                ),
                'logout_link' => tag(
                    'button',
                    [
                        'class' => 'js-logout-link user-verification__link',
                        'data-method' => 'DELETE',
                        'data-remote' => '1',
                        'data-url' => route('logout'),
                        'type' => 'button',
                    ],
                    e(osu_trans('user_verification.box.info.logout_link')),
                ),
            ]) !!}
        </p>
    @else
        <p class="user-verification__row user-verification__row--info">
            {{ osu_trans('user_verification.box_totp.heading') }}
        </p>

        <div class="user-verification__row user-verification__row--key">
            <input
                autocomplete="one-time-code"
                class="user-verification__key js-user-verification--input modal-af"
                data-verification-key-length="{{ App\Models\UserTotpKey::digits() }}"
                inputmode="numeric"
            />

            <div class="user-verification__message js-user-verification--message" data-visibility="hidden">
                <span class="
                    user-verification__message-spinner
                    js-user-verification--message-spinner
                ">
                    {!! spinner() !!}
                </span>

                <span class="js-user-verification--message-text"></span>
            </div>
        </div>

        <p class="user-verification__row user-verification__row--info">
            {!! osu_trans('user_verification.box_totp.info.mail_fallback._', [
                'link' => link_to(
                    route('account.verify-mail-fallback'),
                    osu_trans('user_verification.box_totp.info.mail_fallback.link'),
                    [
                        'class' => 'user-verification__link',
                        'data-turbo-method' => 'POST',
                    ],
                ),
            ]) !!}
            {!! osu_trans('user_verification.box_totp.info.logout._', [
                'link' => tag(
                    'button',
                    [
                        'class' => 'js-logout-link user-verification__link',
                        'data-method' => 'DELETE',
                        'data-remote' => '1',
                        'data-url' => route('logout'),
                        'type' => 'button',
                    ],
                    e(osu_trans('user_verification.box_totp.info.logout.link')),
                ),
            ]) !!}
        </p>
    @endif
</div>
