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
    'too_long' => ':attribute overskrider maksimale længde - kan højest være op til :limit karakterer.',
    'wrong_confirmation' => 'Bekræftelseskoderne matcher ikke.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskussionen er låst.',
        'first_post' => 'Kan ikke slette det startende opslag.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "Beatmappet kan ikke hypes.",
        'hype_requires_null_beatmap' => '',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => 'Diskussionen er låst.',

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
        'invalid_discord' => 'Discord brugernavn ugyldigt.',
        'invalid_email' => "Dette ligner ikke en email-adresse...",
        'too_short' => 'Den nye adgangskode er for kort.',
        'unknown_duplicate' => 'Brugernavnet eller email-adressen er allerede i brug.',
        'username_available_in' => '',
        'username_available_soon' => '',
        'username_invalid_characters' => 'Det anmodede brugernavn indeholder ugyldige tegn.',
        'username_in_use' => 'Navnet er allerede i brug!',
        'username_no_space_userscore_mix' => 'Brug enten understreg eller mellemrum, ikke begge dele!',
        'username_no_spaces' => "Brugernavn kan ikke starte eller ende med mellemrum!",
        'username_not_allowed' => 'Dette brugernavn er ikke tilladt.',
        'username_too_short' => 'Det anmodede brugernavn er for kort.',
        'username_too_long' => 'Det anmodede brugernavn er for langt.',
        'weak' => 'Blacklistet adgangskode.',
        'wrong_current_password' => 'Den nuværende adgangskode er ugyldig.',
        'wrong_email_confirmation' => 'Emailbekræftelsen er forkert.',
        'wrong_password_confirmation' => 'Adgangskodebekræftelsen er forkert.',
        'too_long' => 'Overskrider maksimale længde - kan højest være op til :limit karakterer.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Du skal have :link for at ændre dit navn!',
                'link_text' => 'støttede osu!',
            ],
            'username_is_same' => '',
        ],
    ],
];
