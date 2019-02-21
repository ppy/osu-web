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
    'availability' => [
        'disabled' => 'Denne beatmappen er for tiden ikke tilgjengelig for nedlastning.',
        'parts-removed' => 'Denne beatmappen inkluderer materielle som har blitt fjernet etter forespørsel fra skaperen eller en tredjepart rettighetshaver.',
        'more-info' => 'Klikk her for mer informasjon.',
    ],

    'index' => [
        'title' => 'Beatmaps Liste',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Diskusjon',

        'details' => [
            'approved' => 'godjent på ',
            'favourite' => 'Marker dette beatmapsettet som en favoritt',
            'favourited_count' => '+ 1 annen!|+ :count andre!',
            'logged-out' => 'Du må logge inn før du kan laste ned beatmaps!',
            'loved' => 'elsket på ',
            'mapped_by' => 'mappet av :mapper',
            'qualified' => 'kvalifisert på ',
            'ranked' => 'rangert på ',
            'submitted' => 'innsendt på ',
            'unfavourite' => 'Fjern favorittmarkeringen på dette beatmapsettet',
            'updated' => 'sist oppdatert på ',
            'updated_timeago' => 'sist oppdatert :timeago',

            'download' => [
                '_' => 'Last ned',
                'direct' => '',
                'no-video' => 'uten Video',
                'video' => 'med Video',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
        ],

        'hype' => [
            'action' => 'Hype denne mappen hvis du likte å spille den, for å hjelpe den å nå <strong>Rangert</strong> status.',

            'current' => [
                '_' => 'Dette mappet er for øyeblikket :status.',

                'status' => [
                    'pending' => 'ventende',
                    'qualified' => 'kvalifisert',
                    'wip' => 'arbeid pågår',
                ],
            ],
        ],

        'info' => [
            'description' => 'Beskrivelse',
            'genre' => 'Sjanger',
            'language' => 'Språk',
            'no_scores' => 'Data blir fortsatt kalkulert...',
            'points-of-failure' => 'Feilpunkter',
            'source' => 'Kilde',
            'success-rate' => 'Suksessrate',
            'tags' => 'Stikkord',
            'unranked' => 'Urangert beatmap',
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
                'combo' => 'Maks Combo',
                'miss' => 'Bom',
                'mods' => 'Modifikasjoner',
                'player' => 'Spiller',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Total Poengsum',
                'score' => 'Poengsum',
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
            'drain' => 'HP avløp',
            'accuracy' => 'Presisjon',
            'ar' => 'Tilnærmingsrate',
            'stars' => 'Stjerne Vanskelighetsgrad',
            'total_length' => 'Lengde',
            'bpm' => 'BPM',
            'count_circles' => 'Antall Sirkler',
            'count_sliders' => 'Antall Glidere',
            'user-rating' => 'Brukervurderinger',
            'rating-spread' => 'Vurderingsskjema',
            'nominations' => 'Nominasjoner',
            'playcount' => 'Spillforsøk',
        ],
    ],
];
