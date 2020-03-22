{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.user_email_updated.changed_to', ['email' => $user->user_email]) !!}
{!! trans('mail.user_email_updated.sent') !!}
{!! trans('mail.user_email_updated.check') !!}

{!! trans('mail.common.report') !!}

@include('emails._signature')
