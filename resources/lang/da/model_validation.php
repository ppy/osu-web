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
    'not_negative' => ':attribute cannot be negative.',
    'required' => ':attribute is required.',
    'wrong_confirmation' => 'Confirmation does not match.',

    'beatmap_discussion' => [
        'hype' => [
            'guest' => 'Must be logged in to hype.',
            'hyped' => 'You have already hyped this beatmap.',
            'limit_exceeded' => 'You have used all your hype.',
            'not_hypeable' => 'This beatmap can not be hyped',
            'owner' => 'No hyping your own beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'first_post' => 'Can not delete starting post.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Can only vote a feature request.',
            'not_enough_feature_votes' => 'Not enough votes.',
        ],

        'poll_vote' => [
            'invalid' => 'Invalid option specified.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicated option is not allowed.',
            'invalid_max_options' => 'Option per user may not exceed the number of available options.',
            'minimum_one_selection' => 'A minimum of one option per user is required.',
            'minimum_two_options' => 'Need at least two options.',
            'too_many_options' => 'Exceeded maximum number of allowed options.',
        ],

        'topic_vote' => [
            'too_many' => 'Selected more options than allowed.',
        ],
    ],

    'user' => [
        'contains_username' => 'Password may not contain username.',
        'email_already_used' => 'Email address already used.',
        'invalid_country' => 'Country not in database.',
        'invalid_email' => "Doesn't seem to be an email address.",
        'too_short' => 'New password is too short.',
        'unknown_duplicate' => 'Username or email address already used.',
        'username_too_short' => 'The requested username is too short.',
        'weak' => 'Blacklisted password.',
        'wrong_current_password' => 'Current password is incorrect.',
        'wrong_email_confirmation' => 'Email confirmation does not match.',
        'wrong_password_confirmation' => 'Password confirmation does not match.',
        'too_long' => 'Exceeded maximum length - can only be up to :limit characters.',
    ],
];
