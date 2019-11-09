{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Hi {{ $user->username }},

Either you or someone pretending to be you has requested a password reset on your osu! account.

Your verification code is: {{ $key }}

Please reply to this email IMMEDIATELY if you did not request this change.

@include('emails._signature')
