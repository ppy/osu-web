{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! osu_trans('mail.common.hello', ['user' => $user->username]) !!}

{!! osu_trans('mail.user_verification.action_from._', [
    'country' => $requestCountry ?? osu_trans('mail.user_verification.action_from.unknown_country'),
]) !!}

{!! osu_trans('mail.user_verification.code') !!} {{ $keys['main'] }}
{!! osu_trans('mail.user_verification.code_hint') !!}

{!! osu_trans('mail.user_verification.link') !!}

{{ route('account.verify', ['key' => $keys['link']]) }}

{!! osu_trans('mail.user_verification.report') !!}

@include('emails._signature')
