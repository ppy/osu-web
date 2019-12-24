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
@php
    $user = auth()->user();
@endphp

@extends('master', [
    'blank' => true,
])

@section('content')
    <div class="dialog-form">
        <div class="dialog-form__dialog">
            <div
                class="dialog-form__row dialog-form__row--header"
                style="background-image: url('{{ $user->profileCustomization()->cover()->url() }}')"
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
                <h1 class="dialog-form__title">{{ trans('client_verifications.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--label">
                <p class="dialog-form__client-request">
                    {{ trans('client_verifications.create.confirm') }}
                </p>
            </div>

            <div class="dialog-form__row dialog-form__row--wrong-user">
                {!! trans('common.wrong_user._', [
                    'user' => e($user->username),
                    'logout_link' => link_to_route(
                        'logout',
                        trans('common.wrong_user.logout_link'),
                        [],
                        [
                            'class' => 'dialog-form__extra-link',
                            'data-confirm' => trans('users.logout_confirm'),
                            'data-method' => 'DELETE',
                            'data-reload-on-success' => '1',
                            'data-remote' => '1',
                        ]
                    ),
                ]) !!}
            </div>

            <div class="dialog-form__row dialog-form__row--buttons">
                {!! Form::open([
                    'url' => route('client-verifications.store'),
                    'method' => 'POST',
                ]) !!}
                    <input type="hidden" name="ch" value="{{ $hash }}" />

                    <button class="dialog-form__button">
                        {{ trans('common.buttons.authorise') }}
                    </button>
                {!! Form::close() !!}

                <a
                    href="{{ route('home') }}"
                    class="dialog-form__button dialog-form__button--cancel"
                >
                    {{ trans('common.buttons.cancel') }}
                </a>
            </div>
        </div>
    </div>
@endsection
