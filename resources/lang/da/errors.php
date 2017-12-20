<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'codes' => [
        'http-401' => 'Please login to proceed.',
        'http-403' => 'Access denied.',
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
    'beatmapsets' => [
        'too-many-favourites' => 'You have to many favourited beatmaps! Please unfavourite one before continuing.',
    ],
    'logged_out' => 'You have been logged out. Please login and retry.',
    'supporter_only' => 'You must be a supporter to use this feature.',
    'no_restricted_access' => 'You are not able to perform this action while your account is in a restricted state.',
    'unknown' => 'Unknown error occurred.',
];
