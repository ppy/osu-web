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
        'disabled' => 'Dette beatmap er i øjeblikket ikke tilgængeligt for download.',
        'parts-removed' => 'Dele af dette beatmap er blevet fjernet efter anmodning fra skaberen eller en tredjeparts-rettighedsholder.',
        'more-info' => 'Klik her for mere information.',
    ],

    'index' => [
        'title' => 'Beatmap-Liste',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'favourite' => 'Markér dette beatmapset som favorit',
            'logged-out' => 'Du skal være logget ind for at kunne downloade beatmaps!',
            'mapped_by' => 'mappet af :mapper',
            'unfavourite' => 'Fjern dette beatmapset fra dine favoritter',
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
                    'wip' => 'under konstruktion',
                ],
            ],

            'disqualify' => [
                '_' => 'Hvis du finder en fejl i denne beatmap, diskvalificer den venligst :link.',
                'button_title' => 'Diskvalificer en kvalificeret beatmap.',
            ],

            'report' => [
                '_' => 'Hvis du finder en fejl i denne beatmap, meld det venligst :link til teamet.',
                'button' => 'Rapporter Problem',
                'button_title' => 'Rapporter et problem på en kvalificeret beatmap.',
                'link' => 'her',
            ],
        ],

        'info' => [
            'description' => 'Beskrivelse',
            'genre' => 'Genre',
            'language' => 'Sprog',
            'no_scores' => 'Data er stadig ved at blive beregnet...',
            'points-of-failure' => 'Fejl-steder',
            'source' => 'Kilde',
            'success-rate' => 'Succesrate',
            'tags' => 'Tags',
            'unranked' => 'Ikke-ranked beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'opnået :when',
            'country' => 'Lande Rang',
            'friend' => 'Rang blandt Venner',
            'global' => 'Global Rang',
            'supporter-link' => 'Klik <a href=":link">here</a> for at se alle de fede fordele du kan få!',
            'supporter-only' => 'Du skal være supporter for at få adgang til venne- og landerangering!',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Præcision',
                'combo' => 'Maks Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Spiller',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Total Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'Ingen fra dit land har sat en score på dette map endnu!',
                'friend' => 'Ingen af dine venner har sat en score på dette map endnu!',
                'global' => 'Ingen scores endnu. Måske skulle du prøve at sætte en?',
                'loading' => 'Indlæser scores...',
                'unranked' => 'Ikke-ranked beatmap.',
            ],
            'score' => [
                'first' => 'I Førerpositionen',
                'own' => 'Dit Bedste',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkel-størrelse',
            'cs-mania' => 'Taste-antal',
            'drain' => 'HP-Dræn',
            'accuracy' => 'Præcision',
            'ar' => 'Approach Rate',
            'stars' => 'Stjerne-sværhedsgrad',
            'total_length' => 'Længde',
            'bpm' => 'BPM',
            'count_circles' => 'Antal Cirkler',
            'count_sliders' => 'Antal Sliders',
            'user-rating' => 'Brugerbedømmelse',
            'rating-spread' => 'Ratings-distribution',
            'nominations' => 'Nomineringer',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Godkendt',
            'loved' => 'Elsket',
            'qualified' => 'Kvalificeret',
            'wip' => 'WIP',
            'pending' => 'Afventende',
            'graveyard' => 'Kirkegården',
        ],
    ],
];
