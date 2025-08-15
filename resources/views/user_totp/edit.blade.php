{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic-compact">
        <form
            action="{{ route('user-totp.destroy') }}"
            class="password-reset js-form-error"
            method="DELETE"
            data-remote
            data-skip-ajax-error-popup="1"
        >
            <label class="password-reset__input-group">
                {{ osu_trans('user_totp.edit.password') }}
                <input autofocus class="password-reset__input" name="password" type="password">
                <span class="password-reset__error js-form-error--error"></span>
            </label>

            <div class="password-reset__input-group">
                <button class="btn-osu-big btn-osu-big--password-reset">
                    {{ osu_trans('user_totp.edit.start') }}
                </button>
            </div>
        </form>
    </div>
@endsection
