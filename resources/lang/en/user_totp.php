<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'create' => [
        'finish' => 'Finish',
        'key' => 'Scan the QR code with the authenticator app and enter the verification key',
        'password' => 'To setup app based two-factor authentication, please enter your current password',
        'start' => 'Continue',
    ],

    'destroy' => [
        'missing' => 'You don\'t have authenticator app verification setup.',
        'ok' => 'Authenticator app verification removed.',
    ],

    'edit' => [
        'password' => 'Please enter your current password to remove verification using authenticator app.',
        'start' => 'Remove',
    ],

    'store' => [
        'ok' => 'Authenticator based verification has been setup',
        'restart' => 'Error occurred. Please restart the process.',
    ],
];
