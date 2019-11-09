{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'blank' => true,
])

@section('content')
    {!! Form::open([
        'url' => route('login'),
        'class' => 'oauth-form js-login-form',
        'data-remote' => true,
    ]) !!}
        <div class="oauth-form__dialog">
            <div class="oauth-form__row oauth-form__row--header"></div>

            <div class="oauth-form__row oauth-form__row--title">
                <div class="oauth-form__logo"></div>
                <h1 class="oauth-form__title">{{ trans('oauth.login.title') }}</h1>
            </div>

            <div class="oauth-form__row oauth-form__row--label">
                {{ trans('oauth.login.label') }}
            </div>

            <div class="oauth-form__row oauth-form__row--input">
                <input
                    class="oauth-form__input js-login-form-input"
                    name="username"
                    placeholder="{{ trans('layout.popup_login.login.email') }}"
                    required
                    autofocus
                />
            </div>

            <div class="oauth-form__row oauth-form__row--input">
                <input
                    class="oauth-form__input js-login-form-input"
                    name="password"
                    type="password"
                    placeholder="{{ trans('layout.popup_login.login.password') }}"
                    required
                />
            </div>

            <div class="oauth-form__row oauth-form__row--error js-login-form--error">
            </div>

            <div class="oauth-form__row oauth-form__row--extra-link">
                <a href="{{ route('password-reset') }}" class="oauth-form__extra-link">
                    {{ trans('layout.popup_login.login.forgot') }}
                </a>
            </div>

            <div class="oauth-form__row oauth-form__row--extra-link">
                {{ trans('layout.popup_login.register.title') }}
                <a href="{{ route('download') }}" class="oauth-form__extra-link">
                    {{ trans('oauth.login.download') }}
                </a>
            </div>

            <div class="oauth-form__row oauth-form__row--buttons">
                <button
                    class="oauth-form__button"
                    data-disable-with="{{ trans('users.login.button_posting') }}"
                >
                    {{ trans('users.login._') }}
                </button>

                <a
                    href="{{ $cancelUrl }}"
                    class="oauth-form__button oauth-form__button--cancel"
                >
                    {{ trans('common.buttons.cancel') }}
                </a>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
