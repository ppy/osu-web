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
        'disabled' => 'Ez a beatmap jelenleg nem letölthető.',
        'parts-removed' => 'Ez a beatmap eltávolításra került a készítő vagy egy jogbirtokos harmadik fél kérésére.',
        'more-info' => 'Itt találsz több információt.',
    ],

    'index' => [
        'title' => 'Beatmap lista',
        'guest_title' => 'Beatmap-ek',
    ],

    'show' => [
        'discussion' => 'Beszélgetés',

        'details' => [
            'favourite' => 'A beatmap szett kedvencek közé tétele',
            'logged-out' => 'Beatmap letöltéshez be kell jelentkezned!',
            'mapped_by' => 'mappolva :mapper által',
            'unfavourite' => 'Beatmap eltávolitása a kedvencek közül',
            'updated_timeago' => 'utóljára frissítve: :timeago',

            'download' => [
                '_' => 'Letöltés',
                'direct' => 'osu!direct',
                'no-video' => 'Videó nélkül',
                'video' => 'Videóval',
            ],

            'login_required' => [
                'bottom' => 'további funkciók eléréséhez',
                'top' => 'Bejelentkezés',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Túl sok beatmap van a kedvenceid között! Kérlek távolíts el néhányat az újrapróbálkozás előtt.',
        ],

        'hype' => [
            'action' => 'Hype-old a map-et ha élvezted rajta a játékot, hogy segíthesd a <strong>Rangsorolt</strong> állapot felé jutásban.',

            'current' => [
                '_' => 'Ez a map :status jelenleg.',

                'status' => [
                    'pending' => 'függőben',
                    'qualified' => 'kvalifikált',
                    'wip' => 'munkálatok alatt',
                ],
            ],

            'disqualify' => [
                '_' => '',
                'button_title' => '',
            ],

            'report' => [
                '_' => '',
                'button' => 'Probléma jelentése',
                'button_title' => '',
                'link' => 'itt',
            ],
        ],

        'info' => [
            'description' => 'Leírás',
            'genre' => 'Műfaj',
            'language' => 'Nyelv',
            'no_scores' => 'Az adatok még számítás alatt...',
            'points-of-failure' => 'Kibukási Alkalmak',
            'source' => 'Forrás',
            'success-rate' => 'Teljesítési arány',
            'tags' => 'Címkék',
            'unranked' => 'Rangsorolatlan beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'elérve: :when',
            'country' => 'Országos Ranglista',
            'friend' => 'Baráti Ranglista',
            'global' => 'Globális Ranglista',
            'supporter-link' => 'Kattints <a href=":link">ide</a>,hogy megtekinthesd azt a sok jó funkciót amit kaphatsz!',
            'supporter-only' => 'Támogató kell legyél, hogy elérd a baráti és az országos ranglistát!',
            'title' => 'Eredménylista',

            'headers' => [
                'accuracy' => 'Pontosság',
                'combo' => 'Legmagasabb kombó',
                'miss' => 'Miss',
                'mods' => 'Modok',
                'player' => 'Játékos',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Összpontszám',
                'score' => 'Pontszám',
            ],

            'no_scores' => [
                'country' => 'Senki sem ért még el eredményt az országodból ezen a map-en!',
                'friend' => 'Senki sem ért még el eredményt a barátaid közül ezen a map-en!',
                'global' => 'Egyetlen eredmény sincs. Esetleg megpróbálhatnál szerezni párat?',
                'loading' => 'Eredmények betöltése...',
                'unranked' => 'Rangsorolatlan beatmap.',
            ],
            'score' => [
                'first' => 'Az élen',
                'own' => 'A legjobbad',
            ],
        ],

        'stats' => [
            'cs' => 'Kör nagyság',
            'cs-mania' => 'Billentyűk száma',
            'drain' => 'HP Vesztés',
            'accuracy' => 'Pontosság',
            'ar' => 'Közelítési sebesség',
            'stars' => 'Nehézség',
            'total_length' => 'Hossz',
            'bpm' => 'BPM',
            'count_circles' => 'Körök Száma',
            'count_sliders' => 'Sliderek Száma',
            'user-rating' => 'Felhasználói Értékelés',
            'rating-spread' => 'Értékelési Szórás',
            'nominations' => 'Nominálások',
            'playcount' => 'Játékszám',
        ],

        'status' => [
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];
