{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.user_verification.action_from._', [
    'country' => $requestCountry ?? trans('mail.user_verification.action_from.unknown_country'),
]) !!}

{!! trans('mail.user_verification.code') !!} {{ $keys['main'] }}
{!! trans('mail.user_verification.code_hint') !!}

{!! trans('mail.user_verification.link') !!}

{{ route('account.verify', ['key' => $keys['link']]) }}

{!! trans('mail.user_verification.report') !!}

@include('emails._signature')
