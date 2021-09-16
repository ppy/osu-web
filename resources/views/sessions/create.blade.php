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
        'class' => 'dialog-form js-login-form',
        'data-remote' => true,
    ]) !!}
        <div class="dialog-form__dialog">
            <div class="dialog-form__row dialog-form__row--header"></div>

            <div class="dialog-form__row dialog-form__row--title">
                <div class="dialog-form__logo"></div>
                <h1 class="dialog-form__title">{{ osu_trans('sessions.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--label">
                {{ osu_trans('sessions.create.label') }}
            </div>

            <div class="dialog-form__row dialog-form__row--input">
                <input
                    class="dialog-form__input js-login-form-input"
                    name="username"
                    placeholder="{{ osu_trans('layout.popup_login.login.username') }}"
                    required
                    autofocus
                />
            </div>

            <div class="dialog-form__row dialog-form__row--input">
                <input
                    class="dialog-form__input js-login-form-input"
                    name="password"
                    type="password"
                    placeholder="{{ osu_trans('layout.popup_login.login.password') }}"
                    required
                />
            </div>

            @if (captcha_enabled())
                <div class="dialog-form__row">
                    <div class="js-captcha--container"></div>
                </div>
                @include('objects._captcha_script')
            @endif

            <div class="dialog-form__row dialog-form__row--error js-login-form--error">
            </div>

            <div class="dialog-form__row dialog-form__row--extra-link">
                <a href="{{ route('password-reset') }}" class="dialog-form__extra-link">
                    {{ osu_trans('layout.popup_login.login.forgot') }}
                </a>
            </div>

            <div class="dialog-form__row dialog-form__row--extra-link">
                {{ osu_trans('layout.popup_login.register.title') }}
                <a href="{{ route('download') }}" class="dialog-form__extra-link">
                    {{ osu_trans('sessions.create.download') }}
                </a>
            </div>

            <div class="dialog-form__row dialog-form__row--buttons">
                <button
                    class="dialog-form__button js-captcha--submit-button"
                    data-disable-with="{{ osu_trans('users.login.button_posting') }}"
                >
                    {{ osu_trans('users.login._') }}
                </button>

                <a
                    href="{{ $cancelUrl ?? route('home') }}"
                    class="dialog-form__button dialog-form__button--cancel"
                >
                    {{ osu_trans('common.buttons.cancel') }}
                </a>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
