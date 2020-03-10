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
    'talking_in' => 'talking in :channel',
    'talking_with' => 'talking with :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'You cannot message this channel at this time. This may be due to any of the following reasons:',
        'user' => 'You cannot message this user at this time. This may be due to any of the following reasons:',
        'reasons' => [
            'blocked' => 'You were blocked by the recipient',
            'channel_moderated' => 'The channel has been moderated',
            'friends_only' => 'The recipient only accepts messages from people on their friends list',
            'restricted' => 'You are currently restricted',
            'target_restricted' => 'The recipient is currently restricted',
        ],
    ],
    'input' => [
        'disabled' => 'unable to send message...',
        'placeholder' => 'type message...',
        'send' => 'Send',
    ],
    'no-conversations' => [
        'howto' => "Start conversations from a user's profile or a usercard popup.",
        'lazer' => 'Public channels you join via <a href=":link">osu!lazer</a> will also be visible here.',
        'title' => 'no conversations yet',
    ],
];
