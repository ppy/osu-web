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
    'not_negative' => ':attribute kan inte vara negativt.',
    'required' => ':attribute behövs.',
    'wrong_confirmation' => 'Bekräftelse matchar inte.',

    'beatmap_discussion_post' => [
        'first_post' => 'Kan inte radera ursprungs inlägg.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan endast rösta på funktion begäran.',
            'not_enough_feature_votes' => 'Inte tillräckligt med röster.',
        ],

        'poll_vote' => [
            'invalid' => 'Ogiltligt val specificerat.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicerad val är ej tillåtet.',
            'invalid_max_options' => 'Val per användare för inte överskrida antalet tillgängliga val.',
            'minimum_one_selection' => 'Minst ett val per användare behövs.',
            'minimum_two_options' => 'Behövs minst två val.',
            'too_many_options' => 'Överskred max antal tillåtna val.',
        ],

        'topic_vote' => [
            'too_many' => 'Valde mer val än tillåtet.',
        ],
    ],

    'user' => [
        'contains_username' => 'Lösenord får inte innehålla användarnamn.',
        'email_already_used' => 'Email adress används redan.',
        'invalid_country' => 'Land är inte i databasen.',
        'invalid_email' => 'Verkar inte som att det är en email adress.',
        'too_short' => 'Nytt lösenord är för kort.',
        'unknown_duplicate' => 'Användarnamn eller email adress används redan.',
        'username_too_short' => 'Begärt användarnamn är för kort.',
        'weak' => 'Svartlistad lösenord.',
        'wrong_current_password' => 'Nuvarande lösenord är inkorrekt.',
        'wrong_email_confirmation' => 'Email bekräftelse matchar inte.',
        'wrong_password_confirmation' => 'Lösenord bekräftelse matchar inte.',
        'too_long' => 'Överskred max längd - kan endast vara upp till :limit karaktärer.',
    ],
];
