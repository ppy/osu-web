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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Kan ikke angre hyping.',
            'has_reply' => 'Kan ikke slette en diskusjon med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har nådd din nominasjons grense for dagen, vennligst prøv igjen i morgen.',
            'incorrect_state' => 'Feil under utføringen av denne handlingen, prøv å oppdatere siden.',
            'owner' => "Kan ikke nominere egen beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Bare personen som startet tråden og beatmap eieren kan markere en diskusjon som løst.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Bare beatmap eier eller nominator/QAT gruppemedlem kan legge inn kartleggingsnotater.',
        ],

        'vote' => [
            'limit_exceeded' => 'Vennligst vent en stund før du avgir flere stemmer',
            'owner' => "Kan ikke stemme på eget diskusjonsinnlegg.",
            'wrong_beatmapset_state' => 'Kan bare stemme på diskusjoner der beatmappen er påventende.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisk generert innlegg kan ikke redigeres.',
            'not_owner' => 'Bare senderen kan redigere innlegget.',
        ],
    ],

    'chat' => [
        'blocked' => 'Kan ikke sende melding til en bruker som blokkerer deg eller som du har blokkert.',
        'friends_only' => 'Brukeren blokkerer meldinger fra personer som ikke er på deres venneliste.',
        'moderated' => 'Denne kanalen er for tiden moderert.',
        'no_access' => 'Du har ingen adgang til denne kanalen.',
        'restricted' => 'Du kan ikke sende meldinger mens du er forstummet, begrenset eller bannlyst.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Kan ikke redigere slettet innlegg.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan ikke endre stemmen din etter den stemmeberettigede perioden for denne konkurransen har avsluttet.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Ingen tillatelse til å moderere dette forumet.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Bare det siste innlegget kan slettes.',
                'locked' => 'Kan ikke slette innlegg i et låst emne.',
                'no_forum_access' => 'Adgang til forespurt forum kreves.',
                'not_owner' => 'Bare senderen kan slette innlegget.',
            ],

            'edit' => [
                'deleted' => 'Kan ikke redigere slettet innlegg.',
                'locked' => 'Innlegget er låst fra redigering.',
                'no_forum_access' => 'Adgang til forespurt forum kreves.',
                'not_owner' => 'Bare senderen kan redigere innlegget.',
                'topic_locked' => 'Kan ikke redigere innlegget i et låst emne.',
            ],

            'store' => [
                'play_more' => 'Prøv å spille spillet før du skriver et innlegg på forumet, vær så snill! Hvis du har et problem med å spille, vær grei å skriv et innlegg i Hjelp og Støtte forumet.',
                'too_many_help_posts' => "Du må spille spillet mer før du kan opprette flere innlegg. Hvis du fortsatt har problemer med å spille, email support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Vær så snill å rediger ditt siste innlegg, i steden for å legge til et nytt innlegg.',
                'locked' => 'Kan ikke svare til en lukket tråd.',
                'no_forum_access' => 'Adgang til forespurt forum kreves.',
                'no_permission' => 'Ingen tillatelse til å svare.',

                'user' => [
                    'require_login' => 'Vennligst logg inn for å svare.',
                    'restricted' => "Kan ikke svare mens kontoen din er begrenset.",
                    'silenced' => "Kan ikke svare mens kontoen din er forstummet.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Adgang til forespurt forum er nødvendig.',
                'no_permission' => 'Ingen tillatelse til å opprette nytt emne.',
                'forum_closed' => 'Kan ikke sende innlegget, ettersom forumet er lukket.',
            ],

            'vote' => [
                'no_forum_access' => 'Adgang til forespurt forum kreves.',
                'over' => 'Avstemningen er over, og derfor kan det ikke stemmes lenger.',
                'voted' => 'Å endre stemme er ikke tillatt.',

                'user' => [
                    'require_login' => 'Vennligst logg inn for å stemme.',
                    'restricted' => "Kan ikke stemme mens kontoen din er begrenset.",
                    'silenced' => "Kan ikke stemme mens kontoen din er forstummet.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Tilgang til forespurte forum er nødvendig.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ugyldig cover spesifisert.',
                'not_owner' => 'Bare eieren kan redigere coveret.',
            ],
        ],

        'view' => [
            'admin_only' => 'Bare administrator kan se dette forumet.',
        ],
    ],

    'require_login' => 'Vennligst logg inn for å fortsette.',

    'unauthorized' => 'Ingen tilgang.',

    'silenced' => "Kan ikke gjøre det mens kontoen din er forstummet.",

    'restricted' => "Kan ikke gjøre det mens kontoen din er begrenset.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Brukersiden er låst.',
                'not_owner' => 'Kan bare redigere egne brukersiden.',
                'require_supporter_tag' => 'osu!supporter merke kreves.',
            ],
        ],
    ],
];
