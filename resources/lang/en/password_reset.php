<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'button' => [
        'resend' => 'Resend verification email',
        'set' => 'Set password',
        'start' => 'Start',
    ],

    'error' => [
        'contact_support' => 'Please contact support to recover account.',
        'expired' => 'Verification code has expired.',
        'invalid' => 'Unexpected error in verification code.',
        'is_privileged' => 'Please contact a high level admin to recover account.',
        'missing_key' => 'Required.',
        'too_many_requests' => 'Password reset request limit has been reached. Please contact support to recover account.',
        'too_many_tries' => 'Too many failed attempts.',
        'user_not_found' => 'Requested user does not exist.',
        'wait_resend' => 'Please wait a few moments.',
        'wrong_key' => 'Incorrect code.',
    ],

    'notice' => [
        'sent' => 'Check your email for the verification code.',
        'saved' => 'New password saved!',
    ],

    'started' => [
        'password' => 'New password',
        'password_confirmation' => 'Password confirmation',
        'title' => 'Resetting password for account <strong>:username</strong>.',
        'verification_key' => 'Verification code',
    ],

    'starting' => [
        'username' => 'Enter email address or username',

        'reason' => [
            'inactive_different_country' => "Your account hasn't been used in a long time. To ensure your account security please reset your password.",
        ],
        'support' => [
            '_' => 'Need further assistance? Contact us via our :button.',
            'button' => 'support system',
        ],
    ],
];
