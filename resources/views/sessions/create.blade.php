{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
                <h1 class="dialog-form__title">{{ trans('sessions.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--label">
                {{ trans('sessions.create.label') }}
            </div>

            <div class="dialog-form__row dialog-form__row--input">
                <input
                    class="dialog-form__input js-login-form-input"
                    name="username"
                    placeholder="{{ trans('layout.popup_login.login.username') }}"
                    required
                    autofocus
                />
            </div>

            <div class="dialog-form__row dialog-form__row--input">
                <input
                    class="dialog-form__input js-login-form-input"
                    name="password"
                    type="password"
                    placeholder="{{ trans('layout.popup_login.login.password') }}"
                    required
                />
            </div>

            <div class="dialog-form__row dialog-form__row--error js-login-form--error">
            </div>

            <div class="dialog-form__row dialog-form__row--extra-link">
                <a href="{{ route('password-reset') }}" class="dialog-form__extra-link">
                    {{ trans('layout.popup_login.login.forgot') }}
                </a>
            </div>

            <div class="dialog-form__row dialog-form__row--extra-link">
                {{ trans('layout.popup_login.register.title') }}
                <a href="{{ route('download') }}" class="dialog-form__extra-link">
                    {{ trans('sessions.create.download') }}
                </a>
            </div>

            <div class="dialog-form__row dialog-form__row--buttons">
                <button
                    class="dialog-form__button"
                    data-disable-with="{{ trans('users.login.button_posting') }}"
                >
                    {{ trans('users.login._') }}
                </button>

                <a
                    href="{{ $cancelUrl ?? route('home') }}"
                    class="dialog-form__button dialog-form__button--cancel"
                >
                    {{ trans('common.buttons.cancel') }}
                </a>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
