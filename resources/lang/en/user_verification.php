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
