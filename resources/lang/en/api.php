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
        'identify' => 'Identify you and read your public profile.',

        'beatmaps' => [
            'read' => 'View beatmaps and your activity on them on your behalf.'
        ],

        'friends' => [
            'read' => 'See who you are following.',
        ],

        'users' => [
            'read' => 'Read the public profile of any user on your behalf.',
        ],
    ],
];
