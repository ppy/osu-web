<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'no-conversations' => 'no conversations yet',
    'talking_in' => 'talking in :channel',
    'talking_with' => 'talking with :name',
    'title_compact' => 'chat',
    'title' => 'Chat',

    'cannot_send' => [
        'user' => 'You cannot message this user at this time. This may be due to any of the following reasons:',
        'channel' => 'You cannot message this channel at this time. This may be due to any of the following reasons:',
        'reasons' => [
            'blocked' => 'You were blocked by the recipient',
            'friends_only' => 'The recipient only accepts messages from people on their friends list',
            'restricted' => 'You are currently restricted',
            'target_restricted' => 'The recipient is currently restricted',
            'channel_moderated' => 'The channel has been moderated'
        ],
    ],
    'input' => [
        'disabled' => 'unable to send message...',
        'placeholder' => 'type message...',
        'send' => 'Send',
    ],
];
