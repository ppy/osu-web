<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Kaj raje meniš na igranje osu! igre?',
    'require_login' => 'Za nadaljevanje se morate prijaviti.',
    'require_verification' => 'Preden nadaljuješ, se verificiraj.',
    'restricted' => "Tega ni mogoče izvesti, ker ste omejeni.",
    'silenced' => "Tega ni mogoče izvesti, ker ste utišani.",
    'unauthorized' => 'Dostop zavrnjen.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Ni možno razveljaviti hypanja.',
            'has_reply' => 'Ni možno izbrisati razprave z odgovori',
        ],
        'nominate' => [
            'exhausted' => 'Dosegli ste svojo dnevno omejitev nominacij. Prosimo, poskusite zopet jutri.',
            'incorrect_state' => 'Pri izvajanju tega dejanja je prišlo do napake. Poskusite osvežiti stran.',
            'owner' => "Ne morete nominirati lastnega beatmapa.",
            'set_metadata' => 'Nastavitev žanra in jezika je potrebna pred nominacijo.',
        ],
        'resolve' => [
            'not_owner' => 'Samo stvaritelj teme in lastnik beatmapa lahko skleneta razpravo.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Samo lastnik beatmape ali član nominator/NAT skupine lahko objavi avtorjeve zapiske.',
        ],

        'vote' => [
            'bot' => "Glasovanje na razpravo, ki jo je kreiral robot, ni možno",
            'limit_exceeded' => 'Prosimo, počakajte nekaj časa, preden glasujete naprej',
            'owner' => "Ne morete glasovati na lastni razpravi.",
            'wrong_beatmapset_state' => 'Glasuje se lahko samo na razpravah nepotrjenih beatmapov.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Odstraniš lahko le svoje objave.',
            'resolved' => 'Objavo, ki je bila rešena, ni možno odstraniti.',
            'system_generated' => 'Avtomatsko generirane objave ni možno odstraniti.',
        ],

        'edit' => [
            'not_owner' => 'Samo avtor lahko ureja objavo.',
            'resolved' => 'Objavo, ki je bila rešena, ni možno urejati.',
            'system_generated' => 'Samodejno generirane objave ni mogoče urejati.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Ta beatmapa je zaklenjena za razpravo.',

        'metadata' => [
            'nominated' => 'Urejanje metadata nominirane beatmape ni mogoče. Kontaktiraj člana BN ali NAT če misliš, da je ta narobe nastavljen.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Ta kanal je namenjen za obvestila.',
        'blocked' => 'Ni možno klepetati z igralcem, ki te je blokiral ali si ga ti blokiral.',
        'friends_only' => 'Igralec ima blokirana sporočila od drugih, ki niso na njegovem seznamu prijateljev.',
        'moderated' => 'Ta kanal je trenutno moderiran.',
        'no_access' => 'Nimaš dostopa do tega kanala.',
        'receive_friends_only' => 'Igralec morda ne bo mogel odgovoriti, ker lahko sprejemaš le sporočila od igralcev s seznama prijateljev.',
        'restricted' => 'Ne moreš pošiljati sporočila medtem, ko si utišan, omejen ali suspendiran.',
        'silenced' => 'Ne moreš pošiljati sporočila medtem, ko si utišan, omejen ali suspendiran.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentarji so onemogočeni',
        ],
        'update' => [
            'deleted' => "Izbrisane objave ni možno urejati.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Ne morete spremeniti glasu, potem ko se je glasovanje za to tekmovanje končalo.',

        'entry' => [
            'limit_reached' => 'Dosegel si vstopno omejitev za to tekmovanje',
            'over' => 'Hvala za sodelovanje! Prostor za objave se je zaprl za to tekmovanje in glasovanje se bo kmalu pričelo.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nimaš dovoljenja za moderiranje tega foruma.',
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
                'double_post' => 'Uredi zadnjo objavo namesto kreiranja nove objave.',
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
                'play_more' => 'Potrebno je več igranja, preden lahko glasuješ na forumu.',
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
                'forum_not_allowed' => 'Ta forum ne sprejema ozadij za teme.',
            ],
        ],

        'view' => [
            'admin_only' => 'Samo administrator si lahko ogleda ta forum.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Samo lastnik rezultata lahko pripne rezultat.',
            'too_many' => 'Pripeto je preveč rezultatov.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uporabniška stran je zaklenjena.',
                'not_owner' => 'Možno je urejati le lastno uporabniško stran.',
                'require_supporter_tag' => 'Potrebna je osu!supporter značka.',
            ],
        ],
    ],
];
