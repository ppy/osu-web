<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Ugyldigt :attribute angivet.',
    'not_negative' => ':attribute kan ikke være negativ.',
    'required' => ':attribute er påkrævet.',
    'too_long' => ':attribute overskrider maksimal længde - kan højest være op til :limit karakterer.',
    'wrong_confirmation' => 'Bekræftelseskoden matchede ikke.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tidsstempel er angivet, men beatmap mangler.',
        'beatmapset_no_hype' => "Beatmappet kan ikke hypes.",
        'hype_requires_null_beatmap' => 'Hype skal gøres i afsnittet General (alle sværhedsgrader).',
        'invalid_beatmap_id' => 'Ugyldig sværhedsgrad angivet.',
        'invalid_beatmapset_id' => 'Ugyldig beatmap angivet.',
        'locked' => 'Diskussion er låst.',

        'attributes' => [
            'message_type' => 'Meddelelsestype',
            'timestamp' => 'Tidsstempel',
        ],

        'hype' => [
            'discussion_locked' => "Denne beatmap er i øjeblikket låst og kan ikke blive hyped",
            'guest' => 'Du skal være logget ind for at kunne hype.',
            'hyped' => 'Du har allerede hypet dette beatmap.',
            'limit_exceeded' => 'Du har brugt alt dit hype.',
            'not_hypeable' => 'Dette beatmap kan ikke blive hyped',
            'owner' => 'Du kan ikke hype din egen beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Det angivne tidsstempel er længere end længden af beatmappet.',
            'negative' => "Tidsstempel kan ikke være negativt.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskussion er låst.',
        'first_post' => 'Kan ikke slette det startende opslag.',

        'attributes' => [
            'message' => 'Beskeden',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Besvarelse af slettede kommentar er ikke tilladt.',
        'top_only' => 'At fastgøre kommentar svar er ikke tilladt. ',

        'attributes' => [
            'message' => 'Beskeden',
        ],
    ],

    'follow' => [
        'invalid' => 'Ugyldig :attribute angivet.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan kun stemme på et funktionalitets-foreslag.',
            'not_enough_feature_votes' => 'Ikke nok stemmer.',
        ],

        'poll_vote' => [
            'invalid' => 'Ugyldig valgmulighed valgt.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Sletning af beatmap metadata opslag er ikke tilladt.',
            'beatmapset_post_no_edit' => 'Redigering af beatmap metadata opslag er ikke tilladt.',
            'first_post_no_delete' => 'Kan ikke slette det startende opslag',
            'missing_topic' => 'Indlæg mangler emne',
            'only_quote' => 'Dit svar indeholder kun et quotationstegn.',

            'attributes' => [
                'post_text' => 'Hovedtekst',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Emnetitel',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikeret valgmulighed er ikke tilladt.',
            'grace_period_expired' => 'Kan ikke redigere en afstemning efter mere end :limit timer',
            'hiding_results_forever' => 'Kan ikke gemme resultaterne for en afstemning som aldrig slutter.',
            'invalid_max_options' => 'Valgmuligheder pr. bruger må ikke overskride antallet af valgmuligheder i alt.',
            'minimum_one_selection' => 'Et minimum af en valgmulighed pr. bruger er nødvendigt.',
            'minimum_two_options' => 'Der skal være mindst 2 valgmuligheder.',
            'too_many_options' => 'Overskrider det maksimale antal tilladte valgmuligheder.',

            'attributes' => [
                'title' => 'Afstemningstitel',
            ],
        ],

        'topic_vote' => [
            'required' => 'Vælg mindst en valgmulighed før du stemmer.',
            'too_many' => 'Valgte flere valgmuliheder end tilladt.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Overskrider det maksimale antal tilladte OAuth applikationer.',
            'url' => 'Indtast venligst en gyldig URL.',

            'attributes' => [
                'name' => 'Applikationsnavn',
                'redirect' => 'Applikation Callback URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Adgangskoden må ikke indholde et brugernavn.',
        'email_already_used' => 'Email-adressen er allerede i brug.',
        'email_not_allowed' => 'E-mail er ikke gyldig.',
        'invalid_country' => 'Landet er ikke i databasen.',
        'invalid_discord' => 'Ugyldigt Discord brugernavn.',
        'invalid_email' => "Dette ligner ikke en email-adresse...",
        'invalid_twitter' => 'Ugyldigt Twitter brugernavn.',
        'too_short' => 'Den nye adgangskode er for kort.',
        'unknown_duplicate' => 'Brugernavnet eller email-adressen er allerede i brug.',
        'username_available_in' => 'Dette brugernavn vil være til rådighed om :duration.',
        'username_available_soon' => 'Dette brugernavn burde være tilgængeligt hvert øjeblik lige nu!',
        'username_invalid_characters' => 'Det anmodede brugernavn indeholder ugyldige tegn.',
        'username_in_use' => 'Brugernavn er allerede i brug!',
        'username_locked' => 'Brugernavn er allerede i brug!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Brug enten understreg eller mellemrum, ikke begge dele!',
        'username_no_spaces' => "Brugernavn kan ikke starte eller ende med mellemrum!",
        'username_not_allowed' => 'Dette brugernavn er ikke tilladt.',
        'username_too_short' => 'Det anmodede brugernavn er for kort.',
        'username_too_long' => 'Det anmodede brugernavn er for langt.',
        'weak' => 'Blacklistet adgangskode.',
        'wrong_current_password' => 'Den nuværende adgangskode er ugyldig.',
        'wrong_email_confirmation' => 'Emailbekræftelsen er forkert.',
        'wrong_password_confirmation' => 'Adgangskode-felterne matcher ikke.',
        'too_long' => 'Overskrider maksimale længde - kan højest være op til :limit karakterer.',

        'attributes' => [
            'username' => 'Brugernavn',
            'user_email' => 'Mail addresse',
            'password' => 'Adgangskode',
        ],

        'change_username' => [
            'restricted' => 'Du kan ikke ændre dit brugernavn mens du er tilbageholdt.',
            'supporter_required' => [
                '_' => 'Du skal have :link for at ændre dit navn!',
                'link_text' => 'støttede osu!',
            ],
            'username_is_same' => 'Det her er allerede dit Brugernavn, fjollehoved!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason er ikke gyldt for denne type anmeldelse.',
        'self' => "Du kan ikke rapportere dig selv!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Antal',
                'cost' => 'Pris',
            ],
        ],
    ],
];
