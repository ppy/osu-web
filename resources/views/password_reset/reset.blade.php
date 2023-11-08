{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'theme' => 'password-reset',
    ]])
    <div class="osu-page osu-page--generic-compact">
        {!! Form::open([
            'route' => 'password-reset',
            'class' => 'password-reset js-form-error',
            'method' => 'PUT',
            'data-remote' => true,
            'data-reload-on-success' => '1',
            'data-skip-ajax-error-popup' => '1',
        ]) !!}
            {!! osu_trans('password_reset.started.title', ['username' => e($username)]) !!}

            <div class="password-reset__input-group">
                <a
                    class="btn-osu-big btn-osu-big--password-reset"
                    href="{{ route('password-reset.resend-mail', ['username' => $username]) }}"
                    data-method="POST"
                    data-remote="1"
                >
                    {{ osu_trans('password_reset.button.resend') }}
                </a>
            </div>

            <input type="hidden" name="username" value="{{ $username }}" />

            <label class="password-reset__input-group">
                {{ osu_trans('password_reset.started.verification_key') }}

                <input name="key" class="password-reset__input" autofocus>

                <span class="password-reset__error js-form-error--error"></span>
            </label>

            <label class="password-reset__input-group">
                {{ osu_trans('password_reset.started.password') }}

                <input type="password" class="js-form-confirmation password-reset__input" name="user[password]">

                <span class="password-reset__error js-form-error--error"></span>
            </label>

            <label class="password-reset__input-group">
                {{ osu_trans('password_reset.started.password_confirmation') }}

                <input type="password" class="js-form-confirmation password-reset__input" name="user[password_confirmation]">

                <span class="password-reset__error js-form-error--error"></span>
            </label>

            <div class="password-reset__input-group">
                <button class="btn-osu-big btn-osu-big--password-reset">
                    {{ osu_trans('password_reset.button.set') }}
                </button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
