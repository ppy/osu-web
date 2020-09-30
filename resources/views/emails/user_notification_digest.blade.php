{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.user_notification_digest.new') !!}

@foreach ($groups as $group)
{!! $group['text'] !!}:
@foreach ($group['links'] as $link => $_ignored)
{!! $link !!}
@endforeach

@endforeach

{!! trans('mail.user_notification_digest.settings') !!}
{!! route('account.edit') !!}#notifications

@include('emails._signature')
