{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

Hi {{ $donor->username }},

Thanks a lot for choosing to {{ $continued ? 'continue to ': '' }}support osu!.

{{ $isGift ? 'Your giftee(s)' : 'You' }} will now have access to osu!direct and many other supporter benefits{{ !$isGift ? ' for '.\App\Models\SupporterTag::getDurationText($duration, 'en') : '' }}. Your support keeps osu! running for around {{ $minutes }} minutes! It may not seem like much, but every minute adds up!

It's 2026 and the world is a weird place, changing faster than anyone can keep up with. Along the way everything feels less personal than ever.

After all these years, the reason I continue to pour my life into this project is the constant positive feedback I receive from players. I've seen osu! create real human connections, save people from dark times, or just exist as *that game* you can always come back to and be rest-assured there's a good few minutes or hours of gameplay away from the stress of the real world.

I strive to continue running osu! true to my own values. No ads; no jumping on any hype train; no outsourcing our development to AI. Just continuing to do what we do – at our own speed – to best serve the community.

We can only do this with your support.

On behalf of our small team, I'm incredibly grateful to have you on board as a member of the small group that keeps this game powered on.

This email itself is automatically sent, but if you have any questions or feedback, don't hesitate to send a reply. I read and (within limits) reply to anything you have to share.

Thanks ❤️
Dean Herbert (peppy)
@if (app()->getLocale() !== 'en'
    && trans_exists('mail.donation_thanks.keep_free', app()->getLocale())
    && trans_exists('mail.donation_thanks.support.first', app()->getLocale())
)

{!! osu_trans('mail.donation_thanks.translation') !!}

==============================

{!! osu_trans('mail.common.hello', ['user' => $donor->username]) !!}

{!! osu_trans('mail.donation_thanks.support._', [
    'support' => osu_trans('mail.donation_thanks.support.'.($continued ? 'repeat' : 'first')),
]) !!}
{!! osu_trans('mail.donation_thanks.keep_free') !!}
{!! osu_trans('mail.donation_thanks.benefit.'.($isGift ? 'gift' : 'self'), [
    'duration' => \App\Models\SupporterTag::getDurationText($duration),
]) !!}
{!! osu_trans('mail.donation_thanks.benefit_more') !!}

{!! osu_trans('mail.donation_thanks.keep_running', [
    'minutes' => osu_trans_choice('common.count.minutes', $minutes),
]) !!}

{!! osu_trans('mail.donation_thanks.feedback') !!}

{!! osu_trans('mail.common.closing') !!}
Dean Herbert (peppy)
@endif
