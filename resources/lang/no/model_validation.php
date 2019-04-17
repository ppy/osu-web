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
    'required' => ':attribute kreves.',
    'too_long' => ':attribute overskrider maksimumslengden - kan bare være opp til :limit tegn.',
    'wrong_confirmation' => 'Bekreftelse stemmer ikke.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskusjonen er låst.',
        'first_post' => 'Kan ikke slette det første innlegget.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tidsstempel er angitt, men beatmappet mangler.',
        'beatmapset_no_hype' => "Beatmap kan ikke bli hypet.",
        'hype_requires_null_beatmap' => 'Hype må gjøres i den Generelle (alle vanskelighetsgrader) seksjonen.',
        'invalid_beatmap_id' => 'Ugyldig vanskelighetsgrad angitt.',
        'invalid_beatmapset_id' => 'Ugyldig beatmap angitt.',
        'locked' => 'Diskusjonen er låst.',

        'hype' => [
            'guest' => 'Må være logget inn for å hype.',
            'hyped' => 'Du har allerede hypet dette beatmappet.',
            'limit_exceeded' => 'Du har brukt opp all hypen din.',
            'not_hypeable' => 'Dette beatmappet kan ikke bli hypet',
            'owner' => 'Ingen hyping av ditt eget beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Angitte tidsstempler er utenfor lengden til beatmappen.',
            'negative' => "Tidsstempler kan ikke være negative.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Å svare til slettede kommentarer er ikke tillatt.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan bare stemme på funksjonsforespørsler.',
            'not_enough_feature_votes' => 'Ikke nok stemmer.',
        ],

        'poll_vote' => [
            'invalid' => 'Ugyldig valg angitt.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Sletting av beatmap metadata innlegg er ikke tillatt.',
            'beatmapset_post_no_edit' => 'Redigering av beatmap metadata innlegg er ikke tillatt.',
            'only_quote' => 'Svaret ditt inneholder kun et sitat.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplisering av et valg er ikke tillatt.',
            'grace_period_expired' => 'Kan ikke redigere avstemming etter :limit antall timer',
            'invalid_max_options' => 'Alternativer valgt av hver bruker kan ikke overskride antall tilgjengelige valg.',
            'minimum_one_selection' => 'Minimum et valg pr. bruker kreves.',
            'minimum_two_options' => 'Trenger minst to valgalternativer.',
            'too_many_options' => 'Overskredet maksimalt antall tillatte alternativer.',
        ],

        'topic_vote' => [
            'required' => 'Velg et alternativ å stemme på.',
            'too_many' => 'Valgt flere alternativer enn tillatt.',
        ],
    ],

    'user' => [
        'contains_username' => 'Passord kan ikke inneholde brukernavnet ditt.',
        'email_already_used' => 'E-postadressen er allerede i bruk.',
        'invalid_country' => 'Land er ikke i databasen.',
        'invalid_discord' => 'Discord brukernavn er ugyldig.',
        'invalid_email' => "Dette synes ikke til å være en gyldig e-postadresse.",
        'too_short' => 'Nytt passord er for kort.',
        'unknown_duplicate' => 'Brukernavn eller e-postadresse er allerede i bruk.',
        'username_available_in' => 'Dette brukernavnet vil bli tilgjengelig for bruk om :duration.',
        'username_available_soon' => 'Dette brukernavnet vil bli tilgjengelig for bruk når som helst nå!',
        'username_invalid_characters' => 'Det forespurte brukernavnet inneholder ugyldige tegn.',
        'username_in_use' => 'Brukernavn er allerede i bruk!',
        'username_locked' => 'Brukernavnet er ikke tilgjengelig!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Vennligst bruk enten understrekingstegn eller mellom, ikke begge!',
        'username_no_spaces' => "Brukernavnet kan ikke starte eller slutte med mellomrom!",
        'username_not_allowed' => 'Valg av dette brukernavnet er ikke tillatt.',
        'username_too_short' => 'Forespurt brukernavn er for kort.',
        'username_too_long' => 'Forespurte brukernavn er for langt.',
        'weak' => 'Svartelistet passord.',
        'wrong_current_password' => 'Nåværende passord er feil.',
        'wrong_email_confirmation' => 'Bekreftning av e-post samsvarer ikke.',
        'wrong_password_confirmation' => 'Passordene er ulike.',
        'too_long' => 'Overskrider maksimumslengden - kan bare være opp til :limit tegn.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Du må ha :link for å endre på navnet ditt!',
                'link_text' => 'støtter osu!',
            ],
            'username_is_same' => 'Dette er allerede brukernavnet ditt, dummen!',
        ],
    ],

    'user_report' => [
        'self' => "Du kan ikke rapportere deg selv!",
    ],
];
