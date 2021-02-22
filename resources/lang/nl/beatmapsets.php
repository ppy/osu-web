<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Deze beatmap kan momenteel niet gedownload worden.',
        'parts-removed' => 'Delen van deze beatmap zijn verwijderd op verzoek van de maker of de houder van de rechten van een derde partij.',
        'more-info' => 'Klik hier voor meer informatie.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'index' => [
        'title' => 'Beatmap Lijst',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'download',
            'video' => 'download met video',
            'no_video' => 'download zonder video',
            'direct' => 'open in osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'Discussie',

        'details' => [
            'favourite' => 'Markeer deze beatmapset als favoriet',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'mapped_by' => 'gemapped door :mapper',
            'unfavourite' => 'Verwijder markering als favoriet',
            'updated_timeago' => 'laatst bijgewerkt :timeago',

            'download' => [
                '_' => 'downloaden',
                'direct' => '',
                'no-video' => 'zonder video',
                'video' => 'met Video',
            ],

            'login_required' => [
                'bottom' => 'toegang tot meer functies',
                'top' => 'Inloggen',
            ],
        ],

        'details_date' => [
            'approved' => 'goedgekeurd :timeago',
            'loved' => 'geliefd :timeago',
            'qualified' => 'gekwalificeerd :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => 'verzonden :timeago',
            'updated' => 'laatst bijgewerkt :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Je hebt te veel favoriete beatmaps! Verwijder er een paar voor je het opnieuw probeert.',
        ],

        'hype' => [
            'action' => 'Hype deze map als je het leuk vond om deze te spelen en om het te helpen de status <strong>ranked</strong> te bereiken.',

            'current' => [
                '_' => 'Deze map is momenteel :status.',

                'status' => [
                    'pending' => 'in behandeling',
                    'qualified' => 'gekwalificeerd',
                    'wip' => 'werk in uitvoering',
                ],
            ],

            'disqualify' => [
                '_' => 'Als u een probleem met deze beatmap vindt, alsjeblieft diskwalificeer het :link.',
            ],

            'report' => [
                '_' => 'Als u een probleem met deze beatmap vindt, rapporteer deze dan :link om het team te waarschuwen.',
                'button' => 'Rapporteer Probleem',
                'link' => 'hier',
            ],
        ],

        'info' => [
            'description' => 'Beschrijving',
            'genre' => 'Genre',
            'language' => 'Taal',
            'no_scores' => 'Data nog aan het berekenen...',
            'nsfw' => '',
            'points-of-failure' => 'Faalpunten',
            'source' => 'Bron',
            'success-rate' => 'Slagingspercentage',
            'tags' => 'Labels',
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
            'achieved' => 'bereikt op :when',
            'country' => 'Landranking',
            'friend' => 'Vriendenranking',
            'global' => 'Globale Ranking',
            'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
            'supporter-only' => 'Je moet supporter zijn om land- en vriendenrankings te zien!',
            'title' => 'Scorebord',

            'headers' => [
                'accuracy' => 'Nauwkeurigheid',
                'combo' => 'Max. Combo',
                'miss' => 'Mis',
                'mods' => 'Mods',
                'player' => 'Speler',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Totale Score',
                'score' => 'Score',
                'time' => 'Datum',
            ],

            'no_scores' => [
                'country' => 'Niemand uit jouw land heeft nog een score behaald op deze map!',
                'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                'global' => 'Nog geen scores. Probeer er een paar te halen?',
                'loading' => 'Scoren aan het laden...',
                'unranked' => 'Ongerankte beatmap.',
            ],
            'score' => [
                'first' => 'Aan de Leiding',
                'own' => 'Jouw beste Rang',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkelgrootte',
            'cs-mania' => 'Aantal Lanen',
            'drain' => 'HP Drain',
            'accuracy' => 'Precisie',
            'ar' => 'Benaderingssnelheid',
            'stars' => 'Sterrenmoeilijkheid',
            'total_length' => 'Lengte',
            'bpm' => 'BPM',
            'count_circles' => 'Aantal Cirkels',
            'count_sliders' => 'Aantal Sliders',
            'user-rating' => 'Gebruikersbeoordelingen',
            'rating-spread' => 'Rating Verspreiding',
            'nominations' => 'Nominaties',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Gekwalificeerd',
            'wip' => 'WIP',
            'pending' => 'In behandelIng',
            'graveyard' => 'Begraafplaats',
        ],
    ],
];
