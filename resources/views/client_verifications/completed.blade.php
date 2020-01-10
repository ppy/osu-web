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
    'title' => trans('client_verifications.completed.title'),
])

@section('content')
    <div class="dialog-form">
        <div class="dialog-form__dialog">
            <div class="dialog-form__row dialog-form__row--header"></div>

            <div class="dialog-form__row dialog-form__row--title">
                <div class="dialog-form__logo"></div>
                <h1 class="dialog-form__title">{{ trans('client_verifications.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--client-verification-completed">
                <div class="account-verification-message">
                    <div class="account-verification-message__icon">
                        <span class="far fa-check-circle"></span>
                    </div>

                    <div class="account-verification-message__title">
                        {{ trans('client_verifications.completed.title') }}
                    </div>
                </div>
            </div>

            <div class="dialog-form__row dialog-form__row--client-verification-completed-buttons">
                <a href="{{ route('home') }}" class="dialog-form__button">
                    {{ trans('client_verifications.completed.home') }}
                </a>

                <button
                    class="dialog-form__extra-link dialog-form__extra-link--small"
                    data-confirm="{{ trans('users.logout_confirm') }}"
                    data-method="DELETE"
                    data-remote="1"
                    data-url="{{ route('logout', ['redirect_home' => 1]) }}"
                >
                    {{ trans('client_verifications.completed.logout') }}
                </button>
            </div>
        </div>
    </div>
@endsection
