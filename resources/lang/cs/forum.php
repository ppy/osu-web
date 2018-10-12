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
    'pinned_topics' => 'Připnuté témata',
    'slogan' => "je nebezpečné hrát sám.",
    'subforums' => 'Subfóra',
    'title' => 'osu! fóra',

    'covers' => [
        'create' => [
            '_' => 'Přidat titulní obrázek',
            'button' => 'Nahrát obrázek',
            'info' => 'Velikost titulního obrázku by měla mít velikost :dimesions. Obrázek zde také můžete přetáhnout.',
        ],

        'destroy' => [
            '_' => 'Odebrat titulní obrázek',
            'confirm' => 'Jste si jist, že chcete odebrat titulní obrázek?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nová odpověd téma ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Žádná témata!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Opravdu chcete příspěvek odstranit?',
        'confirm_restore' => 'Opravdu chcete příspěvek obnovit?',
        'edited' => 'Naposledy upravil :user :when, celkový počet úprav :count.',
        'posted_at' => 'publikováno :when',

        'actions' => [
            'destroy' => 'Odstranit příspěvek',
            'restore' => 'Obnovit příspěvek',
            'edit' => 'Upravit příspěvek',
        ],
    ],

    'search' => [
        'go_to_post' => 'Přejít na příspěvek',
        'post_number_input' => 'zadejte číslo příspěvku',
        'total_posts' => ':post_count počet příspěvků',
    ],

    'topic' => [
        'deleted' => 'odstraněné téma',
        'go_to_latest' => 'zobrazit nejnovější příspěvek',
        'latest_post' => ':when uživatelem :user',
        'latest_reply_by' => 'poslední odpověd od :user',
        'new_topic' => 'Založit nové téma',
        'new_topic_login' => 'Přihlaš se k vytvoření nového téma',
        'post_reply' => 'Přidat příspěvek',
        'reply_box_placeholder' => 'Pro zodpovězení klikni sem',
        'reply_title_prefix' => 'Re',
        'started_by' => 'od :user',
        'started_by_verbose' => 'započal :user',

        'create' => [
            'preview' => 'Náhled',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Psát',
            'submit' => 'Odeslat',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
                ],
            ],

            'placeholder' => [
                'body' => 'Zde napiš obsah příspěvku',
                'title' => 'Klikni sem pro nastavení názvu',
            ],
        ],

        'jump' => [
            'enter' => 'klikni pro zadání přesného čísla příspěvku',
            'first' => 'přejít na první příspěvek',
            'last' => 'přejít na poslední příspěvek',
            'next' => 'přeskočit 10 příspěvků',
            'previous' => 'vrátit se o 10 příspěvků',
        ],

        'post_edit' => [
            'cancel' => 'Zrušit',
            'post' => 'Uložit',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Sledované příspěvky',
            'title_compact' => 'sledovaná fóra',
            'title_main' => 'Sledované <strong>příspěvky</strong>',

            'box' => [
                'total' => 'Počet sledovaných témat',
                'unread' => 'Témata s novými odpověďmi',
            ],

            'info' => [
                'total' => 'Sledujete :total témat.',
                'unread' => 'Máš :unread nepřečtených odpovědí ve sledovaných tématech.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Přestat sledovat téma?',
                'title' => 'Přestat sledovat',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Témata',

        'actions' => [
            'login_reply' => 'Pro přidání odpovědi se musíte přihlásit',
            'reply' => 'Odpovědět',
            'reply_with_quote' => 'Citovat příspěvek v odpovědi',
            'search' => 'Vyhledat',
        ],

        'create' => [
            'create_poll' => 'Vytvoření ankety',

            'create_poll_button' => [
                'add' => 'Vytvořit anketu',
                'remove' => 'Zrušit vytváření ankety',
            ],

            'poll' => [
                'length' => 'Spustit anketu po dobu',
                'length_days_suffix' => 'dnů',
                'length_info' => 'Ponechte prázdné pro dobu neurčitou',
                'max_options' => 'Výběrů na uživatele',
                'max_options_info' => 'Tohle je počet možností, které může uživatel v anketě zaškrtnout.',
                'options' => 'Možnosti',
                'options_info' => 'Vložte jednu možnost na jeden řádek. Můžete vložit až 10 možností.',
                'title' => 'Otázka',
                'vote_change' => 'Povolit změnu vybrané možnosti.',
                'vote_change_info' => 'Je-li povoleno, uživatelé mohou změnit svůj hlas.',
            ],
        ],

        'edit_title' => [
            'start' => 'Upravit název',
        ],

        'index' => [
            'views' => 'zobrazení',
            'replies' => 'odpovědi',
        ],

        'issue_tag_added' => [
            'to_0' => 'Odstranit označení "přidáno"',
            'to_0_done' => 'Odstraněno označení "přidáno"',
            'to_1' => 'Přidat označení "přidáno"',
            'to_1_done' => 'Přidáno označení "přidáno"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Odstranit označení "přiděleno"',
            'to_0_done' => 'Odstraněno označení "přiděleno"',
            'to_1' => 'Přidat označení "přiděleno"',
            'to_1_done' => 'Přidáno označení "přiděleno"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Odstranit označení "potvrzeno"',
            'to_0_done' => 'Odstraněno označení "potvrzeno"',
            'to_1' => 'Přidat označení "potvrzeno"',
            'to_1_done' => 'Přidáno označení "potrvrzeno"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Odstranit označení "duplicitní"',
            'to_0_done' => 'Odstraněno označení "duplicitní"',
            'to_1' => 'Přidat označení "duplicitní"',
            'to_1_done' => 'Přidáno označení "duplicitní"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Odstranit označení "neplatný"',
            'to_0_done' => 'Odstraněno označení "neplatný"',
            'to_1' => 'Přidat označení "neplatný"',
            'to_1_done' => 'Přidáno označení "neplatný"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Odstranit označení "vyřešeno"',
            'to_0_done' => 'Odstraněno označení "vyřešeno"',
            'to_1' => 'Přidat oznaění "vyřešeno"',
            'to_1_done' => 'Přidáno označení "vyřešeno"',
        ],

        'lock' => [
            'is_locked' => 'Toto téma je uzamčené a nelze na něj odpovědět',
            'to_0' => 'Odemknout téma',
            'to_0_done' => 'Téma bylo odemčeno',
            'to_1' => 'Uzamknout téma',
            'to_1_done' => 'Téma bylo uzamčeno',
        ],

        'moderate_move' => [
            'title' => 'Přesunout do jiného fóra',
        ],

        'moderate_pin' => [
            'to_0' => 'Odepnout téma',
            'to_0_done' => 'Téma bylo odepnuto',
            'to_1' => 'Připnout téma',
            'to_1_done' => 'Téma bylo připnuto',
            'to_2' => 'Připíchni téma a označ jako oznámení',
            'to_2_done' => 'Téma bylo připnuto a označeno jako oznámení',
        ],

        'show' => [
            'deleted-posts' => 'Odstraněné příspěvky',
            'total_posts' => 'Celkem příspěvků',

            'feature_vote' => [
                'current' => 'Aktuální priorita: +:count',
                'do' => 'Promovat tento požadavek',

                'user' => [
                    'count' => '{0} žádné hlasy | {1} :count hlas | [2,*] :count hlasů',
                    'current' => 'Zbývá vám :votes.',
                    'not_enough' => "Nemáte žádné další hlasy",
                ],
            ],

            'poll' => [
                'vote' => 'Hlasovat',

                'detail' => [
                    'end_time' => 'Hlasování skončí za :time',
                    'ended' => 'Hlasování skončilo :time',
                    'total' => 'Celkem hlasů: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nezáložkováno',
            'to_watching' => 'Záložka',
            'to_watching_mail' => 'Záložka s oznámením',
            'mail_disable' => 'Vypnout oznámení',
        ],
    ],
];
