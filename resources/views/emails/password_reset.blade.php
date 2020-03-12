{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.password_reset.requested') !!}

{!! trans('mail.password_reset.code') !!} {{ $key }}

{!! trans('mail.common.report') !!}

@include('emails._signature')
