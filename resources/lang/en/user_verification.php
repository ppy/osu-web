<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'An email has been sent to :mail with a verification code. Enter the code.',
        'title' => 'Account Verification',
        'verifying' => 'Verifying...',
        'issuing' => 'Issuing new code...',

        'info' => [
            'check_spam' => "Make sure to check your spam folder if you can't find the email.",
            'recover' => "If you can't access your email or have forgotten what you used, please follow the :link.",
            'recover_link' => 'email recovery process here',
            'reissue' => 'You can also :reissue_link or :logout_link.',
            'reissue_link' => 'request another code',
            'logout_link' => 'sign out',
        ],
    ],

    'errors' => [
        'expired' => 'Verification code expired, new verification email sent.',
        'incorrect_key' => 'Incorrect verification code.',
        'retries_exceeded' => 'Incorrect verification code. Retry limit exceeded, new verification email sent.',
        'reissued' => 'Verification code reissued, new verification email sent.',
        'unknown' => 'Unknown problem occurred, new verification email sent.',
    ],
];
