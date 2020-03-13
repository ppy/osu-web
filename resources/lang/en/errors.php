<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'codes' => [
        'http-401' => 'Please sign in to proceed.',
        'http-403' => 'Access denied.',
        'http-404' => 'Not found.',
        'http-429' => 'Too many attempts. Try again later.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'An error occured. Try refreshing the page.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Invalid mode specified.',
        'standard_converts_only' => 'No scores are available for the requested mode on this beatmap difficulty.',
    ],
    'checkout' => [
        'generic' => 'An error occurred while preparing your checkout.',
    ],
    'search' => [
        'default' => 'Could not get any results, try again later.',
        'operation_timeout_exception' => 'Search is currently busier than usual, try again later.',
    ],

    'logged_out' => 'You have been signed out. Please sign in and retry.',
    'supporter_only' => 'You must be an osu!supporter to use this feature.',
    'no_restricted_access' => 'You are not able to perform this action while your account is in a restricted state.',
    'unknown' => 'Unknown error occurred.',
];
