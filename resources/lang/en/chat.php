<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => 'talking in :channel',
    'talking_with' => 'talking with :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'You cannot message this channel at this time.',
        'user' => 'You cannot message this user at this time.',
        'reasons' => [
            'blocked' => 'You were blocked by the recipient',
            'channel_moderated' => 'The channel has been moderated',
            'friends_only' => 'The recipient only accepts messages from people on their friends list',
            'not_enough_plays' => 'You have not played the game enough',
            'not_verified' => 'Your session has not been verified',
            'restricted' => 'You are currently restricted',
            'silenced' => 'You are currently silenced',
            'target_restricted' => 'The recipient is currently restricted',
        ],
    ],
    'input' => [
        'disabled' => 'unable to send message...',
        'disconnected' => 'Disconnected',
        'placeholder' => 'type message...',
        'send' => 'Send',
    ],
    'no-conversations' => [
        'howto' => "Start conversations from a user's profile or a usercard popup.",
        'lazer' => 'Public channels you join via <a href=":link">osu!lazer</a> will also be visible here.',
        'title' => 'no conversations yet',
    ],
];
