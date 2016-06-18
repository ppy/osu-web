<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'codes' => [
        'http-403' => 'Access denied.',
        'http-401' => 'Please login to proceed.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'An error occured. Try refreshing the page.',
        ],
    ],
    'community' => [
        'slack' => [
            'not-eligible' => 'Your account is not eligible for the Slack invite.',
            'slack-error' => 'An error has occured on the Slack servers. Please try again in a few minutes.',
        ],
    ],
    'logged_out' => 'You have been logged out. Please login and retry.',
    'supporter_only' => 'You must be a supporter to use this feature.',
    'no_restricted_access' => 'You are not able to perform this action while your account is in a restricted state.',
    'unknown' => 'Unknown error occurred.',
];
