{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
                <h1 class="dialog-form__title">{{ osu_trans('client_verifications.create.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--label">
                <p class="dialog-form__client-request">
                    {{ osu_trans('client_verifications.create.confirm') }}
                </p>
            </div>

            <div class="dialog-form__row dialog-form__row--wrong-user">
                {!! osu_trans('common.wrong_user._', [
                    'user' => e($user->username),
                    'logout_link' => link_to_route(
                        'logout',
                        osu_trans('common.wrong_user.logout_link'),
                        [],
                        [
                            'class' => 'dialog-form__extra-link',
                            'data-confirm' => osu_trans('users.logout_confirm'),
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
                    'data-remote' => 'true',
                ]) !!}
                    <input type="hidden" name="ch" value="{{ $hash }}" />

                    <button class="dialog-form__button" data-disable-with="{{ osu_trans('common.buttons.authorising') }}">
                        {{ osu_trans('common.buttons.authorise') }}
                    </button>
                {!! Form::close() !!}

                <a
                    href="{{ route('home') }}"
                    class="dialog-form__button dialog-form__button--cancel"
                >
                    {{ osu_trans('common.buttons.cancel') }}
                </a>
            </div>
        </div>
    </div>
@endsection
