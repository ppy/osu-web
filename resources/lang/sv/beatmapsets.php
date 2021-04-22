<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Denna beatmap är för närvarande inte tillgänglig för nedladdning.',
        'parts-removed' => 'Portioner av denna beatmap har blivit borttagna på förfrågan av skaparen eller en tredje-parts rättighets hållare.',
        'more-info' => 'Klicka här för mer information.',
        'rule_violation' => 'Vissa delar av denna map har tagits bort då de anses vara olämpliga i osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Sakta ner, spela mer.',
    ],

    'index' => [
        'title' => 'Beatmaps Listning',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'inga beatmaps',

        'download' => [
            'all' => 'ladda ner',
            'video' => 'ladda ner med video',
            'no_video' => 'ladda ner utan video',
            'direct' => 'öppna i osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => 'Du har inte behörighet att nominera för läge: :mode',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => 'Är du säker på att du vill nominera denna Beatmap?',
            'header' => 'Nominera Beatmap',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Favorisera denna beatmapset',
            'favourite_login' => '',
            'logged-out' => 'Du behöver logga in innan du laddar ner beatmaps!',
            'mapped_by' => 'skapad av :mapper',
            'unfavourite' => 'Ta bort favorisering på denna beatmapset',
            'updated_timeago' => 'senast ändrad :timeago',

            'download' => [
                '_' => 'Ladda Ner',
                'direct' => '',
                'no-video' => 'utan Video',
                'video' => 'med Video',
            ],

            'login_required' => [
                'bottom' => 'för att komma åt fler funktioner',
                'top' => 'Logga in',
            ],
        ],

        'details_date' => [
            'approved' => 'godkänd :timeago',
            'loved' => 'älskad :timeago',
            'qualified' => 'kvalificerat :timeago',
            'ranked' => 'rankad :timeago',
            'submitted' => 'skickad :timeago',
            'updated' => 'senast uppdaterat :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Du har för många favoriserade beatmaps! Var vänlig ta bort en favorit innan du fortsätter.',
        ],

        'hype' => [
            'action' => 'Hypa denna map om du gillade att spela den för att hjälpa den att utvecklas till <strong>Rankad</strong> status.',

            'current' => [
                '_' => 'Denna map är för närvarande :status.',

                'status' => [
                    'pending' => 'väntande',
                    'qualified' => 'kvalificerad',
                    'wip' => 'under utveckling',
                ],
            ],

            'disqualify' => [
                '_' => 'Om du hittar ett problem med denna beatmap, diskvalificera den :link.',
            ],

            'report' => [
                '_' => 'Om du hittar ett problem med denna beatmap, vänligen rapportera det :link för att varna laget.',
                'button' => 'Rapportera problem',
                'link' => 'här',
            ],
        ],

        'info' => [
            'description' => 'Beskrivning',
            'genre' => 'Genre',
            'language' => 'Språk',
            'no_scores' => 'Data beräknas...',
            'nsfw' => 'Explicit innehåll',
            'points-of-failure' => 'Punkter av Misslyckande',
            'source' => 'Källa',
            'storyboard' => '',
            'success-rate' => 'Genomsnittig Succe',
            'tags' => 'Taggar',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => 'Denna beatmap innehåller explicit, kränkande eller störande innehåll. Vill du se den ändå?',
            'title' => 'Explicit innehåll',

            'buttons' => [
                'disable' => 'Inaktivera varning',
                'listing' => 'Beatmaplistningar',
                'show' => 'Visa',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'uppnått :when',
            'country' => 'Nationell rankning',
            'friend' => 'Rankning bland vänner',
            'global' => 'Global rankning',
            'supporter-link' => 'Klicka <a href=":link">här</a> för att se alla fina funktioner du kommer få!',
            'supporter-only' => 'Du behöver vara en supporter för att komma åt vän och land rankningar!',
            'title' => 'Resultattavla',

            'headers' => [
                'accuracy' => 'Precision',
                'combo' => 'Högsta Kombo',
                'miss' => 'Missar',
                'mods' => 'Tillägg',
                'player' => 'Spelare',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Total Poäng',
                'score' => 'Poäng',
                'time' => 'Tid',
            ],

            'no_scores' => [
                'country' => 'Ingen från ditt land har satt ett poäng på denna map än!',
                'friend' => 'Ingen av dina vänner har satt ett poäng på denna map än!',
                'global' => 'Inga poäng än. Du kanske ska försöka sätta några?',
                'loading' => 'Laddar poäng...',
                'unranked' => 'Ej rankad beatmap.',
            ],
            'score' => [
                'first' => 'Leder',
                'own' => 'Ditt Bästa',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkel Storlek',
            'cs-mania' => 'Antal Tangenter',
            'drain' => 'HP Tömning',
            'accuracy' => 'Precision',
            'ar' => 'Approach Hastighet',
            'stars' => 'Stjärn Svårighetsgrad',
            'total_length' => 'Längd',
            'bpm' => 'BPM',
            'count_circles' => 'Antal Cirklar',
            'count_sliders' => 'Antal Sliders',
            'user-rating' => 'Användar Betyg',
            'rating-spread' => 'Betyg Spridning',
            'nominations' => 'Nomineringar',
            'playcount' => 'Speltid',
        ],

        'status' => [
            'ranked' => 'Rankad',
            'approved' => 'Godkänd',
            'loved' => 'Älskad',
            'qualified' => 'Kvalificerad',
            'wip' => 'Arbete pågår',
            'pending' => 'Väntande',
            'graveyard' => 'Kyrkogård',
        ],
    ],
];
