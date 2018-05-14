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
    'too_long' => ':attribute exceeded maximum length - can only be up to :limit characters.',
    'wrong_confirmation' => 'Bekräftelse matchar inte.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discussion is locked.',
        'first_post' => 'Kan inte radera ursprungs inlägg.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Timestamp is specified but beatmap is missing.',
        'beatmapset_no_hype' => "Beatmap can't be hyped.",
        'hype_requires_null_beatmap' => 'Hype must be done in the General (all difficulties) section.',
        'invalid_beatmap_id' => 'Invalid difficulty specified.',
        'invalid_beatmapset_id' => 'Invalid beatmap specified.',
        'locked' => 'Discussion is locked.',
        'mapper_note_wrong_user' => 'Only beatmap owner can post mapper notes.',

        'hype' => [
            'guest' => 'Must be signed in to hype.',
            'hyped' => 'You have already hyped this beatmap.',
            'limit_exceeded' => 'You have used all your hype.',
            'not_hypeable' => 'This beatmap can not be hyped',
            'owner' => 'No hyping your own beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Specified timestamp is beyond the length of the beatmap.',
            'negative' => "Timestamp can't be negative.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan endast rösta på funktion begäran.',
            'not_enough_feature_votes' => 'Inte tillräckligt med röster.',
        ],

        'poll_vote' => [
            'invalid' => 'Ogiltligt val specificerat.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deleting beatmap metadata post is not allowed.',
            'beatmapset_post_no_edit' => 'Editing beatmap metadata post is not allowed.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicerad val är ej tillåtet.',
            'invalid_max_options' => 'Val per användare för inte överskrida antalet tillgängliga val.',
            'minimum_one_selection' => 'Minst ett val per användare behövs.',
            'minimum_two_options' => 'Behövs minst två val.',
            'too_many_options' => 'Överskred max antal tillåtna val.',
        ],

        'topic_vote' => [
            'required' => 'Select an option when voting.',
            'too_many' => 'Valde mer val än tillåtet.',
        ],
    ],

    'user' => [
        'contains_username' => 'Lösenord får inte innehålla användarnamn.',
        'email_already_used' => 'Email adress används redan.',
        'invalid_country' => 'Land är inte i databasen.',
        'invalid_discord' => 'Discord username invalid.',
        'invalid_email' => "Verkar inte som att det är en email adress.",
        'too_short' => 'Nytt lösenord är för kort.',
        'unknown_duplicate' => 'Användarnamn eller email adress används redan.',
        'username_available_in' => 'This username will be available for use in :duration.',
        'username_available_soon' => 'This username will be available for use any minute now!',
        'username_invalid_characters' => 'The requested username contains invalid characters.',
        'username_in_use' => 'Username is already in use!',
        'username_no_space_userscore_mix' => 'Please use either underscores or spaces, not both!',
        'username_no_spaces' => "Username can't start or end with spaces!",
        'username_not_allowed' => 'This username choice is not allowed.',
        'username_too_short' => 'Begärt användarnamn är för kort.',
        'username_too_long' => 'The requested username is too long.',
        'weak' => 'Svartlistad lösenord.',
        'wrong_current_password' => 'Nuvarande lösenord är inkorrekt.',
        'wrong_email_confirmation' => 'Email bekräftelse matchar inte.',
        'wrong_password_confirmation' => 'Lösenord bekräftelse matchar inte.',
        'too_long' => 'Överskred max längd - kan endast vara upp till :limit karaktärer.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'You must have :link to change your name!',
                'link_text' => 'supported osu!',
            ],
            'username_is_same' => 'This is already your username, silly!',
        ],
    ],
];
