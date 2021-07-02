{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="user-verification">
    <h1 class="user-verification__row user-verification__row--title">
        {{ osu_trans('user_verification.box.title') }}
    </h1>

    <p class="user-verification__row user-verification__row--info">
        {!! osu_trans('user_verification.box.sent', ['mail' => '<strong>'.obscure_email($email).'</strong>']) !!}
    </p>

    <div class="user-verification__row user-verification__row--key">
        <input
            data-verification-key-length="{{ config('osu.user.verification_key_length_hex') }}"
            class="user-verification__key js-user-verification--input modal-af"
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
            'reissue_link' => link_to_route(
                'account.reissue-code',
                osu_trans('user_verification.box.info.reissue_link'),
                [],
                ['class' => 'js-user-verification--reissue user-verification__link']
            ),
            'logout_link' =>
                "<button
                    class='js-logout-link user-verification__link'
                    type='button'
                    data-method='delete'
                    data-remote='1'
                    data-url='".route('logout')."'
                >".osu_trans('user_verification.box.info.logout_link')."
                </button>",
        ]) !!}
    </p>
</div>
