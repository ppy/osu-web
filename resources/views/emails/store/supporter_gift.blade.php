{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! osu_trans('mail.common.hello', ['user' => $giftee->username]) !!}

{!! osu_trans('mail.supporter_gift.gifted') !!}
{!! osu_trans('mail.supporter_gift.duration', ['duration' => \App\Models\SupporterTag::getDurationText($duration)]) !!}
{!! osu_trans('mail.supporter_gift.features') !!}
{!! route('support-the-game') !!}
{!! osu_trans('mail.supporter_gift.anonymous_gift') !!}
{!! osu_trans('mail.supporter_gift.anonymous_gift_maybe_not') !!}

{!! osu_trans('mail.common.closing') !!}
osu! Management
