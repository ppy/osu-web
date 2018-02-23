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
<div class="user-verification">
    <h1 class="user-verification__row user-verification__row--title">
        {{ trans('user_verification.box.title') }}
    </h1>

    <p class="user-verification__row user-verification__row--info">
        {!! trans('user_verification.box.sent', ['mail' => '<strong>'.obscure_email($email).'</strong>']) !!}
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
                <i class="fa fa-spinner fa-pulse"></i>
            </span>

            <span class="js-user-verification--message-text"></span>
        </div>
    </div>

    <p class="user-verification__row user-verification__row--info">
        {{ trans('user_verification.box.info.check_spam') }}
    </p>

    <p class="user-verification__row user-verification__row--info">
        {!! trans('user_verification.box.info.recover', [
            'link' => link_to(
                osu_url('user.recover'),
                trans('user_verification.box.info.recover_link'),
                ['class' => 'user-verification__link']
            ),
        ]) !!}
        {!! trans('user_verification.box.info.reissue', [
            'reissue_link' => link_to_route(
                'account.reissue-code',
                trans('user_verification.box.info.reissue_link'),
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
                >".trans('user_verification.box.info.logout_link')."
                </button>",
        ]) !!}
    </p>
</div>
