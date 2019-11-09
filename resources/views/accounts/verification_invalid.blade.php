{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'blank' => true,
    'title' => trans('accounts.verification_invalid.title'),
])

@section('content')
    <div class="oauth-form">
        <div class="oauth-form__dialog">
            <div class="oauth-form__row oauth-form__row--header"></div>

            <div class="oauth-form__row oauth-form__row--title">
                <div class="oauth-form__logo"></div>
                <h1 class="oauth-form__title">{{ trans('users.verify.title') }}</h1>
            </div>

            <div class="oauth-form__row oauth-form__row--verification-invalid">
                <div class="account-verification-message">
                    <div class="account-verification-message__title">
                        {{ trans('accounts.verification_invalid.title') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
