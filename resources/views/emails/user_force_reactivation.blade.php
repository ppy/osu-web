{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.user_force_reactivation.main') !!}

{!! trans('mail.user_force_reactivation.reason') !!} {!! trans("users.force_reactivation.reason.{$reason}") !!}

{!! trans('mail.user_force_reactivation.perform_reset', ['url' => route('password-reset')]) !!}

@include('emails._signature')
