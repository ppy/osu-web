{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('layout._page_header_v4')
    <div class="osu-page osu-page--generic-compact">
        @if (isset($uri))
            @php
                $totp = OTPHP\Factory::loadFromProvisioningUri($uri);
            @endphp
            <form
                action="{{ route('authenticator-app.store') }}"
                class="password-reset js-form-error"
                method="POST"
                data-remote
                data-skip-ajax-error-popup="1"
            >
                <div class="password-reset__input-group">
                    <div class="qr-svg">
                        {!! qr_svg($uri) !!}
                    </div>
                    <p>
                        <a href="{{ $uri }}">{{ osu_trans('user_totp.create.key_link') }}</a>
                    </p>
                    <div>
                        <div
                            class="js-react--click-to-copy u-contents"
                            data-props="{{ json_encode([
                                'label' => osu_trans('user_totp.create.key_copy'),
                                'showIcon' => true,
                                'value' => $totp->getSecret(),
                                'valueAsUrl' => false,
                            ]) }}"
                        ></div>
                    </div>
                </div>
                <div class="password-reset__input-group">
                    {{ osu_trans('user_totp.create.key') }}
                </div>
                <label class="password-reset__input-group">
                    <input
                        autocomplete="one-time-code"
                        autofocus
                        class="password-reset__input"
                        inputmode="numeric"
                        name="key"
                    >
                    <span class="password-reset__error js-form-error--error"></span>
                </label>

                <div class="password-reset__input-group">
                    <button class="btn-osu-big btn-osu-big--password-reset">
                        {{ osu_trans('user_totp.create.finish') }}
                    </button>
                </div>
            </form>
        @else
            <form
                action="{{ route('authenticator-app.issue-uri') }}"
                class="password-reset js-form-error"
                method="POST"
                data-remote
                data-skip-ajax-error-popup="1"
                data-reload-on-success="1"
            >
                <label class="password-reset__input-group">
                    {{ osu_trans('user_totp.create.password') }}
                    <input autofocus class="password-reset__input" name="password" type="password">
                    <span class="password-reset__error js-form-error--error"></span>
                </label>

                <div class="password-reset__input-group">
                    <button class="btn-osu-big btn-osu-big--password-reset">
                        {{ osu_trans('user_totp.create.start') }}
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
