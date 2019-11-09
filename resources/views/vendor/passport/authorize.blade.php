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
    <div class="oauth-form">
        <div class="oauth-form__dialog">
            <div
                class="oauth-form__row oauth-form__row--header"
                style="background-image: url('{{ $user->profileCustomization()->cover()->url() }}')"
            >
                <div class="oauth-form__header-overlay"></div>
                <a
                    class="oauth-form__user-header"
                    href="{{ route('users.show', ['user' => $user->getKey()]) }}"
                >
                    <div class="oauth-form__user-avatar">
                        <div
                            class="avatar avatar--full-circle"
                            style="background-image: url('{{ $user->user_avatar }}')"
                        ></div>
                    </div>

                    {{ $user->username }}
                </a>
            </div>

            <div class="oauth-form__row oauth-form__row--title">
                <div class="oauth-form__logo"></div>
                <h1 class="oauth-form__title">{{ trans('oauth.authorise.title') }}</h1>
            </div>

            <div class="oauth-form__row oauth-form__row--label">
                <h2 class="oauth-form__client-name">
                    {{ $client->name }}
                </h2>
                <p class="oauth-form__client-request">
                    {{ trans('oauth.authorise.request') }}
                </p>
            </div>

            @if (count($scopes) > 0)
                <div class="oauth-form__row oauth-form__row--scopes">
                    <p class="oauth-form__scopes-title">
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

            <div class="oauth-form__row oauth-form__row--wrong-user">
                {!! trans('oauth.authorise.wrong_user._', [
                    'user' => e($user->username),
                    'logout_link' => link_to_route(
                        'logout',
                        trans('oauth.authorise.wrong_user.logout_link'),
                        [],
                        [
                            'class' => 'oauth-form__extra-link',
                            'data-confirm' => trans('users.logout_confirm'),
                            'data-method' => 'DELETE',
                            'data-reload-on-success' => '1',
                            'data-remote' => '1',
                        ]
                    ),
                ]) !!}
            </div>
            <div class="oauth-form__row oauth-form__row--buttons">
                {!! Form::open([
                    'url' => '/oauth/authorize',
                    'method' => 'POST',
                ]) !!}
                    <input type="hidden" name="state" value="{{ $request->state }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />

                    <button class="oauth-form__button">
                        {{ trans('oauth.authorise.authorise') }}
                    </button>
                {!! Form::close() !!}

                {!! Form::open([
                    'url' => '/oauth/authorize',
                    'method' => 'DELETE',
                ]) !!}
                    <input type="hidden" name="state" value="{{ $request->state }}" />
                    <input type="hidden" name="client_id" value="{{ $client->id }}" />

                    <button
                        class="oauth-form__button oauth-form__button--cancel"
                    >
                        {{ trans('common.buttons.cancel') }}
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
