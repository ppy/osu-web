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
        'disabled' => 'Dette beatmap er i øjeblikket ikke tilgængelig for download.',
        'parts-removed' => 'Dele af dette beatmap er blevet fjernet efter anmodning fra skaberen eller en tredjeparts-rettighedsholder.',
        'more-info' => 'Check here for more information.',
    ],

    'index' => [
        'title' => 'Beatmaps Liste',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'approved' => 'godkendt den ',
            'favourite' => 'Markér dette beatmapset som favorit',
            'favourited_count' => '+ 1 anden!|+ :count andre!',
            'logged-out' => 'Du skal være logget ind for at kunne downloade beatmaps!',
            'loved' => 'loved den ',
            'mapped_by' => 'mappet af :mapper',
            'qualified' => 'kvalificeret den ',
            'ranked' => 'ranked den ',
            'submitted' => 'indsendt den ',
            'unfavourite' => 'Fjern markering af dette beatmapset som favorit',
            'updated' => 'sidst opdateret den ',
            'updated_timeago' => 'sidst opdateret :timeago',

            'download' => [
                '_' => 'Download',
                'direct' => 'osu!direct',
                'no-video' => 'uden video',
                'video' => 'med video',
            ],

            'login_required' => [
                'bottom' => 'til at få adgang til flere funktioner',
                'top' => 'Log ind',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Du har for mange favoritter! Fjern venligst en favorit for at tilføje en ny.',
        ],

        'hype' => [
            'action' => 'Hype dette map hvis du nød at spille det for at hjælpe det til at komme til en <strong>Ranked</strong> status.',

            'current' => [
                '_' => 'Dette map er i øjeblikket :status.',

                'status' => [
                    'pending' => 'afvendtende',
                    'qualified' => 'kvalificeret',
                    'wip' => 'endnu ikke færdigt',
                ],
            ],
        ],

        'info' => [
            'description' => 'Beskrivelse',
            'genre' => 'Genre',
            'language' => 'Sprog',
            'no_scores' => 'Dataen er ved at blive beregnet...',
            'points-of-failure' => 'Fejlpoints',
            'source' => 'Kilde',
            'success-rate' => 'Succes Rate',
            'tags' => 'Tags',
            'unranked' => 'Ikke-ranked beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'opnået :when',
            'country' => 'Landerangering',
            'friend' => 'Vennerangering',
            'global' => 'Global Rangering',
            'supporter-link' => 'Klik <a href=":link">here</a> for at se alle de smarte fordele du får!',
            'supporter-only' => 'Du skal være supporter for at få adgang til venne- og landerangering!',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Præcision',
                'combo' => 'Maks Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Spiller',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Samlet Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'Ingen fra dit land har sat en score på dette map endnu!',
                'friend' => 'Ingen af dine venner har sat en score på dette map endnu!',
                'global' => 'Ingen scores endnu. Måske skulle du prøve at lave en?',
                'loading' => 'Indlæser scores...',
                'unranked' => 'Ikke-ranked beatmap.',
            ],
            'score' => [
                'first' => 'I førerpositionen',
                'own' => 'Dit bedste',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkelstørrelse',
            'cs-mania' => 'Key Antal',
            'drain' => 'HP-dræn',
            'accuracy' => 'Præcision',
            'ar' => 'Approach Rate',
            'stars' => 'Stjernesværhedsgrad',
            'total_length' => 'Længde',
            'bpm' => 'BPM',
            'count_circles' => 'Cirkel Antal',
            'count_sliders' => 'Slider Antal',
            'user-rating' => 'Brugerbedømmelse',
            'rating-spread' => 'Rating Fordeling',
            'nominations' => 'Nomineringer',
            'playcount' => 'Playcount',
        ],
    ],
];
