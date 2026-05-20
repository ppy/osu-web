<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Dette beatmappet er for øyeblikket ikke tilgjengelig for nedlastning.',
        'parts-removed' => 'Deler av dette beatmappet har blitt fjernet etter forespørsel av skaperen eller en tredjepart rettighetshaver.',
        'more-info' => 'Klikk her for mer informasjon.',
        'rule_violation' => 'Enkelte ressurser i dette kartet har blitt fjernet, etter som at det ikke kan brukes i osu!.',
    ],

    'cover' => [
        'deleted' => 'Slettet beatmap',
    ],

    'download' => [
        'limit_exceeded' => 'Ro ned, spill mer.',
        'no_mirrors' => '',
    ],

    'featured_artist_badge' => [
        'label' => 'Utvalgt artist',
    ],

    'index' => [
        'title' => 'Beatmapsliste',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'ingen beatmaps',

        'download' => [
            'all' => 'last ned',
            'video' => 'last ned med video',
            'no_video' => 'last ned med video',
            'direct' => 'åpne i osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Probasjonære nominatorer kan ikke nominere flere regler.',
        'full_nomination_required' => 'Du må være en full nominator for å foreta endelig nominasjon av en regel.',
        'hybrid_requires_modes' => 'Et hybrid beatmap krever at du velger minst en spillmodus å nominere for.',
        'incorrect_mode' => 'Du har ikke tillatelse til å nominere for modus: :mode',
        'invalid_limited_nomination' => '',
        'invalid_ruleset' => '',
        'too_many' => 'Nominasjonskravet er allerede oppfylt.',
        'too_many_non_main_ruleset' => '',

        'dialog' => [
            'confirmation' => 'Er du sikker på at du vil nominere dette beatmappet?',
            'different_nominator_warning' => '',
            'header' => 'Nominer Beatmap',
            'hybrid_warning' => 'merk: du kan kun nominere èn gang. Vær så snill å forsikre deg om at du nominerer for alle spill-modusene du har tenkt å nominere på',
            'current_main_ruleset' => '',
            'which_modes' => 'Nominer for hvilke moduser?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Eksplisitt',
    ],

    'show' => [
        'discussion' => 'Diskusjon',

        'admin' => [
            'full_size_cover' => 'Vis omslagsbilde i full størrelse',
            'page' => '',
        ],

        'deleted_banner' => [
            'title' => 'Dette beatmappet har blitt slettet.',
            'message' => '(kun moderatorer kan se dette)',
        ],

        'details' => [
            'by_artist' => 'av :artist',
            'favourite' => 'Marker dette beatmapsettet som en favoritt',
            'favourite_login' => 'logg inn for å legge dette beatmappet til i favoritter',
            'logged-out' => 'Du må logge inn før du kan laste ned beatmaps!',
            'mapped_by' => 'mappet av :mapper',
            'mapped_by_guest' => 'gjeste-kart av :mapper',
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
            'mapper_tags' => '',
            'no_scores' => 'Data blir fortsatt kalkulert...',
            'nominators' => 'Nominerende',
            'nsfw' => 'Eksplisitt innhold',
            'offset' => 'Globalt offset',
            'pack_tags' => '',
            'points-of-failure' => 'Feilpunkter',
            'source' => 'Kilde',
            'storyboard' => 'Dette beatmappet inneholder storyboard',
            'success-rate' => 'Suksessrate',
            'success_rate_plays' => '',
            'user_tags' => '',
            'video' => 'Dette beatmappet inneholder video',
        ],

        'nsfw_warning' => [
            'details' => 'Dette beatmappet inneholder grovt, støtende eller forstyrrende innhold. Vil du fortsette uansett?',
            'title' => 'Grovt Innhold',

            'buttons' => [
                'disable' => 'Skru av advarsel',
                'listing' => 'Beatmapliste',
                'show' => 'Vis',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'oppnådd :when',
            'country' => 'Landsrangering',
            'error' => 'Kunne ikke laste rangering',
            'friend' => 'Vennerangering',
            'global' => 'Global Rangering',
            'supporter-link' => 'Klikk <a href=":link">her</a> for å se alle de fancy funskjonene du får tildelt!',
            'supporter-only' => 'Du må være en osu!supporter for å ha tilgang til venne- og landsrangering!',
            'team' => '',
            'title' => 'Poengliste',

            'headers' => [
                'accuracy' => 'Presisjon',
                'combo' => 'Maks Kombo',
                'miss' => 'Bom',
                'mods' => 'Modifikasjoner',
                'pin' => 'Fest',
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
                'team' => '',
                'unranked' => 'Urangert beatmap.',
            ],
            'score' => [
                'first' => 'I ledelsen',
                'own' => 'Ditt beste',
            ],
            'supporter_link' => [
                '_' => 'Klikk :here for å se alle de stilige funksjonene du får!',
                'here' => 'her',
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
            'offset' => 'Globalt offset :offset',
            'user-rating' => 'Brukervurderinger',
            'rating-spread' => 'Vurderingsskjema',
            'nominations' => 'Nominasjoner',
            'playcount' => 'Spillforsøk',
            'favourites' => 'Favoritter',
            'no_favourites' => '',
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

    'spotlight_badge' => [
        'label' => 'Spotlight',
    ],
];
