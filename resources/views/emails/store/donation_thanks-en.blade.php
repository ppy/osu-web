{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Hi {{ $donor->username }},

Thanks a lot for your {{ $continued ? 'continued ': '' }}support towards osu!.
It is thanks to people like you that osu! is able to keep the game and community running smoothly without any advertisements or forced payments.
{{ $isGift ? 'Your giftee(s)' : 'You' }} will now have access to osu!direct and many other supporter benefits{{ !$isGift ? ' for '.$duration : '' }}.
More new supporter benefits will appear over time, as well!

Your support keeps osu! running for around {{ $minutes }} minutes! It may not seem like much, but it all adds up :).

If you have any questions or feedback, don't hesitate to reply to this mail; I'll get back to you as soon as possible!

Regards,
Dean Herbert (peppy)
