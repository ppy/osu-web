{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $messages ??= [];
@endphp
{!! osu_trans('mail.common.hello', ['user' => $giftee->username]) !!}

{!! osu_trans('mail.supporter_gift.gifted') !!}
{!! osu_trans('mail.supporter_gift.duration', ['duration' => \App\Models\SupporterTag::getDurationText($duration)]) !!}
{!! osu_trans('mail.supporter_gift.features') !!}
{!! route('support-the-game') !!}

@if (count($messages) === 0)
{!! osu_trans('mail.supporter_gift.anonymous_gift') !!}
{!! osu_trans('mail.supporter_gift.anonymous_gift_maybe_not') !!}
@else
{!! osu_trans('mail.supporter_gift.gift_message') !!}
@foreach ($messages as $message)
{{ $message }}
@endforeach
@endif

{!! osu_trans('mail.common.closing') !!}
osu! Management
