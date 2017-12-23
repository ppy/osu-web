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
    'wrong_confirmation' => 'Bekræftelseskoderne matcher ikke.',

    'beatmap_discussion' => [
        'hype' => [
            'guest' => 'Du skal være logget ind for at hype.',
            'hyped' => 'Du har allerede hypet dette beatmap.',
            'limit_exceeded' => 'Du har opbrugt alt dit hype.',
            'not_hypeable' => 'Dette beatmap kan ikke blive hypet',
            'owner' => 'Du kan ikke hype dit eget beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'first_post' => 'Kan ikke slette det startende opslag.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan kun stemme på en funktionsanmodning.',
            'not_enough_feature_votes' => 'Ikke nok stemmer.',
        ],

        'poll_vote' => [
            'invalid' => 'Ugyldig valgmulighed er valgt.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikeret valgmulighed er ikke tilladt.',
            'invalid_max_options' => 'Valgmuligheder pr. bruger må ikke overskride antallet af valgmuligheder i alt.',
            'minimum_one_selection' => 'Et minimum af én valgmulighed pr. bruger er nødvendig.',
            'minimum_two_options' => 'Der skal være mindst 2 valgmuligheder.',
            'too_many_options' => 'Overskrider det maksimale antal tilladte valgmuligheder.',
        ],

        'topic_vote' => [
            'too_many' => 'Valgte flere valgmuliheder en tilladt.',
        ],
    ],

    'user' => [
        'contains_username' => 'Adgangskoden må ikke indholde et brugernavn.',
        'email_already_used' => 'Email-adressen er allerede i brug.',
        'invalid_country' => 'Landet er ikke i databasen.',
        'invalid_email' => 'Dette ligner ikke en email-adresse...',
        'too_short' => 'Den nye adgangskode er for kort.',
        'unknown_duplicate' => 'Brugernavn eller email-adresse er allerede i brug.',
        'username_too_short' => 'Det anmodede brugernavn er for kort.',
        'weak' => 'Sortlistet adgangskode.',
        'wrong_current_password' => 'Den nuværende adgangskode er ugyldig.',
        'wrong_email_confirmation' => 'Emailbekræftelsen er forkert.',
        'wrong_password_confirmation' => 'Adgangskodebekræftelsen er forkert.',
        'too_long' => 'Overskrider maksimale længde - kan højest være op til :limit karakterer.',
    ],
];
