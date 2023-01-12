{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $params = get_params(request()->all(), null, [
        'username',
        'email',
    ], ['null_missing' => true]);
    $focus = $params['username'] === null ? 'username' : 'password';
@endphp

@extends('master')

@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic">
        <form
            action="{{ route('users.store-web') }}"
            class="simple-form simple-form--user-create js-form-error js-captcha--reset-on-error"
            data-remote="1"
            data-skip-ajax-error-popup="1"
            method="POST"
        >
            <label class="simple-form__row js-form-error--field">
                <div class="simple-form__label">
                    {{ osu_trans('users.create.form.username') }}
                </div>

                <input
                    class="simple-form__input"
                    name="user[username]"
                    required
                    value="{{ $params['username'] }}"
                    {{ $focus === 'username' ? 'autofocus' : '' }}
                >
                <div class="simple-form__error js-form-error--error"></div>
            </label>

            <label class="simple-form__row js-form-error--field">
                <div class="simple-form__label">
                    {{ osu_trans('users.create.form.password') }}
                </div>

                <input
                    class="simple-form__input js-form-confirmation"
                    name="user[password]"
                    type="password"
                    required
                    {{ $focus === 'password' ? 'autofocus' : '' }}
                >
                <div class="simple-form__error js-form-error--error"></div>
            </label>

            <label class="simple-form__row js-form-error--field">
                <div class="simple-form__label">
                    {{ osu_trans('users.create.form.password_confirmation') }}
                </div>

                <input
                    class="simple-form__input js-form-confirmation"
                    name="user[password_confirmation]"
                    type="password"
                    required
                >
                <div class="simple-form__error js-form-error--error"></div>
            </label>

            <label class="simple-form__row js-form-error--field">
                <div class="simple-form__label">
                    {{ osu_trans('users.create.form.user_email') }}
                </div>

                <input
                    class="simple-form__input js-form-confirmation"
                    name="user[user_email]"
                    required
                    type="email"
                    value="{{ $params['email'] }}"
                >
                <div class="simple-form__error js-form-error--error"></div>
            </label>

            <label class="simple-form__row js-form-error--field">
                <div class="simple-form__label">
                    {{ osu_trans('users.create.form.user_email_confirmation') }}
                </div>

                <input
                    class="simple-form__input js-form-confirmation"
                    name="user[user_email_confirmation]"
                    required
                    type="email"
                    value="{{ $params['email'] }}"
                >
                <div class="simple-form__error js-form-error--error"></div>
            </label>

            @if (captcha_enabled())
                <div
                    class="simple-form__row simple-form__row--no-label"
                >
                    <div
                        class="simple-form__captcha js-captcha--container"
                        data-captcha-triggered="1"
                    ></div>
                </div>
                @include('objects._captcha_script')
            @endif

            <div class="simple-form__row simple-form__row--no-label">
                <div class="simple-form__buttons">
                    <div class="simple-form__button">
                        <button
                            class="btn-osu-big btn-osu-big--rounded-thin js-captcha--submit-button"
                            type="submit"
                        >
                            {{ osu_trans('users.create.form.submit') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="simple-form__row simple-form__row--no-label">
                <p>
                    {!! osu_trans('users.create.form.tos_notice._', [
                        'link' => tag(
                            'a',
                            [
                                'href' => route('legal', ['locale' => app()->getLocale(), 'path' => 'Terms']),
                                'target' => '_blank',
                            ],
                            osu_trans('users.create.form.tos_notice.link')
                        ),
                    ]) !!}
                </p>
            </div>
        </form>
    </div>
@endsection
