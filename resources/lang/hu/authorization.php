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
    'require_login' => 'Kérlek jelentkezz be a folytatáshoz.',
    'require_verification' => '',
    'restricted' => "Felfüggesztett állapotban erre nem vagy képes.",
    'silenced' => "Némított állapotban erre nem vagy képes.",
    'unauthorized' => 'Hozzáférés megtagadva.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'A hype-olást nem lehet visszavonni.',
            'has_reply' => 'Nem lehet hozzászólásokkal rendelkező beszélgetést törölni',
        ],
        'nominate' => [
            'exhausted' => 'Elérted a napi ajánlási limited, próbáld újra holnap.',
            'full_bn_required' => 'Teljes jogú nominátornak kell lenned a kvalifikálásra nomináláshoz.',
            'full_bn_required_hybrid' => 'Teljes jogú nominátornak kell lenned a több játékmódot tartalmazó beatmapszettek nominálásához.',
            'incorrect_state' => 'Hiba történt a művelet végrehajtása közben, próbáld frissíteni az oldalt.',
            'owner' => "Saját beatmap-et nem lehet ajánlani.",
        ],
        'resolve' => [
            'not_owner' => 'Csak a poszt szerzője és a beatmap készítője tudja megoldottnak jelölni az adott problémát.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Csak a beatmap tulajdonos vagy jelölő/QAT csoporttag posztolhat készítői megjegyzést.',
        ],

        'vote' => [
            'limit_exceeded' => 'Kérlek várj egy keveset újabb szavazat leadása előtt',
            'owner' => "Nem szavazhatsz a saját posztodra.",
            'wrong_beatmapset_state' => 'Csak függő beatmap beszélgetéseken lehet szavazni.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Csak a saját posztjaidat tudod törölni.',
            'resolved' => '',
            'system_generated' => 'Az automatikusan generált posztok nem törölhetőek.',
        ],

        'edit' => [
            'not_owner' => 'Csak a posztoló tudja szerkeszteni a posztot.',
            'resolved' => '',
            'system_generated' => 'Automatikusan generált posztot nem lehet szerkeszteni.',
        ],

        'store' => [
            'beatmapset_locked' => 'Ez a beatmap megbeszélés miatt zárolva.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nem küldhetsz üzenetet olyan felhasználónak akiket letiltottál, vagy téged tiltottak le.',
        'friends_only' => 'A felhasználó letiltotta a baráti listáján nem szereplő emberek üzeneteinek fogadását.',
        'moderated' => 'A csatorna jelenleg moderálva van.',
        'no_access' => 'Nincs hozzáférésed a csatornához.',
        'restricted' => 'Nem küldhetsz üzeneteket némított, felfüggesztett vagy kitiltott állapotban.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Törölt posztot nem lehet szerkeszteni.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Nem változtathatod meg a szavazatod, mert ennek a versenynek a szavazási ideje lejárt.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nincs engedélyed ennek a fórumnak a moderálására.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Csak az utolsó posztot lehet törölni.',
                'locked' => 'Lezárt téma posztját nem lehet törölni.',
                'no_forum_access' => 'A kért fórumhoz hozzáférési jog szükséges.',
                'not_owner' => 'Csak a szerző törölheti a posztot.',
            ],

            'edit' => [
                'deleted' => 'Törölt posztot nem lehet szerkeszteni.',
                'locked' => 'A posztot nem lehet szerkeszteni.',
                'no_forum_access' => 'A kért fórumhoz hozzáférési jog szükséges.',
                'not_owner' => 'Csak a szerző szerkesztheti a posztot.',
                'topic_locked' => 'Lezárt téma posztját nem lehet szerkeszteni.',
            ],

            'store' => [
                'play_more' => 'Kérlek próbáld ki a játékot mielőtt a fórumra posztolnál! Ha valami problémád merül fel játék közben, kérlek írj egy posztot a "Help" vagy a "Support" fórumra.',
                'too_many_help_posts' => "Többet kell játszanod a játékkal további posztolás előtt. Ha még mindig nehézségeid merülnek fel a játék kapcsán, írj egy e-mailt erre a címre: support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Kérlek módosítsd az utolsó posztodat az újraposztolás helyett.',
                'locked' => 'Nem lehet válaszolni egy lezárt témára.',
                'no_forum_access' => 'A kért fórumra belépési engedély szükséges.',
                'no_permission' => 'Nincs jogosultságod válaszolni.',

                'user' => [
                    'require_login' => 'Kérlek jelentkezz be, hogy válaszolni tudj.',
                    'restricted' => "Nem válaszolhatsz felfüggesztett állapotban.",
                    'silenced' => "Nem válaszolhatsz némított állapotban.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'A kért fórumhoz hozzáférési jog szükséges.',
                'no_permission' => 'Nincs engedélyed új téma létrehozására.',
                'forum_closed' => 'A fórum le van zárva, és nem lehet posztolni bele.',
            ],

            'vote' => [
                'no_forum_access' => 'A kért fórumhoz hozzáférési jog szükséges.',
                'over' => 'A szavazás lejárt, és többé nem szavazhatsz rá.',
                'play_more' => 'Többet kell játszanod mielőtt szavazhatnál a fórumon.',
                'voted' => 'A szavazat megváltoztatása nem engedélyezett.',

                'user' => [
                    'require_login' => 'Kérlek jelentkezz be, hogy tudj szavazni.',
                    'restricted' => "Nem szavazhatsz felfüggesztett állapotban.",
                    'silenced' => "Nem szavazhatsz némított állapotban.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'A kért fórumhoz hozzáférési jog szükséges.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Érvénytelen borítót adtál meg.',
                'not_owner' => 'Csak a szerző változtathatja a borítót.',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => 'Csak admin láthatja ezt a fórumot.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Felhasználói oldal lezárva.',
                'not_owner' => 'Csak a saját felhasználói oldaladat szerkesztheted.',
                'require_supporter_tag' => 'osu!támogatói cím szükséges.',
            ],
        ],
    ],
];
