<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'mail' => [
        'donation_thanks' => [
            'subject' => 'Thanks, osu! <3s you',

            'content' => [
                'benefit_more' => 'More new supporter benefits will appear over time, as well!',
                'keep_free' => 'It is thanks to people like you that osu! is able to keep the game and community running smoothly without any advertisements or forced payments.',
                'keep_running' => 'Your support keeps osu! running for around :minutes! It may not seem like much, but it all adds up :).',
                'feedback' => "If you have any questions or feedback, don't hesitate to reply to this mail; I'll get back to you as soon as possible!",

                'benefit' => [
                    'gift' => 'Your giftee(s) will now have access to osu!direct and many other supporter benefits.',
                    'self' => 'You will now have access to osu!direct and many other supporter benefits for :duration.',
                ],

                'support' => [
                    '_' => 'Thanks a lot for your :support towards osu!.',
                    'repeat' => 'continued support',
                    'first' => 'support',
                ],
            ],
        ],
        'supporter_gift' => [
            'subject' => 'You have been gifted an osu!supporter tag!',

            'content' => [
                'anonymous_gift' => 'The person who gifted you this tag may choose to remain anonymous, so they have not been mentioned in this notification.',
                'anonymous_gift_maybe_not' => 'But you likely already know who it is ;).',
                'duration' => 'Thanks to them, you have access to osu!direct and other osu!supporter benefits for the next :duration.',
                'features' => 'You can find out more details on these features here:',
                'gifted' => 'Someone has just gifted you an osu!supporter tag!',
            ],
        ],
    ],
];
