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
    'required' => ':attribute è richiesto.',
    'too_long' => ':attribute exceeded maximum length - can only be up to :limit characters.',
    'wrong_confirmation' => 'Confirmation does not match.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discussion is locked.',
        'first_post' => 'Can not delete starting post.',
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
            'not_feature_topic' => 'Puoi votare solamente una richiesta di feature.',
            'not_enough_feature_votes' => 'Non hai abbastanza voti.',
        ],

        'poll_vote' => [
            'invalid' => 'Specificata un\'Opzione Invalida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Deleting beatmap metadata post is not allowed.',
            'beatmapset_post_no_edit' => 'Editing beatmap metadata post is not allowed.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Non è permesso avere un\'opzione duplicata.',
            'invalid_max_options' => 'Le opzioni per utente non possono superare il numero di opzioni disponibili.',
            'minimum_one_selection' => 'È richiesto un minimo di un\'opzione per utente.',
            'minimum_two_options' => 'È necessario almeno due opzioni.',
            'too_many_options' => 'Raggiunto il massimo numero di opzioni permesse.',
        ],

        'topic_vote' => [
            'required' => 'Select an option when voting.',
            'too_many' => 'Sono state selezionate più opzioni del consentito.',
        ],
    ],

    'user' => [
        'contains_username' => 'Password may not contain username.',
        'email_already_used' => 'Email address already used.',
        'invalid_country' => 'Country not in database.',
        'invalid_discord' => 'Discord username invalid.',
        'invalid_email' => "Doesn't seem to be a valid email address.",
        'too_short' => 'New password is too short.',
        'unknown_duplicate' => 'Username or email address already used.',
        'username_available_in' => 'This username will be available for use in :duration.',
        'username_available_soon' => 'This username will be available for use any minute now!',
        'username_invalid_characters' => 'The requested username contains invalid characters.',
        'username_in_use' => 'Username is already in use!',
        'username_no_space_userscore_mix' => 'Please use either underscores or spaces, not both!',
        'username_no_spaces' => "Username can't start or end with spaces!",
        'username_not_allowed' => 'This username choice is not allowed.',
        'username_too_short' => 'The requested username is too short.',
        'username_too_long' => 'The requested username is too long.',
        'weak' => 'Blacklisted password.',
        'wrong_current_password' => 'Current password is incorrect.',
        'wrong_email_confirmation' => 'Email confirmation does not match.',
        'wrong_password_confirmation' => 'Password confirmation does not match.',
        'too_long' => 'Exceeded maximum length - can only be up to :limit characters.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'You must have :link to change your name!',
                'link_text' => 'supported osu!',
            ],
            'username_is_same' => 'This is already your username, silly!',
        ],
    ],
];
