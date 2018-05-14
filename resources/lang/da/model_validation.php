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
    'not_negative' => ':attribute kan ikke være negativ.',
    'required' => ':attribute er påkrævet.',
    'too_long' => ':attribute exceeded maximum length - can only be up to :limit characters.',
    'wrong_confirmation' => 'Bekræftelseskoderne matcher ikke.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discussion is locked.',
        'first_post' => 'Kan ikke slette det startende opslag.',
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
            'not_feature_topic' => 'Kan kun stemme på en funktionsanmodning.',
            'not_enough_feature_votes' => 'Ikke nok stemmer.',
        ],

        'poll_vote' => [
            'invalid' => 'Ugyldig valgmulighed er valgt.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deleting beatmap metadata post is not allowed.',
            'beatmapset_post_no_edit' => 'Editing beatmap metadata post is not allowed.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikeret valgmulighed er ikke tilladt.',
            'invalid_max_options' => 'Valgmuligheder pr. bruger må ikke overskride antallet af valgmuligheder i alt.',
            'minimum_one_selection' => 'Et minimum af en valgmulighed pr. bruger er nødvendig.',
            'minimum_two_options' => 'Der skal være mindst 2 valgmuligheder.',
            'too_many_options' => 'Overskrider det maksimale antal tilladte valgmuligheder.',
        ],

        'topic_vote' => [
            'required' => 'Select an option when voting.',
            'too_many' => 'Valgte flere valgmuliheder en tilladt.',
        ],
    ],

    'user' => [
        'contains_username' => 'Adgangskoden må ikke indholde et brugernavn.',
        'email_already_used' => 'Email-adressen er allerede i brug.',
        'invalid_country' => 'Landet er ikke i databasen.',
        'invalid_discord' => 'Discord username invalid.',
        'invalid_email' => "Dette ligner ikke en email-adresse...",
        'too_short' => 'Den nye adgangskode er for kort.',
        'unknown_duplicate' => 'Brugernavnet eller email-adressen er allerede i brug.',
        'username_available_in' => 'This username will be available for use in :duration.',
        'username_available_soon' => 'This username will be available for use any minute now!',
        'username_invalid_characters' => 'The requested username contains invalid characters.',
        'username_in_use' => 'Username is already in use!',
        'username_no_space_userscore_mix' => 'Please use either underscores or spaces, not both!',
        'username_no_spaces' => "Username can't start or end with spaces!",
        'username_not_allowed' => 'This username choice is not allowed.',
        'username_too_short' => 'Det anmodede brugernavn er for kort.',
        'username_too_long' => 'The requested username is too long.',
        'weak' => 'Blacklistet adgangskode.',
        'wrong_current_password' => 'Den nuværende adgangskode er ugyldig.',
        'wrong_email_confirmation' => 'Emailbekræftelsen er forkert.',
        'wrong_password_confirmation' => 'Adgangskodebekræftelsen er forkert.',
        'too_long' => 'Overskrider maksimale længde - kan højest være op til :limit karakterer.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'You must have :link to change your name!',
                'link_text' => 'supported osu!',
            ],
            'username_is_same' => 'This is already your username, silly!',
        ],
    ],
];
