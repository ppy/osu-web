{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $giftee->username]) !!}

{!! trans('mail.supporter_gift.gifted') !!}
{!! trans('mail.supporter_gift.duration', ['duration' => \App\Models\SupporterTag::getDurationText($duration)]) !!}
{!! trans('mail.supporter_gift.features') !!}
{!! route('support-the-game') !!}
{!! trans('mail.supporter_gift.anonymous_gift') !!}
{!! trans('mail.supporter_gift.anonymous_gift_maybe_not') !!}

{!! trans('mail.common.closing') !!}
osu! Management
