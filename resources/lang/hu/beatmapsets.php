<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    'panel' => [
        'download' => [
            'all' => 'letöltés',
            'video' => 'letöltés videóval',
            'no_video' => 'letöltés videó nélkül',
            'direct' => 'megnyitás osu!direct-ben',
        ],
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

        'details_date' => [
            'approved' => 'jóváhagyva: :timeago',
            'loved' => 'kedvelve: :timeago',
            'qualified' => 'kvalifikálva: :timeago',
            'ranked' => 'rangsorolva: :timeago',
            'submitted' => 'beküldve: :timeago',
            'updated' => 'utolsó frissítés: :timeago',
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
            'points-of-failure' => 'Kibukási Alkalmak',
            'source' => 'Forrás',
            'success-rate' => 'Teljesítési arány',
            'tags' => 'Címkék',
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
            'loved' => 'Kedvelve',
            'qualified' => 'Kvalifikálva',
            'wip' => 'Készítés alatt',
            'pending' => 'Függőben',
            'graveyard' => 'Temető',
        ],
    ],
];
