<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'too_long' => '',
    'wrong_confirmation' => 'Bekræftelseskoderne matcher ikke.',

    'beatmap_discussion_post' => [
        'discussion_locked' => '',
        'first_post' => 'Kan ikke slette det startende opslag.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "",
        'hype_requires_null_beatmap' => '',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => '',
        'mapper_note_wrong_user' => '',

        'hype' => [
            'guest' => '',
            'hyped' => '',
            'limit_exceeded' => '',
            'not_hypeable' => '',
            'owner' => '',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '',
            'negative' => "",
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
            'beatmapset_post_no_delete' => '',
            'beatmapset_post_no_edit' => '',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikeret valgmulighed er ikke tilladt.',
            'invalid_max_options' => 'Valgmuligheder pr. bruger må ikke overskride antallet af valgmuligheder i alt.',
            'minimum_one_selection' => 'Et minimum af en valgmulighed pr. bruger er nødvendig.',
            'minimum_two_options' => 'Der skal være mindst 2 valgmuligheder.',
            'too_many_options' => 'Overskrider det maksimale antal tilladte valgmuligheder.',
        ],

        'topic_vote' => [
            'required' => '',
            'too_many' => 'Valgte flere valgmuliheder en tilladt.',
        ],
    ],

    'user' => [
        'contains_username' => 'Adgangskoden må ikke indholde et brugernavn.',
        'email_already_used' => 'Email-adressen er allerede i brug.',
        'invalid_country' => 'Landet er ikke i databasen.',
        'invalid_discord' => '',
        'invalid_email' => "Dette ligner ikke en email-adresse...",
        'too_short' => 'Den nye adgangskode er for kort.',
        'unknown_duplicate' => 'Brugernavnet eller email-adressen er allerede i brug.',
        'username_available_in' => '',
        'username_available_soon' => '',
        'username_invalid_characters' => '',
        'username_in_use' => '',
        'username_no_space_userscore_mix' => '',
        'username_no_spaces' => "",
        'username_not_allowed' => '',
        'username_too_short' => 'Det anmodede brugernavn er for kort.',
        'username_too_long' => '',
        'weak' => 'Blacklistet adgangskode.',
        'wrong_current_password' => 'Den nuværende adgangskode er ugyldig.',
        'wrong_email_confirmation' => 'Emailbekræftelsen er forkert.',
        'wrong_password_confirmation' => 'Adgangskodebekræftelsen er forkert.',
        'too_long' => 'Overskrider maksimale længde - kan højest være op til :limit karakterer.',

        'change_username' => [
            'supporter_required' => [
                '_' => '',
                'link_text' => '',
            ],
            'username_is_same' => '',
        ],
    ],
];
