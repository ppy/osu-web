<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'pinned_topics' => 'Kitűzött Témák',
    'slogan' => "egyedül játszani veszélyes.",
    'subforums' => 'Mellékfórum',
    'title' => 'osu! fórumok',

    'covers' => [
        'create' => [
            '_' => 'Boritókép beállitása',
            'button' => 'Kép feltöltése',
            'info' => 'A boritó mérete :dimensions kell, hogy legyen.A kép feltöltését idehúzással is megteheted.',
        ],

        'destroy' => [
            '_' => 'Boritókép eltávolítása',
            'confirm' => 'Biztos vagy benne, hogy el szeretnéd távolitani a boritóképet?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Új válasz a ":title" témában',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Nincs téma!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Biztosan törlöd a posztot?',
        'confirm_restore' => 'Biztosan visszaállitod a posztot?',
        'edited' => 'Utoljára módosítva :user által :when, módosítva :count alkalommal.',
        'posted_at' => 'posztolva :when',

        'actions' => [
            'destroy' => 'Poszt törlése',
            'restore' => 'Poszt helyreállítása',
            'edit' => 'Poszt szerkesztése',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ugrás a poszthoz',
        'post_number_input' => 'írja be a poszt számát',
        'total_posts' => ':posts_count teljes posztol száma',
    ],

    'topic' => [
        'deleted' => 'törölt téma',
        'go_to_latest' => 'utolsó poszt megtekintése',
        'latest_post' => ':when :user által',
        'latest_reply_by' => 'legutóbbi hozzászólás: :user',
        'new_topic' => 'Új téma posztolása',
        'new_topic_login' => 'Jelentkezz be új téma nyitásához',
        'post_reply' => 'Poszt',
        'reply_box_placeholder' => 'Válasz írásához kattintson ide',
        'reply_title_prefix' => 'Válasz',
        'started_by' => ':user által',
        'started_by_verbose' => ':user által indítva',

        'create' => [
            'preview' => 'Előnézet',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Ír',
            'submit' => 'Küldés',

            'necropost' => [
                'default' => 'Ez a téma már inaktív egy ideje. Megfelelő indok hiányában ne posztolj ide.',

                'new_topic' => [
                    '_' => "Ez a téma már inaktív egy ideje. Ha nincs konkrét okod ide posztolni, kérlek :create helyette.",
                    'create' => 'új téma létrehozása',
                ],
            ],

            'placeholder' => [
                'body' => 'Ide írja a tartalmat',
                'title' => 'Kattintson ide a cím hozzáadásához',
            ],
        ],

        'jump' => [
            'enter' => 'egyedi poszt szám hozzáadásához kattintson ide',
            'first' => 'ugrás első poszthoz',
            'last' => 'ugrás előző poszthoz',
            'next' => '10 poszt átugrása',
            'previous' => 'visszalépni 10 posztot',
        ],

        'post_edit' => [
            'cancel' => 'Mégse',
            'post' => 'Mentés',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Fórum feliratkozások',
            'title_compact' => 'fórum feliratkozások',
            'title_main' => 'Fórum <strong>Feliratkozások</strong>',

            'box' => [
                'total' => 'Felíratkozott témák',
                'unread' => 'Témák új válaszokkal',
            ],

            'info' => [
                'total' => 'Te felíratkoztál :total témára.',
                'unread' => ':unread választ nem olvastál el a felíratkozott témáidban.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Leíratkozol a témáról?',
                'title' => 'Leiratkozás',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Témák',

        'actions' => [
            'login_reply' => 'Jelentkezz be a válaszoláshoz',
            'reply' => 'Válasz',
            'reply_with_quote' => 'Poszt idézése válaszhoz',
            'search' => 'Keresés',
        ],

        'create' => [
            'create_poll' => 'Szavazás készítése',

            'create_poll_button' => [
                'add' => 'Kérdőív létrehozása',
                'remove' => 'Kérdőív létrehozásának megszakítása',
            ],

            'poll' => [
                'length' => 'Szavazás futtatása',
                'length_days_suffix' => 'nap',
                'length_info' => 'Hagyja üresen a soha véget nem érő szavazást',
                'max_options' => 'Felhasználónkénti beállítások',
                'max_options_info' => 'Ez a szám mutatja mennyit szavazhat egy felhasználó.',
                'options' => 'Beállítások',
                'options_info' => 'Minden lehetőséget új sorba írj, 10 lehetőséget is megadhat.',
                'title' => 'Kérdés',
                'vote_change' => 'Újboli szavazás megengedése.',
                'vote_change_info' => 'Ha engedélyezve van, a felhasználók változtathatják a szavazatukat.',
            ],
        ],

        'edit_title' => [
            'start' => 'Cím szerkesztése',
        ],

        'index' => [
            'views' => 'megtekintések',
            'replies' => 'válaszok',
        ],

        'issue_tag_added' => [
            'to_0' => '"Hozzáadott" címke eltávolítása',
            'to_0_done' => '"Hozzáadott" címke eltávolítva',
            'to_1' => '“Added” címke hozzáadása',
            'to_1_done' => '“Added” címke hozzáadva',
        ],

        'issue_tag_assigned' => [
            'to_0' => '“Assigned” címke eltávolítása',
            'to_0_done' => '“Assigned” címke eltávolítva',
            'to_1' => '“Assigned” címke hozzáadása',
            'to_1_done' => '“Assigned” címke hozzáadva',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '“Confirmed” címke eltávolítása',
            'to_0_done' => '“Confirmed” címke eltávolítva',
            'to_1' => '“Confirmed” címke hozzáadása',
            'to_1_done' => '“Confirmed” címke hozzáadva',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '“Duplicate” címke eltávolítása',
            'to_0_done' => '“Duplicate” címke eltávolítva',
            'to_1' => '“Duplicate” címke hozzáadása',
            'to_1_done' => '“Duplicate” címke hozzáadva',
        ],

        'issue_tag_invalid' => [
            'to_0' => '“Invalid” címke eltávolítása',
            'to_0_done' => '“Invalid” címke eltávolítva',
            'to_1' => '“Invalid” címke hozzáadása',
            'to_1_done' => '“Invalid” címke hozzáadva',
        ],

        'issue_tag_resolved' => [
            'to_0' => '“Resolved” címke eltávolítása',
            'to_0_done' => '“Resolved” címke eltávolítva',
            'to_1' => '“Resolved” címke hozzáadása',
            'to_1_done' => '“Resolved” címke hozzáadva',
        ],

        'lock' => [
            'is_locked' => 'Ez a téma zárva van és nem lehet rá válaszolni',
            'to_0' => 'Téma feloldása',
            'to_0_done' => 'A téma fel lett oldva',
            'to_1' => 'Téma lezárása',
            'to_1_done' => 'A téma le lett zárva',
        ],

        'moderate_move' => [
            'title' => 'Másik fórumba áthelyezés',
        ],

        'moderate_pin' => [
            'to_0' => 'Téma kiszögelésének visszavonása',
            'to_0_done' => 'A téma kiszögelésének eltávolítása megtörtént',
            'to_1' => 'Téma kiszögelése',
            'to_1_done' => 'A téma kiszögelése megtörtént',
            'to_2' => 'Téma kiszögelése és bejelentésként kiaállítása',
            'to_2_done' => 'Téma kiszögelvevés bejelentésként kiállítva',
        ],

        'show' => [
            'deleted-posts' => 'Törölt posztok',
            'total_posts' => 'Összes poszt',

            'feature_vote' => [
                'current' => 'Jelenlegi prioritás: +:count',
                'do' => 'Kérés támogatása',

                'user' => [
                    'count' => '{0} nincs szavazat|{1} :count szavazat|[2,*] :count szavazat',
                    'current' => 'Neked :votes darab szavazatod maradt.',
                    'not_enough' => "Nincs több szavazatod",
                ],
            ],

            'poll' => [
                'vote' => 'Szavazat',

                'detail' => [
                    'end_time' => 'Szavazás vége :time -kor lesz',
                    'ended' => 'Szavazás végetért :time -kor',
                    'total' => 'Leadott szavazatok száma :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nincs könyvjelzőnek állítva',
            'to_watching' => 'Könyvjelző',
            'to_watching_mail' => 'Könyvjelző értesítéssel',
            'mail_disable' => 'Értesítések kikapcsolása',
        ],
    ],
];
