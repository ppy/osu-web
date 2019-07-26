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
Hey there {{ $giftee->username }},

Someone has just gifted you an osu!supporter tag!
Thanks to them, you have access to osu!direct and other osu!supporter benefits for the next {{ $duration }}.
You can find out more details on these features at {{ route('support-the-game') }}.
The person who gifted you this tag may choose to remain anonymous, so they have not been mentioned in this notification.
But you likely already know who it is ;).

Regards,
osu! Management
