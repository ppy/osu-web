<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => '',
        'title' => '',
        'verifying' => '',
        'issuing' => '',

        'info' => [
            'check_spam' => "",
            'recover' => "",
            'recover_link' => '',
            'reissue' => '',
            'reissue_link' => '',
            'logout_link' => 'шығу',
        ],
    ],

    'box_totp' => [
        'heading' => '',

        'info' => [
            'logout' => [
                '_' => '',
                'link' => '',
            ],
            'mail_fallback' => [
                '_' => '',
                'link' => '',
            ],
        ],
    ],

    'errors' => [
        'expired' => '',
        'incorrect_key' => '',
        'retries_exceeded' => '',
        'reissued' => '',
        'totp_used_key' => '',
        'totp_gone' => '',
        'unknown' => '',
    ],
];
