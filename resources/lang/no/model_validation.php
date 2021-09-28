<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Ugyldig :attribute angitt.',
    'not_negative' => ':attribute kan ikke være negativ.',
    'required' => ':attribute kreves.',
    'too_long' => ':attribute overskrider maksimumslengden - kan bare være opp til :limit tegn.',
    'wrong_confirmation' => 'Bekreftelsen stemmer ikke.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tidsstempel er angitt, men beatmappet mangler.',
        'beatmapset_no_hype' => "Beatmap kan ikke bli hypet.",
        'hype_requires_null_beatmap' => 'Hype må gjøres i den Generelle (alle vanskelighetsgrader) seksjonen.',
        'invalid_beatmap_id' => 'Ugyldig vanskelighetsgrad angitt.',
        'invalid_beatmapset_id' => 'Ugyldig beatmap angitt.',
        'locked' => 'Diskusjonen er låst.',

        'attributes' => [
            'message_type' => 'Meldingstype',
            'timestamp' => 'Tidsstempel',
        ],

        'hype' => [
            'discussion_locked' => "Dette beatmappet er foreløpig låst for diskusjon og kan ikke hypes",
            'guest' => 'Må være logget inn for å hype.',
            'hyped' => 'Du har allerede hypet dette beatmappet.',
            'limit_exceeded' => 'Du har brukt opp all hypen din.',
            'not_hypeable' => 'Dette beatmappet kan ikke bli hypet',
            'owner' => 'Ingen hyping av ditt eget beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Angitte tidsstempler er utenfor lengden til beatmappet.',
            'negative' => "Tidsstempler kan ikke være negative.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskusjonen er låst.',
        'first_post' => 'Kan ikke slette det første innlegget.',

        'attributes' => [
            'message' => 'Meldingen',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Å svare til slettede kommentarer er ikke tillatt.',
        'top_only' => 'Innsetting av kommentar svar er ikke tillatt.',

        'attributes' => [
            'message' => 'Meldingen',
        ],
    ],

    'follow' => [
        'invalid' => 'Ugyldig :attribute angitt.',
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
            'beatmapset_post_no_delete' => 'Sletting av beatmap metadata innlegget er ikke tillatt.',
            'beatmapset_post_no_edit' => 'Redigering av beatmap metadata innlegget er ikke tillatt.',
            'first_post_no_delete' => '',
            'missing_topic' => '',
            'only_quote' => 'Svaret ditt inneholder kun et sitat.',

            'attributes' => [
                'post_text' => 'Publiser brødtekst
',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Emnetittel',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplisering av et valg er ikke tillatt.',
            'grace_period_expired' => 'Kan ikke redigere avstemming etter :limit antall timer',
            'hiding_results_forever' => 'Kan ikke gjemme resultater til en avstemning som aldri ender.',
            'invalid_max_options' => 'Alternativer valgt av hver bruker kan ikke overskride antall tilgjengelige valg.',
            'minimum_one_selection' => 'Minimum et valg pr. bruker kreves.',
            'minimum_two_options' => 'Trenger minst to valgalternativer.',
            'too_many_options' => 'Overskredet maksimal antall tillatte alternativer.',

            'attributes' => [
                'title' => 'Avstemmingstittel',
            ],
        ],

        'topic_vote' => [
            'required' => 'Velg et alternativ å stemme på.',
            'too_many' => 'Valgt flere alternativer enn tillatt.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Du har nådd grensen for maksimalt antall oAuth-applikasjoner.',
            'url' => 'Vennligst skriv en gyldig URL.',

            'attributes' => [
                'name' => 'Applikasjonsnavn',
                'redirect' => 'Applikasjonens omdirigeringslenke',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Passord kan ikke inneholde brukernavnet ditt.',
        'email_already_used' => 'E-postadressen er allerede i bruk.',
        'email_not_allowed' => '',
        'invalid_country' => 'Land er ikke i databasen.',
        'invalid_discord' => 'Discord brukernavnet er ugyldig.',
        'invalid_email' => "Dette ser ikke ut til å være en gyldig e-postadresse.",
        'invalid_twitter' => 'Twitter brukernavnet er ugyldig.',
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
        'wrong_email_confirmation' => 'E-postene samsvarer ikke.',
        'wrong_password_confirmation' => 'Passordene samsvarer ikke.',
        'too_long' => 'Overskrider maksimumslengden - kan bare være opp til :limit tegn.',

        'attributes' => [
            'username' => 'Brukernavn',
            'user_email' => 'E-postadresse',
            'password' => 'Passord',
        ],

        'change_username' => [
            'restricted' => 'Du kan ikke endre brukernavnet ditt mens du er begrenset.',
            'supporter_required' => [
                '_' => 'Du må ha :link for å endre på navnet ditt!',
                'link_text' => 'støtter osu!',
            ],
            'username_is_same' => 'Dette er allerede brukernavnet ditt, dummen!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason er ikke gyldig for denne rapporttypen.',
        'self' => "Du kan ikke rapportere deg selv!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Antall',
                'cost' => 'Pris',
            ],
        ],
    ],
];
