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
    'pinned_topics' => 'Kitűzött Témák',
    'slogan' => "egyedül játszani veszélyes.",
    'subforums' => 'Mellékfórumok',
    'title' => 'osu! fórumok',

    'covers' => [
        'edit' => 'Borító szerkesztése',

        'create' => [
            '_' => 'Borítókép megadása',
            'button' => 'Kép feltöltése',
            'info' => 'A boritókép mérete :dimensions kell hogy legyen. A kép feltöltését idehúzással is megteheted.',
        ],

        'destroy' => [
            '_' => 'Boritókép eltávolítása',
            'confirm' => 'Biztos vagy benne, hogy el szeretnéd távolitani a boritóképet?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Legújabb Poszt',

        'index' => [
            'title' => 'Fórum Index',
        ],

        'topics' => [
            'empty' => 'Nincsenek témák!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Fórum megjelölése olvasottként',
        'forums' => 'Fórumok megjelölése olvasottként',
        'busy' => 'Olvasottnak jelölés...',
    ],

    'post' => [
        'confirm_destroy' => 'Biztosan törlöd a posztot?',
        'confirm_restore' => 'Biztosan visszaállítod a posztot?',
        'edited' => 'Utoljára módosítva :user által :when, módosítva :count alkalommal.',
        'posted_at' => 'posztolva :when',

        'actions' => [
            'destroy' => 'Poszt törlése',
            'restore' => 'Poszt visszaállítása',
            'edit' => 'Poszt szerkesztése',
        ],

        'create' => [
            'title' => [
                'reply' => 'Új válasz',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited poszt|-:count_delimited poszt',
            'topic_starter' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ugrás a poszthoz',
        'post_number_input' => 'írd be a poszt számát',
        'total_posts' => ':posts_count posztok száma',
    ],

    'topic' => [
        'deleted' => 'törölt téma',
        'go_to_latest' => 'utolsó poszt megtekintése',
        'latest_post' => ':when :user által',
        'latest_reply_by' => 'legutóbbi hozzászólás: :user',
        'new_topic' => 'Új téma',
        'new_topic_login' => 'Jelentkezz be új téma nyitásához',
        'post_reply' => 'Poszt',
        'reply_box_placeholder' => 'Ide írj a válaszoláshoz',
        'reply_title_prefix' => 'Válasz',
        'started_by' => ':user által',
        'started_by_verbose' => ':user által indítva',

        'create' => [
            'close' => 'Bezár',
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
                'title' => 'Kattints ide a cím megadásához',
            ],
        ],

        'jump' => [
            'enter' => 'specifikus poszt szám megadásához kattints ide',
            'first' => 'ugrás az első poszthoz',
            'last' => 'ugrás az utolsó poszthoz',
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
            'title_compact' => 'fórum feliratkozások',

            'box' => [
                'total' => 'Követett témák',
                'unread' => 'Témák új válaszokkal',
            ],

            'info' => [
                'total' => ':total témára vagy feliratkozva.',
                'unread' => ':unread választ nem olvastál el a követett témáidban.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Leiratkozol a témáról?',
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
            'create_poll' => 'Szavazás Létrehozása',

            'preview' => 'Poszt előnézet',

            'create_poll_button' => [
                'add' => 'Szavazás létrehozása',
                'remove' => 'Szavazás létrehozásának megszakítása',
            ],

            'poll' => [
                'hide_results' => 'A szavazás eredményeinek elrejtése.',
                'hide_results_info' => 'Csak a szavazás vége után fognak megjelenni.',
                'length' => 'Szavazás futtatása',
                'length_days_suffix' => 'nap',
                'length_info' => 'Hagyja üresen a soha véget nem érő szavazást',
                'max_options' => 'Felhasználónkénti beállítások',
                'max_options_info' => 'Ez a szám mutatja mennyi lehetőséget választhat egy felhasználó.',
                'options' => 'Beállítások',
                'options_info' => 'Minden opció kerüljön új sorba. 10 opciót lehet megadni.',
                'title' => 'Kérdés',
                'vote_change' => 'Újraszavazás engedélyezése.',
                'vote_change_info' => 'Ha engedélyezve van, a felhasználók változtathatják a szavazatukat.',
            ],
        ],

        'edit_title' => [
            'start' => 'Cím szerkesztése',
        ],

        'index' => [
            'feature_votes' => 'csillagos prioritás',
            'replies' => 'válaszok',
            'views' => 'megtekintések',
        ],

        'issue_tag_added' => [
            'to_0' => '"added" címke eltávolítása',
            'to_0_done' => '"added" címke eltávolítva',
            'to_1' => '“added” címke hozzáadása',
            'to_1_done' => '“added” címke hozzáadva',
        ],

        'issue_tag_assigned' => [
            'to_0' => '“assigned” címke eltávolítása',
            'to_0_done' => '“assigned” címke eltávolítva',
            'to_1' => '“assigned” címke hozzáadása',
            'to_1_done' => '“assigned” címke hozzáadva',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '“confirmed” címke eltávolítása',
            'to_0_done' => '“confirmed” címke eltávolítva',
            'to_1' => '“confirmed” címke hozzáadása',
            'to_1_done' => '“confirmed” címke hozzáadva',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '“duplicate” címke eltávolítása',
            'to_0_done' => '“duplicate” címke eltávolítva',
            'to_1' => '“duplicate” címke hozzáadása',
            'to_1_done' => '“duplicate” címke hozzáadva',
        ],

        'issue_tag_invalid' => [
            'to_0' => '“invalid” címke eltávolítása',
            'to_0_done' => '“invalid” címke eltávolítva',
            'to_1' => '“invalid” címke hozzáadása',
            'to_1_done' => '“invalid” címke hozzáadva',
        ],

        'issue_tag_resolved' => [
            'to_0' => '“resolved” címke eltávolítása',
            'to_0_done' => '“resolved” címke eltávolítva',
            'to_1' => '“resolved” címke hozzáadása',
            'to_1_done' => '“resolved” címke hozzáadva',
        ],

        'lock' => [
            'is_locked' => 'Ez a téma zárva van és nem lehet rá válaszolni',
            'to_0' => 'Téma feloldása',
            'to_0_done' => 'A téma fel lett oldva',
            'to_1' => 'Téma zárolása',
            'to_1_done' => 'A téma zárolva lett',
        ],

        'moderate_move' => [
            'title' => 'Másik fórumba áthelyezés',
        ],

        'moderate_pin' => [
            'to_0' => 'Téma kitűzésének visszavonása',
            'to_0_done' => 'A téma kitűzése visszavonva',
            'to_1' => 'Téma kitűzése',
            'to_1_done' => 'A téma ki lett tűzve',
            'to_2' => 'Téma kitűzése és bejelentésnek jelölése',
            'to_2_done' => 'Téma kitűzve és bejelentésnek jelölve',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => 'Törölt posztok',
            'total_posts' => 'Összes poszt',

            'feature_vote' => [
                'current' => 'Jelenlegi prioritás: +:count',
                'do' => 'Kérés promotálása',

                'info' => [
                    '_' => 'Ez egy :feature_request. A funkciókérések felszavazhatóak :supporters által.',
                    'feature_request' => 'funkciókérés',
                    'supporters' => 'támogatók',
                ],

                'user' => [
                    'count' => '{0} nincs szavazat|{1} :count szavazat|[2,*] :count szavazat',
                    'current' => 'Neked :votes darab szavazatod maradt.',
                    'not_enough' => "Nincs több szavazatod",
                ],
            ],

            'poll' => [
                'edit' => 'Szavazás Szerkesztése',
                'edit_warning' => 'A szavazás szerkesztése eltörli a jelenlegi eredményeket!',
                'vote' => 'Szavazat',

                'button' => [
                    'change_vote' => '',
                    'edit' => 'Kérdőív szerkesztése',
                    'view_results' => '',
                    'vote' => 'Szavaz',
                ],

                'detail' => [
                    'end_time' => 'Szavazás vége :time -kor lesz',
                    'ended' => 'Szavazás végetért :time -kor',
                    'results_hidden' => 'Az eredmények a szavazás vége után jelennek meg.',
                    'total' => 'Leadott szavazatok száma :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nincs könyvjelzőnek állítva',
            'to_watching' => 'Könyvjelző',
            'to_watching_mail' => 'Könyvjelző értesítéssel',
            'tooltip_mail_disable' => 'Értesítés engedélyezve van. Ide kattintva letilthatod',
            'tooltip_mail_enable' => 'Értesítés le van tiltva. Ide kattintva engedélyezheted',
        ],
    ],
];
