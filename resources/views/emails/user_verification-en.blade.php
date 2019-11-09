{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Hi {{ $user->username }},

An action performed on your account from {{ $requestCountry ?? 'unknown country' }} requires verification.

Your verification code is: {{ $keys['main'] }}
You can enter the code with or without spaces.

Alternatively, you can also visit this link below to finish verification:

{{ route('account.verify', ['key' => $keys['link']]) }}

If you did not request this, please REPLY IMMEDIATELY as your account may be in danger.

@include('emails._signature')
