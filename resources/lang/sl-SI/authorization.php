<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '',
    'require_login' => 'Za nadaljevanje se morate prijaviti.',
    'require_verification' => '',
    'restricted' => "Tega ni mogoče izvesti, ker ste omejeni.",
    'silenced' => "Tega ni mogoče izvesti, ker ste utišani.",
    'unauthorized' => 'Dostop zavrnjen.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Ni možno zmanjšati pričakovanja.',
            'has_reply' => 'Ni možno izbrisati razprave z odgovori',
        ],
        'nominate' => [
            'exhausted' => 'Dosegli ste svojo dnevno omejitev nominacij. Prosimo, poskusite zopet jutri.',
            'incorrect_state' => 'Pri izvajanju tega dejanja je prišlo do napake. Poskusite osvežiti stran.',
            'owner' => "Ne morete nominirati lastnega beatmapa.",
            'set_metadata' => '',
        ],
        'resolve' => [
            'not_owner' => 'Samo stvaritelj teme in lastnik beatmapa lahko skleneta razpravo.',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'bot' => "",
            'limit_exceeded' => 'Prosimo, počakajte nekaj časa, preden glasujete naprej',
            'owner' => "Ne morete glasovati na lastni razpravi.",
            'wrong_beatmapset_state' => 'Glasuje se lahko samo na razpravah nepotrjenih beatmapov.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Samo avtor lahko ureja objavo.',
            'resolved' => '',
            'system_generated' => 'Samodejno generirane objave ni mogoče urejati.',
        ],

        'store' => [
            'beatmapset_locked' => '',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '',
        ],
    ],

    'chat' => [
        'blocked' => '',
        'friends_only' => '',
        'moderated' => '',
        'no_access' => '',
        'restricted' => '',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "",
        ],
    ],

    'contest' => [
        'voting_over' => 'Ne morete spremeniti glasu, potem ko se je glasovanje za to tekmovanje končalo.',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Samo zadnjo objavo je možno izbrisati.',
                'locked' => 'Ni možno izbrisati objave v zaklenjeni temi.',
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
                'not_owner' => 'Samo avtor lahko izbriše objavo.',
            ],

            'edit' => [
                'deleted' => 'Izbrisane objave ni možno urejati.',
                'locked' => 'Objava je zaščitena proti urejanju.',
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
                'not_owner' => 'Samo avtor lahko ureja objavo.',
                'topic_locked' => 'Ni mogoče urejati objave v zaklenjeni temi.',
            ],

            'store' => [
                'play_more' => 'Prosimo, da najprej igrate igro in šele nato pišete v forume! Če imate težave z igro, nam pišite v forum Help and Support.',
                'too_many_help_posts' => "Preden lahko naprej objavljate, morate igrati igro. Če imate težave z igranjem, nam pišite na e-poštni naslov support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '',
                'locked' => 'Ni možno odgovoriti v zaklenjeni temi.',
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
                'no_permission' => 'Ni dovoljenja za odgovarjanje.',

                'user' => [
                    'require_login' => 'Če hočete odgovoriti, se prijavite.',
                    'restricted' => "Ni možno odgovoriti, ker ste omejeni.",
                    'silenced' => "Ni možno odgovoriti, ker ste utišani.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
                'no_permission' => 'Ni dovoljenja za ustvarjanje nove teme.',
                'forum_closed' => 'Forum je zaprt, zato objavljanje vanj ni možno.',
            ],

            'vote' => [
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
                'over' => 'Glasovanje je končano, zato na njem ni več mogoče glasovati.',
                'play_more' => '',
                'voted' => 'Spreminjanje glasu ni dovoljeno.',

                'user' => [
                    'require_login' => 'Za glasovanje se morate prijaviti.',
                    'restricted' => "Ni možno glasovati, ker ste omejeni.",
                    'silenced' => "Ni možno glasovati, ker ste utišani.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Zahtevan je dostop do željenega foruma.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Določena je bila neveljavna naslovnica.',
                'not_owner' => 'Samo lastnik lahko ureja naslovnico.',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => 'Samo administrator si lahko ogleda ta forum.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uporabniška stran je zaklenjena.',
                'not_owner' => 'Možno je urejati le lastno uporabniško stran.',
                'require_supporter_tag' => '',
            ],
        ],
    ],
];
