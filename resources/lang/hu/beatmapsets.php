<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ez a beatmap jelenleg nem letölthető.',
        'parts-removed' => 'Ez a beatmap eltávolításra került a készítő vagy egy jogbirtokos harmadik fél kérésére.',
        'more-info' => 'Itt találsz több információt.',
        'rule_violation' => 'Ennek a map-nek néhány elemét eltávolítottuk, mert nem találtuk őket megfelelőnek az osu!-ban történő használathoz.',
    ],

    'download' => [
        'limit_exceeded' => 'Lassíts le, játssz többet.',
    ],

    'featured_artist_badge' => [
        'label' => 'Kiemelt előadó',
    ],

    'index' => [
        'title' => 'Beatmap lista',
        'guest_title' => 'Beatmap-ek',
    ],

    'panel' => [
        'empty' => 'nincs beatmap',

        'download' => [
            'all' => 'letöltés',
            'video' => 'letöltés videóval',
            'no_video' => 'letöltés videó nélkül',
            'direct' => 'megnyitás osu!direct-ben',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Egy hibrid beatmap szettet legalább egy játékmódra nominálni kell.',
        'incorrect_mode' => 'Nincs jogosultságod :mode módban nominálni',
        'full_bn_required' => 'Teljes jogú nominátornak kell lenned a kvalifikálásra nomináláshoz.',
        'too_many' => 'A nominálási követelmények már teljesültek.',

        'dialog' => [
            'confirmation' => 'Biztosan nominálni szeretnéd ezt a Beatmap-et?',
            'header' => 'Beatmap Nominálása',
            'hybrid_warning' => 'megjegyzés: csak egyszer nominálhatsz, ezért kérlek győződj meg róla, hogy minden játékmódra nominálsz, amire szeretnél',
            'which_modes' => 'Mely módokra nominálsz?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Felnőtt',
    ],

    'show' => [
        'discussion' => 'Beszélgetés',

        'details' => [
            'by_artist' => ':artist által',
            'favourite' => 'A beatmap kedvencek közé tétele',
            'favourite_login' => 'Jelentkezz be, hogy kedvencnek jelölt ezt beatmap-et',
            'logged-out' => 'Beatmapek letöltéshez be kell jelentkezned!',
            'mapped_by' => 'mappolva :mapper által',
            'unfavourite' => 'Beatmap eltávolitása a kedvencek közül',
            'updated_timeago' => 'utóljára frissítve: :timeago',

            'download' => [
                '_' => 'Letöltés',
                'direct' => '',
                'no-video' => 'Videó nélkül',
                'video' => 'Videóval',
            ],

            'login_required' => [
                'bottom' => 'további funkciók eléréséhez',
                'top' => 'Bejelentkezés',
            ],
        ],

        'details_date' => [
            'approved' => 'jóváhagyva: :timeago',
            'loved' => 'szerette: :timeago',
            'qualified' => 'kvalifikálva: :timeago',
            'ranked' => 'rangsorolva: :timeago',
            'submitted' => 'beküldve: :timeago',
            'updated' => 'utolsó frissítés: :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Túl sok beatmap van a kedvenceid között! Kérlek távolíts el néhányat az újrapróbálkozás előtt.',
        ],

        'hype' => [
            'action' => 'Hype-old a beatmapet ha élvezted rajta a játékot, hogy segíthesd a <strong>Rangsorolt</strong> állapot felé jutásban.',

            'current' => [
                '_' => 'Ez a map :status jelenleg.',

                'status' => [
                    'pending' => 'függőben',
                    'qualified' => 'kvalifikált',
                    'wip' => 'munkálatok alatt',
                ],
            ],

            'disqualify' => [
                '_' => 'Ha találsz javaslatokat, problémákat a térképpel kapcsolatban, kérlek diszkvalifikáld ezen a linken keresztül: :link',
            ],

            'report' => [
                '_' => 'Ha találsz javaslatokat, problémákat a térképpel kapcsolatban, kérlek jelentsd az alábbi linken keresztül: :link',
                'button' => 'Probléma jelentése',
                'link' => 'itt',
            ],
        ],

        'info' => [
            'description' => 'Leírás',
            'genre' => 'Műfaj',
            'language' => 'Nyelv',
            'no_scores' => 'Az adatok még számítás alatt...',
            'nsfw' => 'Felnőtt tartalom',
            'points-of-failure' => 'Kibukási Alkalmak',
            'source' => 'Forrás',
            'storyboard' => 'Ez a beatmap storyboard-ot tartalmaz',
            'success-rate' => 'Teljesítési arány',
            'tags' => 'Címkék',
            'video' => 'Ez a beatmap videót tartalmaz',
        ],

        'nsfw_warning' => [
            'details' => 'Ez a beatmap szókimondó, sértő vagy felkavaró tartalmú. Továbbra is meg szeretnéd tekinteni?',
            'title' => 'Felnőtt tartalom',

            'buttons' => [
                'disable' => 'Figyelmeztetés kikapcsolása',
                'listing' => 'Beatmap lista',
                'show' => 'Mutassa',
            ],
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
                'pin' => '',
                'player' => 'Játékos',
                'pp' => '',
                'rank' => 'Rang',
                'score' => 'Pontszám',
                'score_total' => 'Összpontszám',
                'time' => 'Idő',
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
            'ranked' => 'Rangsorolt',
            'approved' => 'Jóváhagyott',
            'loved' => 'Szeretett',
            'qualified' => 'Kvalifikálva',
            'wip' => 'Készítés alatt',
            'pending' => 'Függőben',
            'graveyard' => 'Temető',
        ],
    ],
];
