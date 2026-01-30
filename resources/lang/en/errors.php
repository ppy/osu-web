<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Failed to load data.',
    'missing_route' => 'Invalid url or incorrect request method.',
    'no_restricted_access' => 'You are not able to perform this action while your account is in a restricted state.',
    'param_too_large' => ':name parameter has a maximum of :count_delimited item|:name parameter has a maximum of :count_delimited items',
    'supporter_only' => 'You must be an osu!supporter to use this feature.',
    'unknown' => 'Unknown error occurred.',

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
    'checkout' => [
        'generic' => 'An error occurred while preparing your checkout.',
    ],
    'scores' => [
        'invalid_id' => 'Invalid score id.',
    ],
    'search' => [
        'default' => 'Could not get any results, try again later.',
        'invalid_cursor_exception' => 'Invalid cursor parameter specified.',
        'operation_timeout_exception' => 'Search is currently busier than usual, try again later.',
    ],
    'user_report' => [
        'recently_reported' => "You've already reported this recently.",
    ],
];
