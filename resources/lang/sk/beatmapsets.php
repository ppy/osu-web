<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Táto beatmapa momentálne nie je k dispozícii na stiahnutie.',
        'parts-removed' => 'Časti tejto mapy boli vymazané na žiadosť tvorca alebo vlastníka tretej strany.',
        'more-info' => 'Klikni sem pre viac informácií.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Zoznam Beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'stiahnúť',
            'video' => 'stiahnuť s videom',
            'no_video' => 'stiahnuť bez videa',
            'direct' => '',
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
        'discussion' => 'Diskusia',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Pridať do mojich obľúbených',
            'favourite_login' => '',
            'logged-out' => 'Pre sťahovanie beatmap sa najskôr musíš prihlásiť!',
            'mapped_by' => 'beatmapu vytvoril :mapper',
            'unfavourite' => 'Odobrať z mojich obľúbených',
            'updated_timeago' => 'naposledy aktualizované :timeago',

            'download' => [
                '_' => 'Stiahnúť',
                'direct' => '',
                'no-video' => 'bez Videa',
                'video' => 's Videom',
            ],

            'login_required' => [
                'bottom' => 'pre prístup k ďalším funkciám',
                'top' => 'Prihláste sa',
            ],
        ],

        'details_date' => [
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'ranked' => '',
            'submitted' => '',
            'updated' => 'naposledy aktualizovaný :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Máte príliš veľa obľúbených beatmáp! Prosím odstráňte jednu pre pokračovanie.',
        ],

        'hype' => [
            'action' => 'Dajte Hype tejto mape, ak ste si užili jej hranie, aby ste jej pomohli dostať <strong>Hodnotený</strong> status.',

            'current' => [
                '_' => 'Táto mapa je práve :status.',

                'status' => [
                    'pending' => 'čakajúci',
                    'qualified' => 'kvalifikované',
                    'wip' => 'rozpracované',
                ],
            ],

            'disqualify' => [
                '_' => '',
            ],

            'report' => [
                '_' => '',
                'button' => 'Nahlásiť problém',
                'link' => 'tu',
            ],
        ],

        'info' => [
            'description' => 'Popis',
            'genre' => 'Žáner',
            'language' => 'Jazyk',
            'no_scores' => 'Vypočítavajú sa dáta...',
            'nsfw' => '',
            'points-of-failure' => 'Body Neúspechu',
            'source' => 'Zdroj',
            'storyboard' => '',
            'success-rate' => 'Úspešnosť',
            'tags' => 'Tagy',
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
            'achieved' => 'dosiahol :when',
            'country' => 'Rebríček Krajiny',
            'friend' => 'Rebríček Priateľov',
            'global' => 'Celosvetový Rebríčok',
            'supporter-link' => 'Kliknite <a href=":link">tu</a> pre zobrazenie všetkych výhod, ktoré dostanete!',
            'supporter-only' => 'Pre zobrazenie štátnych a rebriček priateľov potrebujete funkciu supportera!',
            'title' => 'Tabuľka výsledkov',

            'headers' => [
                'accuracy' => 'Presnosť',
                'combo' => 'Maximálne Kombo',
                'miss' => 'Minutie',
                'mods' => 'Módy',
                'pin' => '',
                'player' => 'Hráč',
                'pp' => '',
                'rank' => 'Hodnotenie',
                'score' => 'Skóre',
                'score_total' => 'Celkové skóre',
                'time' => '',
            ],

            'no_scores' => [
                'country' => 'Zatiaľ nikto z tvojej krajiny nedosiahol žiadne skóre na tejto mape!',
                'friend' => 'Zatiaľ nikto z tvojich priateľov nedosiahol žiadne skóre na tejto mape!',
                'global' => 'Zatiaľ žiadne skóre. Možno by si sa o to mal pokúsiť?',
                'loading' => 'Načítava sa skóre...',
                'unranked' => 'Nehodnotená beatmapa.',
            ],
            'score' => [
                'first' => 'Vo Vedení',
                'own' => 'Tvoje Najlepšie',
            ],
            'supporter_link' => [
                '_' => '',
                'here' => '',
            ],
        ],

        'stats' => [
            'cs' => 'Veľkosť Koliečok',
            'cs-mania' => 'Počet Kláves',
            'drain' => 'Vysávanie bodov života',
            'accuracy' => 'Presnosť',
            'ar' => 'Rýchlosť Zobrazovania Koliečok',
            'stars' => 'Počet Hviezd',
            'total_length' => 'Dĺžka',
            'bpm' => 'BPM',
            'count_circles' => 'Počet kruhov',
            'count_sliders' => 'Počet sliderov',
            'user-rating' => 'Používateľské hodnotenie',
            'rating-spread' => 'Graf hodnotenia',
            'nominations' => 'Nominácie',
            'playcount' => 'Počet zahraní',
        ],

        'status' => [
            'ranked' => 'Hodnotené',
            'approved' => 'Schválené',
            'loved' => 'Obľúbené',
            'qualified' => 'Kvalifikované',
            'wip' => 'Nedorobené',
            'pending' => 'Nevybavené',
            'graveyard' => 'Cintorín',
        ],
    ],
];
