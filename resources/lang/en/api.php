<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Cannot send blank message.',
            'limit_exceeded' => 'You are sending messages too quickly, please wait a bit before trying again.',
            'too_long' => 'The message you are trying to send is too long.',
        ],
    ],

    'scopes' => [
        'bot' => 'Act as a chat bot.',
        'identify' => 'Identify you and read your public profile.',

        'chat' => [
            'read' => 'Read messages on your behalf.',
            'write' => 'Send messages on your behalf.',
            'write_manage' => 'Join and leave channels on your behalf.',
        ],

        'forum' => [
            'write' => 'Create and edit forum topics and posts on your behalf.',
            'write_manage' => 'Manage forum topics and posts on your behalf.',
        ],

        'friends' => [
            'read' => 'See who you are following.',
        ],

        'beatmap_discussion' => [
            'write' => 'Create and edit beatmap discussion posts on your behalf',
        ],

        'public' => 'Read public data on your behalf.',
    ],
];
