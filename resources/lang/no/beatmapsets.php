<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Dette beatmappet er for øyeblikket ikke tilgjengelig for nedlastning.',
        'parts-removed' => 'Deler av dette beatmappet har blitt fjernet etter forespørsel av skaperen eller en tredjepart rettighetshaver.',
        'more-info' => 'Klikk her for mer informasjon.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => 'Ro ned, spill mer.',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Beatmapsliste',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'last ned',
            'video' => 'last ned med video',
            'no_video' => 'last ned med video',
            'direct' => 'åpne i osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => 'Du har ikke tillatelse til å nominere for modus: :mode',
        'full_bn_required' => '',
        'too_many' => 'Nominasjonskravet er allerede oppfylt.',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => 'Nominer for hvilke moduser?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplisitt',
    ],

    'show' => [
        'discussion' => 'Diskusjon',

        'details' => [
            'by_artist' => 'av :artist',
            'favourite' => 'Marker dette beatmapsettet som en favoritt',
            'favourite_login' => '',
            'logged-out' => 'Du må logge inn før du kan laste ned beatmaps!',
            'mapped_by' => 'mappet av :mapper',
            'unfavourite' => 'Fjern dette beatmapsettet som en favoritt',
            'updated_timeago' => 'sist oppdatert :timeago',

            'download' => [
                '_' => 'Last ned',
                'direct' => '',
                'no-video' => 'uten Video',
                'video' => 'med Video',
            ],

            'login_required' => [
                'bottom' => 'for å få tilgang til flere funksjoner',
                'top' => 'Logg inn',
            ],
        ],

        'details_date' => [
            'approved' => 'godkjent :timeago',
            'loved' => 'elsket :timeago',
            'qualified' => 'kvalifisert :timeago',
            'ranked' => 'rangert :timeago',
            'submitted' => 'sent inn :timeago',
            'updated' => 'sist oppdatert :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Du har lagt til for mange beatmaps som favoritter! Vennligst fjern noen av favorittene dine før du prøver igjen.',
        ],

        'hype' => [
            'action' => 'Hype denne mappen hvis du likte å spille den, for å hjelpe den å nå <strong>Rangert</strong> status.',

            'current' => [
                '_' => 'Dette mappet er for øyeblikket :status.',

                'status' => [
                    'pending' => 'ventende',
                    'qualified' => 'kvalifisert',
                    'wip' => 'under konstruksjon',
                ],
            ],

            'disqualify' => [
                '_' => 'Hvis du finner et problem med dette beatmappet, vennligst diskvalifiser det :link.',
            ],

            'report' => [
                '_' => 'Hvis du finner et problem med dette beatmappet, vennligst rapporter det :link for å varsle teamet.',
                'button' => 'Rapporter Problem',
                'link' => 'her',
            ],
        ],

        'info' => [
            'description' => 'Beskrivelse',
            'genre' => 'Sjanger',
            'language' => 'Språk',
            'no_scores' => 'Data blir fortsatt kalkulert...',
            'nsfw' => 'Eksplisitt innhold',
            'points-of-failure' => 'Feilpunkter',
            'source' => 'Kilde',
            'storyboard' => '',
            'success-rate' => 'Suksessrate',
            'tags' => 'Stikkord',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => '',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'oppnådd :when',
            'country' => 'Landsrangering',
            'friend' => 'Vennerangering',
            'global' => 'Global Rangering',
            'supporter-link' => 'Klikk <a href=":link">her</a> for å se alle de fancy funskjonene du får tildelt!',
            'supporter-only' => 'Du må være en osu!supporter for å ha tilgang til venne- og landsrangering!',
            'title' => 'Poengliste',

            'headers' => [
                'accuracy' => 'Presisjon',
                'combo' => 'Maks Kombo',
                'miss' => 'Bom',
                'mods' => 'Modifikasjoner',
                'pin' => '',
                'player' => 'Spiller',
                'pp' => '',
                'rank' => 'Rang',
                'score' => 'Poengsum',
                'score_total' => 'Total Poengsum',
                'time' => 'Tid',
            ],

            'no_scores' => [
                'country' => 'Ingen fra landet ditt har satt en poengsum på denne mappen enda!',
                'friend' => 'Ingen av vennene dine har satt en poengsum på denne mappen enda!',
                'global' => 'Ingen poengsummer enda. Kanskje du skulle prøve å sette noen?',
                'loading' => 'Laster poengsummer...',
                'unranked' => 'Urangert beatmap.',
            ],
            'score' => [
                'first' => 'I ledelsen',
                'own' => 'Ditt beste',
            ],
        ],

        'stats' => [
            'cs' => 'Sirkel Størrelse',
            'cs-mania' => 'Antall Tangenter',
            'drain' => 'HP Drenering',
            'accuracy' => 'Presisjon',
            'ar' => 'Tilnærmingsrate',
            'stars' => 'Vanskelighetsgrad (*)',
            'total_length' => 'Lengde',
            'bpm' => 'BPM',
            'count_circles' => 'Antall Sirkler',
            'count_sliders' => 'Antall Glidere',
            'user-rating' => 'Brukervurderinger',
            'rating-spread' => 'Vurderingsskjema',
            'nominations' => 'Nominasjoner',
            'playcount' => 'Spillforsøk',
        ],

        'status' => [
            'ranked' => 'Rangert',
            'approved' => 'Godkjent',
            'loved' => 'Elsket',
            'qualified' => 'Kvalifisert',
            'wip' => 'Arbeid pågår',
            'pending' => 'Avventes',
            'graveyard' => 'Gravplassert',
        ],
    ],
];
