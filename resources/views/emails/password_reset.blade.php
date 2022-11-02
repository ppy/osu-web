{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! osu_trans('mail.common.hello', ['user' => $user->username]) !!}

{!! osu_trans('mail.password_reset.requested') !!}

{!! osu_trans('mail.password_reset.code') !!} {{ $key }}

{!! osu_trans('mail.common.ignore') !!}

@include('emails._signature')
