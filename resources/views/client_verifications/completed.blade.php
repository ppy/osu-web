{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'blank' => true,
    'titlePrepend' => osu_trans('client_verifications.completed.title'),
])

@section('content')
    <div class="dialog-form">
        <div class="dialog-form__dialog">
            <div class="dialog-form__row dialog-form__row--header"></div>

            <div class="dialog-form__row dialog-form__row--title">
                <div class="dialog-form__logo"></div>
                <h1 class="dialog-form__title">{{ osu_trans('client_verifications.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--client-verification-completed">
                <div class="account-verification-message">
                    <div class="account-verification-message__icon">
                        <span class="far fa-check-circle"></span>
                    </div>

                    <div class="account-verification-message__title">
                        {{ osu_trans('client_verifications.completed.title') }}
                    </div>
                </div>
            </div>

            <div class="dialog-form__row dialog-form__row--client-verification-completed-buttons">
                <a href="{{ route('home') }}" class="dialog-form__button">
                    {{ osu_trans('client_verifications.completed.home') }}
                </a>

                <button
                    class="js-logout-link dialog-form__extra-link dialog-form__extra-link--small"
                    data-confirm="{{ osu_trans('users.logout_confirm') }}"
                    data-method="DELETE"
                    data-redirect-home='1'
                    data-remote="1"
                    data-url="{{ route('logout') }}"
                >
                    {{ osu_trans('client_verifications.completed.logout') }}
                </button>
            </div>
        </div>
    </div>
@endsection
