{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $user = Auth::user();
@endphp

@extends('master', [
    'blank' => true,
    'titleOverride' => 'One Time Key',
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
                    @if ($key === null)
                        Generate login key for the event
                    @else
                        Here's your one time key!
                    @endif
                </h1>
            </div>

            <div class="dialog-form__row dialog-form__row--centered">
                @if ($key === null)
                    <form
                        action="{{ route('one-time-key') }}"
                        method="POST"
                    >
                        @csrf
                        <button class="dialog-form__button">
                            Generate Key
                        </button>
                    </form>
                @else
                    <h2 class="dialog-form__client-name">
                        <code>{{ $key }}</code>
                    </h2>
                    <p><small>
                        The key is valid for {{ App\Libraries\OneTimeKey::VALID_SECONDS / 60 }} minutes.
                    </small></p>
                @endif
            </div>
        </div>
    </div>
@endsection
