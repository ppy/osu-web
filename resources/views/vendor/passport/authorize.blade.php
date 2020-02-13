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
                <h1 class="dialog-form__title">{{ trans('oauth.authorise.title') }}</h1>
            </div>

            <div class="dialog-form__row dialog-form__row--label">
                <h2 class="dialog-form__client-name">
                    {{ $client->name }}
                </h2>
                <p class="dialog-form__client-request">
                    {{ trans('oauth.authorise.request') }}
                </p>
            </div>

            @if (count($scopes) > 0)
                <div class="dialog-form__row dialog-form__row--scopes">
                    <p class="dialog-form__scopes-title">
                        {{ trans('oauth.authorise.scopes_title') }}
                    </p>

                    <ul class="oauth-scopes oauth-scopes--oauth-form">
                        @foreach ($scopes as $scope)
                            <li>
                                <span class="oauth-scopes__icon">
                                    <span class="fas fa-check"></span>
                                </span>{{ $scope->description }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                    'url' => '/oauth/authorize',
                    'method' => 'POST',
                ]) !!}
                    <input type="hidden" name="state" value="{{ $request->state }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />

                    <button class="dialog-form__button">
                        {{ trans('common.buttons.authorise') }}
                    </button>
                {!! Form::close() !!}

                {!! Form::open([
                    'url' => '/oauth/authorize',
                    'method' => 'DELETE',
                ]) !!}
                    <input type="hidden" name="state" value="{{ $request->state }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />

                    <button
                        class="dialog-form__button dialog-form__button--cancel"
                    >
                        {{ trans('common.buttons.cancel') }}
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
