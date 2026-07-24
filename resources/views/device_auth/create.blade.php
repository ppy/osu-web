{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $user = Auth::user();
    $userCode = get_string(request('user_code'));
@endphp

@extends('master', [
    'blank' => true,
    'titleOverride' => 'Device OAuth',
])

@section('content')
    <div class="dialog-form">
        <div class="dialog-form__dialog">
            <div
                class="dialog-form__row dialog-form__row--header"
                style="background-image: url('{{ $user->cover()->url() }}')"
            >
                <div class="dialog-form__header-overlay"></div>
                <a
                    class="dialog-form__user-header"
                    href="{{ route('users.show', ['user' => $user->getKey()]) }}"
                >
                    <div class="dialog-form__user-avatar">
                        <div
                            class="avatar avatar--full-circle"
                            style="background-image: url('{{ $user->user_avatar }}')"
                        ></div>
                    </div>

                    {{ $user->username }}
                </a>
            </div>

            <div class="dialog-form__row dialog-form__row--title">
                <div class="dialog-form__logo"></div>
                <h1 class="dialog-form__title">
                    Authorise Device
                </h1>
            </div>

            <form
                action="{{ route('device-auth') }}"
                class="u-contents"
                method="POST"
            >
                @csrf
                <div class="dialog-form__row dialog-form__row--label">
                    Enter the code shown on the device
                </div>

                <div class="dialog-form__row dialog-form__row--input">
                    <input class="dialog-form__input" name="user_code" value="{{ $userCode }}">
                </div>

                <div class="dialog-form__row dialog-form__row--buttons">
                    <button class="dialog-form__button">
                        Authorise
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
