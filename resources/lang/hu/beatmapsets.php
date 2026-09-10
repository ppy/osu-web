<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ez a beatmap jelenleg nem letölthető.',
        'parts-removed' => 'Ez a beatmap eltávolításra került a készítő, vagy egy jogbirtokos harmadik fél kérésére.',
        'more-info' => 'Itt találsz több információt.',
        'rule_violation' => 'Ennek a map-nek néhány elemét eltávolítottuk, mert nem találtuk őket megfelelőnek az osu!-ban történő használathoz.',
    ],

    'cover' => [
        'deleted' => 'Beatmap törölve',
    ],

    'download' => [
        'limit_exceeded' => 'Lassíts le, játssz többet.',
        'no_mirrors' => 'Nem érhető el letöltés kiszolgáló.',
    ],

    'featured_artist_badge' => [
        'label' => 'Kiemelt Előadó',
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
        'bng_limited_too_many_rulesets' => 'A próbaidős nominálók nem nominálhatnak több játékmódban.',
        'full_nomination_required' => 'Teljes nominálónak kell lennie a játékmód végső nominálásának végrehajtásához.',
        'hybrid_requires_modes' => 'Egy hibrid beatmap szettet legalább egy játékmódra nominálni kell.',
        'incorrect_mode' => 'Nincs jogosultságod :mode módban nominálni',
        'invalid_limited_nomination' => 'Ez a beatmap érvénytelen nominálásokkal rendelkezik, és ebben az állapotban nem kvalifikálható.',
        'invalid_ruleset' => 'Ez a nomináció érvénytelen játékmódokat tartalmaz.',
        'too_many' => 'A nominálási követelmények már teljesültek.',
        'too_many_non_main_ruleset' => 'Nomináció kötelezettség a nem fő játékmódra már teljesítve van.',

        'dialog' => [
            'confirmation' => 'Biztosan nominálni szeretnéd ezt a Beatmap-et?',
            'different_nominator_warning' => 'A beatmap kvalifikálása különbözű nominálókkal a kvalifikálási várólístai helyének visszaállításával jár.',
            'header' => 'Beatmap Nominálása',
            'hybrid_warning' => 'megjegyzés: csak egyszer nominálhatsz, ezért kérlek győződj meg róla, hogy minden játékmódra nominálsz, amire szeretnél',
            'current_main_ruleset' => 'A fő játékmód jelenleg: :ruleset',
            'which_modes' => 'Mely módokra nominálsz?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Felnőtt',
    ],

    'rate' => [
        'invalid' => '',
    ],

    'show' => [
        'discussion' => 'Beszélgetés',

        'admin' => [
            'full_size_cover' => 'Teljes borítókép megtekintése',
            'page' => 'Admin oldal megtekintése',
        ],

        'deleted_banner' => [
            'title' => 'Ez a beatmap törlésre került.',
            'message' => '(ezt csak a moderátorok láthatják)',
        ],

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'A beatmap kedvencek közé tétele',
            'favourite_login' => 'Jelentkezz be, hogy kedvencnek jelölt ezt beatmap-et',
            'logged-out' => 'beatmapek letöltéséhez be kell jelentkezned!',
            'mapped_by' => 'mappolva :mapper által',
            'mapped_by_guest' => 'vendég nehézséget készítette: :mapper',
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
            'loved' => 'loved: :timeago',
            'qualified' => 'kvalifikálva: :timeago',
            'ranked' => 'rangsorolva: :timeago',
            'submitted' => 'beküldve: :timeago',
            'updated' => 'utoljára frissítve: :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Túl sok beatmap van a kedvenceid között! Kérlek távolíts el néhányat az újrapróbálkozás előtt.',
        ],

        'hype' => [
            'action' => 'Hype-old a beatmapet ha tetszett, hogy segíthesd a <strong>Rangsorolt</strong> állapot felé jutásban.',

            'current' => [
                '_' => 'Ez a map jelenleg :status.',

                'status' => [
                    'pending' => 'függőben',
                    'qualified' => 'kvalifikált',
                    'wip' => 'munkálatok alatt',
                ],
            ],

            'disqualify' => [
                '_' => 'Ha találsz javaslatokat, problémákat a beatmappel kapcsolatban, kérlek diszkvalifikáld :link.',
            ],

            'report' => [
                '_' => 'Ha találsz javaslatokat, problémákat a beatmappel kapcsolatban, kérlek jelentsd :link.',
                'button' => 'Probléma jelentése',
                'link' => 'itt',
            ],
        ],

        'info' => [
            'description' => 'Leírás',
            'genre' => 'Műfaj',
            'language' => 'Nyelv',
            'mapper_tags' => 'Mapper Címkék',
            'no_scores' => 'Az adatok még számítás alatt...',
            'nominators' => 'Nominálók',
            'nsfw' => 'Felnőtt tartalom',
            'offset' => 'Online eltolás',
            'pack_tags' => 'Beatmap Csomagok',
            'points-of-failure' => 'Elbukási Időpontok',
            'source' => 'Forrás',
            'storyboard' => 'Ez a beatmap storyboard-ot tartalmaz',
            'success-rate' => 'Teljesítési arány',
            'success_rate_plays' => ':passes / :count_delimited játszás|:passes / :count_delimited játszások',
            'user_tags' => 'Felhasználói Címkék',
            'video' => 'Ez a beatmap videót tartalmaz',
        ],

        'lazer_only' => [
            'title' => 'Lazer Csak',
            'description' => 'Bizonyos mechanikai sajátosságok miatt ez a beatmap kizárólag az osu!lazer módban játszható.',

            'scoreboard_switch_mode' => [
                '_' => ':enable_link az ezen a beatmap-en elért eredmények megtekintéséhez.',
                'enable_link' => 'Engedélyezd a Lazer módot',
            ],
        ],

        'nsfw_warning' => [
            'details' => 'Ez a beatmap szókimondó, sértő vagy felkavaró tartalmú. Továbbra is meg szeretnéd tekinteni?',
            'title' => 'Felnőtt tartalom',

            'buttons' => [
                'disable' => 'Figyelmeztetés kikapcsolása',
                'listing' => 'Beatmap lista',
                'show' => 'Mutatás',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'elérve: :when',
            'country' => 'Országos Ranglista',
            'error' => 'Ranglista betöltése sikertelen',
            'friend' => 'Baráti Ranglista',
            'global' => 'Globális Ranglista',
            'supporter-link' => 'Kattints <a href=":link">ide</a>, hogy megtekintsd a sok menő funkciót, amit kaphatsz!',
            'supporter-only' => 'Támogató kell legyél, hogy elérd a baráti és az országos ranglistát!',
            'team' => 'Csapat Rangsorolás',
            'title' => 'Eredménylista',

            'headers' => [
                'accuracy' => 'Pontosság',
                'combo' => 'Max Kombó',
                'miss' => 'Miss',
                'mods' => 'Modok',
                'pin' => 'Rögzítés',
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
                'team' => 'A csapatodból még senki sem ért el pontszámot ezen a pályán!',
                'unranked' => 'Rangsorolatlan beatmap.',
            ],
            'score' => [
                'first' => 'Az élen',
                'own' => 'A legjobbad',
            ],
            'supporter_link' => [
                '_' => 'Kattints :here, hogy megtekintsd a sok menő funkciót, amit kaphatsz!',
                'here' => 'ide',
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
            'offset' => 'Online eltolás: :offset',
            'user-rating' => 'Felhasználói Értékelés',
            'rating-spread' => 'Értékelési Szórás',
            'nominations' => 'Nominálások',
            'playcount' => 'Játékszám',
            'favourites' => 'Kedvencek',
            'no_favourites' => 'Nincsenek kedvencek még',
        ],

        'status' => [
            'ranked' => 'Rangsorolt',
            'approved' => 'Jóváhagyott',
            'loved' => 'Loved',
            'qualified' => 'Kvalifikálva',
            'wip' => 'Készítés alatt',
            'pending' => 'Függőben',
            'graveyard' => 'Temető',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Reflektorfény',
    ],
];
