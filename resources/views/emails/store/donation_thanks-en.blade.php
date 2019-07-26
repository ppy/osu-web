{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
