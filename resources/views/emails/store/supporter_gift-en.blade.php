{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Hey there {{ $giftee->username }},

Someone has just gifted you an osu!supporter tag!
Thanks to them, you have access to osu!direct and other osu!supporter benefits for the next {{ $duration }}.
You can find out more details on these features at {{ route('support-the-game') }}.
The person who gifted you this tag may choose to remain anonymous, so they have not been mentioned in this notification.
But you likely already know who it is ;).

Regards,
osu! Management
