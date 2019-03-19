<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'beatmap_missing' => 'Tidsstempel er angivet, men beatmap mangler.',
        'beatmapset_no_hype' => "Beatmappet kan ikke hypes.",
        'hype_requires_null_beatmap' => 'Hype skal gøres i afsnittet General (alle sværhedsgrader).',
        'invalid_beatmap_id' => 'Ugyldig sværhedsgrad angivet.',
        'invalid_beatmapset_id' => 'Ugyldig beatmap angivet.',
        'locked' => 'Diskussionen er låst.',

        'hype' => [
            'guest' => 'Du skal være logget ind for at kunne hype.',
            'hyped' => 'Du har allerede hypet dette beatmap.',
            'limit_exceeded' => 'Du har brugt alt dit hype.',
            'not_hypeable' => 'Dette beatmap kan ikke blive hyped',
            'owner' => 'Du kan ikke hype din egen beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Det angivede tidsstempel er længere end længden af beatmappet.',
            'negative' => "Tidsstempel kan ikke være negativt.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Besvarelse af slettede kommentar er ikke tilladt.',
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
            'beatmapset_post_no_delete' => 'Sletning af beatmap metadata indlæg er ikke tilladt.',
            'beatmapset_post_no_edit' => 'Redigering af beatmap metadata indlæg er ikke tilladt.',
            'only_quote' => '',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikeret valgmulighed er ikke tilladt.',
            'grace_period_expired' => 'Kan ikke redigere en afstemning efter mere end :limit timer',
            'invalid_max_options' => 'Valgmuligheder pr. bruger må ikke overskride antallet af valgmuligheder i alt.',
            'minimum_one_selection' => 'Et minimum af en valgmulighed pr. bruger er nødvendig.',
            'minimum_two_options' => 'Der skal være mindst 2 valgmuligheder.',
            'too_many_options' => 'Overskrider det maksimale antal tilladte valgmuligheder.',
        ],

        'topic_vote' => [
            'required' => 'Vælg en indstilling under afstemningen.',
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
        'username_available_in' => 'Dette Brugernavn vil være til rådighed til brug i :duration.',
        'username_available_soon' => 'Dette Brugernavn vil være tilgængelig hvert øjeblik nu!',
        'username_invalid_characters' => 'Det anmodede brugernavn indeholder ugyldige tegn.',
        'username_in_use' => 'Navnet er allerede i brug!',
        'username_locked' => 'Brugernavn er allerede i brug!', // TODO: language for this should be slightly different.
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
            'username_is_same' => 'Det her er allerede dit Brugernavn, fjollehoved!',
        ],
    ],

    'user_report' => [
        'self' => "Du kan ikke rapportere dig selv!",
    ],
];
