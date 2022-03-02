<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Připnutá témata',
    'slogan' => "je nebezpečné hrát sám.",
    'subforums' => 'Subfóra',
    'title' => 'osu! fóra',

    'covers' => [
        'edit' => '',

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

    'forums' => [
        'latest_post' => 'Poslední příspěvek',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'Žádná témata!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Označit fórum jako přečtené',
        'forums' => 'Označit fóra jako přečtená',
        'busy' => 'Označuju jako přečtené...',
    ],

    'post' => [
        'confirm_destroy' => 'Opravdu chcete příspěvek odstranit?',
        'confirm_restore' => 'Opravdu chcete příspěvek obnovit?',
        'edited' => 'Naposledy upravil :user :when, upraveno celkem :count_delimited krát.',
        'posted_at' => 'publikováno :when',
        'posted_by' => 'příspěvek přidal :username',

        'actions' => [
            'destroy' => 'Odstranit příspěvek',
            'edit' => 'Upravit příspěvek',
            'report' => 'Nahlásit příspěvek',
            'restore' => 'Obnovit příspěvek',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nová odpověď',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited příspěvek|:count_delimited příspěvky|:count_delimited příspěvků',
            'topic_starter' => 'Autor tématu',
        ],
    ],

    'search' => [
        'go_to_post' => 'Přejít na příspěvek',
        'post_number_input' => 'zadejte číslo příspěvku',
        'total_posts' => ':post_count počet příspěvků',
    ],

    'topic' => [
        'confirm_destroy' => '',
        'confirm_restore' => '',
        'deleted' => 'odstraněné téma',
        'go_to_latest' => 'zobrazit nejnovější příspěvek',
        'has_replied' => '',
        'in_forum' => '',
        'latest_post' => ':when uživatelem :user',
        'latest_reply_by' => 'poslední odpověd od :user',
        'new_topic' => 'Založit nové téma',
        'new_topic_login' => 'Přihlaš se k vytvoření nového téma',
        'post_reply' => 'Přidat příspěvek',
        'reply_box_placeholder' => 'Pro zodpovězení klikni sem',
        'reply_title_prefix' => 'Re',
        'started_by' => 'od :user',
        'started_by_verbose' => 'započal :user',

        'actions' => [
            'destroy' => '',
            'restore' => '',
        ],

        'create' => [
            'close' => 'Zavřít',
            'preview' => 'Náhled',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Psát',
            'submit' => 'Odeslat',

            'necropost' => [
                'default' => 'Tohle téma bylo neaktivní už nějakou dobu. Napište pouze jesli k tomu máš důvod.',

                'new_topic' => [
                    '_' => "Toto téma je neaktivní už nějakou dobu. Pokud nemáte důvod k napsaní, prosím :create radši.",
                    'create' => 'vytvoř nové téma',
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

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => 'Akce',
                'date' => 'Datum',
                'user' => 'Uživatel',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => 'z :topic',
                'pin' => '',
                'post_operation' => 'příspěvek přidal :username',
                'remove_tag' => '',
                'source_forum_operation' => 'z :forum',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => 'Smazaný příspěvek',
                'delete_topic' => 'Smazané téma',
                'edit_topic' => 'Změněný titulek tématu',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => 'Upravený příspěvek',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Zrušit',
            'post' => 'Uložit',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'sledovaná fóra',

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

            'preview' => 'Náhled příspěvku',

            'create_poll_button' => [
                'add' => 'Vytvořit anketu',
                'remove' => 'Zrušit vytváření ankety',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
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
            'feature_votes' => 'priorita hvězd',
            'replies' => 'odpovědi',
            'views' => 'zobrazení',
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
            'to_0_confirm' => '',
            'to_0_done' => 'Téma bylo odemčeno',
            'to_1' => 'Uzamknout téma',
            'to_1_confirm' => '',
            'to_1_done' => 'Téma bylo uzamčeno',
        ],

        'moderate_move' => [
            'title' => 'Přesunout do jiného fóra',
        ],

        'moderate_pin' => [
            'to_0' => 'Odepnout téma',
            'to_0_confirm' => '',
            'to_0_done' => 'Téma bylo odepnuto',
            'to_1' => 'Připnout téma',
            'to_1_confirm' => '',
            'to_1_done' => 'Téma bylo připnuto',
            'to_2' => 'Připíchni téma a označ jako oznámení',
            'to_2_confirm' => '',
            'to_2_done' => 'Téma bylo připnuto a označeno jako oznámení',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Zobrazit smazané příspěvky',
            'hide' => 'Skrýt smazané příspěvky',
        ],

        'show' => [
            'deleted-posts' => 'Odstraněné příspěvky',
            'total_posts' => 'Celkem příspěvků',

            'feature_vote' => [
                'current' => 'Aktuální priorita: +:count',
                'do' => 'Promovat tento požadavek',

                'info' => [
                    '_' => 'Tohle je :feature_request. Žádosti o nové funkce mohou dostávat hlasy od :supporters.',
                    'feature_request' => 'žádost o novou funkci',
                    'supporters' => 'podporovatelů',
                ],

                'user' => [
                    'count' => '{0} žádné hlasy | {1} :count hlas | [2,*] :count hlasů',
                    'current' => 'Zbývá vám :votes.',
                    'not_enough' => "Nemáte žádné další hlasy",
                ],
            ],

            'poll' => [
                'edit' => 'Upravení ankety',
                'edit_warning' => '',
                'vote' => 'Hlasovat',

                'button' => [
                    'change_vote' => 'Změnit hlas',
                    'edit' => 'Upravit hlasování',
                    'view_results' => 'Přeskočit na výsledky',
                    'vote' => 'Hlasovat',
                ],

                'detail' => [
                    'end_time' => 'Hlasování skončí za :time',
                    'ended' => 'Hlasování skončilo :time',
                    'results_hidden' => '',
                    'total' => 'Celkem hlasů: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nezáložkováno',
            'to_watching' => 'Záložka',
            'to_watching_mail' => 'Záložka s oznámením',
            'tooltip_mail_disable' => 'Notifikace je zapnutá. Klikněte pro vypnutí',
            'tooltip_mail_enable' => 'Notifikace je vypnutá. Klikněte pro zapnutí',
        ],
    ],
];
