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
        'disabled' => 'Táto beatmapa momentálne nie je k dispozícii na stiahnutie.',
        'parts-removed' => 'Časti tejto mapy boli vymazané na žiadosť tvorca alebo vlastníka tretej strany.',
        'more-info' => 'Klikni sem pre viac informácií.',
    ],

    'index' => [
        'title' => 'Zoznam Beatmap',
        'guest_title' => 'Beatmapy',
    ],

    'show' => [
        'discussion' => 'Diskusia',

        'details' => [
            'favourite' => 'Pridať do mojich obľúbených',
            'favourited_count' => '+ 1 ďalší!|+ :count ďalších!',
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
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
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
        ],

        'info' => [
            'description' => 'Popis',
            'genre' => 'Žáner',
            'language' => 'Jazyk',
            'no_scores' => 'Vypočítavajú sa dáta...',
            'points-of-failure' => 'Body Neúspechu',
            'source' => 'Zdroj',
            'success-rate' => 'Úspešnosť',
            'tags' => 'Tagy',
            'unranked' => 'Nehodnotená beatmapa',
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
                'player' => 'Hráč',
                'pp' => '',
                'rank' => 'Hodnotenie',
                'score_total' => 'Celkové skóre',
                'score' => 'Skóre',
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
    ],
];
