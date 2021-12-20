<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mit szólsz ahhoz, hogy ha egy kis osu!-t játszanál inkább?',
    'require_login' => 'Kérlek jelentkezz be a folytatáshoz.',
    'require_verification' => 'Kérlek, hagyd jóvá a folytatáshoz.',
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
            'incorrect_state' => 'Hiba történt a művelet végrehajtása közben, próbáld frissíteni az oldalt.',
            'owner' => "Saját beatmap-et nem lehet ajánlani.",
            'set_metadata' => 'Mielőtt kijelölné, a műfajt és a nyelvet meg kell adnod',
        ],
        'resolve' => [
            'not_owner' => 'Csak a gondolatmenet kezdője és a beatmap tulajdonosa tudja megoldottnak jelölni az adott problémát.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Csak a beatmap tulajdonos vagy jelölő/QAT csoporttag posztolhat készítői megjegyzést.',
        ],

        'vote' => [
            'bot' => "A bot által létrehozott megbszélésre nem szavazhatsz",
            'limit_exceeded' => 'Kérlek várj egy keveset újabb szavazat leadása előtt',
            'owner' => "Nem szavazhatsz a saját posztodra.",
            'wrong_beatmapset_state' => 'Csak függő beatmap beszélgetéseken lehet szavazni.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Csak a saját hozzászólásaidat tudod törölni.',
            'resolved' => 'Nem törölhetsz bejegyzést egy megbeszélt témában.',
            'system_generated' => 'Az automatikusan létrehozott hozzászólások nem törölhetőek.',
        ],

        'edit' => [
            'not_owner' => 'Csak a posztoló tudja szerkeszteni a posztot.',
            'resolved' => 'Nem szerkeszthetsz bejegyzést egy megbeszélt témában.',
            'system_generated' => 'Automatikusan generált posztot nem lehet szerkeszteni.',
        ],

        'store' => [
            'beatmapset_locked' => 'Ez a beatmap megbeszélés miatt zárolva.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Nem változtathatod meg egy nominált map metaadatait. Ha úgy gondolod valami nincs rendben, lépj kapcsolatba egy BN vagy egy NAT taggal.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nem küldhetsz üzenetet olyan felhasználónak akiket letiltottál, vagy téged tiltottak le.',
        'friends_only' => 'A felhasználó letiltotta a baráti listáján nem szereplő emberek üzeneteinek fogadását.',
        'moderated' => 'A csatorna jelenleg moderálva van.',
        'no_access' => 'Nincs hozzáférésed a csatornához.',
        'restricted' => 'Nem küldhetsz üzeneteket némított, felfüggesztett vagy kitiltott állapotban.',
        'silenced' => 'Némítva, felfüggesztve vagy kitiltva nem küldhetsz üzeneteket.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Törölt posztot nem lehet szerkeszteni.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Nem változtathatod meg a szavazatod, mert ennek a versenynek a szavazási ideje lejárt.',

        'entry' => [
            'limit_reached' => 'Elérted a jelentkezési limited erre a versenyre',
            'over' => 'Köszönjük a jelentkezéseidet! A beküldési lehetőség lezárult erre a versenyre és a szavazás hamarosan indul.',
        ],
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
                'forum_not_allowed' => 'Ez a fórum nem fogad téma fejléceket.',
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
