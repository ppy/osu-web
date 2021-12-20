<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Dette beatmap er i øjeblikket ikke tilgængeligt for download.',
        'parts-removed' => 'Dele af dette beatmap er blevet fjernet efter anmodning fra skaberen eller en tredjeparts-rettighedsholder.',
        'more-info' => 'Klik her for mere information.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Beatmap-Liste',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'ingen beatmaps',

        'download' => [
            'all' => 'download',
            'video' => 'download med video',
            'no_video' => 'download uden video',
            'direct' => 'open med osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => 'Du skal være en fuld nominator for at kunne udføre denne kvalificerende nominering.',
        'too_many' => 'Nomineringskravet er allerede opfyldt.',

        'dialog' => [
            'confirmation' => 'Er du sikker på du vil nominere dette Beatmap?',
            'header' => 'Nominér Beatmap',
            'hybrid_warning' => 'bemærk: du kan kun nominere én gang, så sørg for at du nominerer til alle spiltilstande, du har til hensigt til',
            'which_modes' => 'Nominér for hvilke tilstande?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Markér dette beatmapset som favorit',
            'favourite_login' => '',
            'logged-out' => 'Du skal være logget ind for at kunne downloade beatmaps!',
            'mapped_by' => 'mappet af :mapper',
            'unfavourite' => 'Fjern dette beatmapset fra dine favoritter',
            'updated_timeago' => 'sidst opdateret :timeago',

            'download' => [
                '_' => 'Download',
                'direct' => '',
                'no-video' => 'uden video',
                'video' => 'med video',
            ],

            'login_required' => [
                'bottom' => 'til at få adgang til flere funktioner',
                'top' => 'Log ind',
            ],
        ],

        'details_date' => [
            'approved' => 'godkendt :timeago',
            'loved' => 'elsket :timeago',
            'qualified' => 'kvalificeret :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => 'indsendt :timeago',
            'updated' => 'sidst opdateret :timeago',
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
            ],

            'report' => [
                '_' => 'Hvis du finder en fejl i denne beatmap, meld det venligst :link til teamet.',
                'button' => 'Rapporter Problem',
                'link' => 'her',
            ],
        ],

        'info' => [
            'description' => 'Beskrivelse',
            'genre' => 'Genre',
            'language' => 'Sprog',
            'no_scores' => 'Data er stadig ved at blive beregnet...',
            'nsfw' => '',
            'points-of-failure' => 'Fejl-steder',
            'source' => 'Kilde',
            'storyboard' => 'Dette beatmap indeholder storyboard',
            'success-rate' => 'Succesrate',
            'tags' => 'Tags',
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
                'time' => 'Tid',
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
