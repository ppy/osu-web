{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'blank' => true,
    'titlePrepend' => osu_trans('accounts.verification_completed.title'),
])

@section('content')
    <div class="dialog-form">
        <div class="dialog-form__dialog">
            <div class="dialog-form__row dialog-form__row--header"></div>

            <div class="dialog-form__row dialog-form__row--title">
                <div class="dialog-form__logo"></div>
                <h1 class="dialog-form__title">{{ osu_trans('users.verify.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--verification-completed">
                <div class="account-verification-message">
                    <div class="account-verification-message__icon">
                        <span class="far fa-check-circle"></span>
                    </div>

                    <div class="account-verification-message__title">
                        {{ osu_trans('accounts.verification_completed.title') }}
                    </div>

                    <div class="account-verification-message__text">
                        {{ osu_trans('accounts.verification_completed.text') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
