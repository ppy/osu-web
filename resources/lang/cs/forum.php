<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Připnutá témata',
    'slogan' => "je nebezpečné hrát sám.",
    'subforums' => 'Subfóra',
    'title' => 'Fóra',

    'covers' => [
        'edit' => 'Upravit záhlaví',

        'create' => [
            '_' => 'Přidat titulní obrázek',
            'button' => 'Nahrát obrázek',
            'info' => 'Velikost titulního obrázku by měla být :dimensions. K nahrání obrázku ho také můžete přetáhnout sem.',
        ],

        'destroy' => [
            '_' => 'Odebrat titulní obrázek',
            'confirm' => 'Jste si jist, že chcete odebrat titulní obrázek?',
        ],
    ],

    'forums' => [
        'forums' => 'Fóra',
        'latest_post' => 'Poslední příspěvek',

        'index' => [
            'title' => 'Přehled',
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
        'confirm_destroy' => 'Opravdu chceš tento příspěvek odstranit?',
        'confirm_restore' => 'Opravdu chceš tento příspěvek obnovit?',
        'edited' => 'Naposledy upravil :user :when, upraveno celkem :count_delimited krát.',
        'posted_at' => 'publikováno :when',
        'posted_by_in' => 'zveřejněno uživatelem :username v :forum',

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
        'post_number_input' => 'zadej číslo příspěvku',
        'total_posts' => ':posts_count příspěvků celkem',
    ],

    'topic' => [
        'confirm_destroy' => 'Opravdu chceš toto téma odstranit?',
        'confirm_restore' => 'Opravdu chceš toto téma obnovit?',
        'deleted' => 'odstraněné téma',
        'go_to_latest' => 'zobrazit nejnovější příspěvek',
        'go_to_unread' => 'zobrazit první nepřečtený příspěvek',
        'has_replied' => 'Odpověděl jsi na toto téma',
        'in_forum' => 'v :forum',
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
            'destroy' => 'Odstranit téma',
            'restore' => 'Odnovit téma',
        ],

        'create' => [
            'close' => 'Zavřít',
            'preview' => 'Náhled',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Editovat',
            'submit' => 'Odeslat',

            'necropost' => [
                'default' => 'Tohle téma bylo neaktivní už nějakou dobu. Napište pouze jesli k tomu máš důvod.',

                'new_topic' => [
                    '_' => "Toto téma je už nějakou dobu neaktivní. Pokud nemáš specifický důvod k postnutí zde, prosím :create.",
                    'create' => 'vytvoř radši nové téma',
                ],
            ],

            'placeholder' => [
                'body' => 'Zde napiš obsah příspěvku',
                'title' => 'Klikni sem pro zadání názvu',
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
            '_' => 'Logy témat',
            'button' => 'Procházen logy témata',

            'columns' => [
                'action' => 'Akce',
                'date' => 'Datum',
                'user' => 'Uživatel',
            ],

            'data' => [
                'add_tag' => 'přidáno označení ":tag"',
                'announcement' => 'téma připnuto a označeno jako oznámení',
                'edit_topic' => 'do :title',
                'fork' => 'z :topic',
                'pin' => 'téma připnuté',
                'post_operation' => 'příspěvek přidal :username',
                'remove_tag' => 'odebráno označení ":tag"',
                'source_forum_operation' => 'z :forum',
                'unpin' => 'téma odepnuté',
            ],

            'no_results' => 'žádné logy nenalezeny...',

            'operations' => [
                'delete_post' => 'Smazaný příspěvek',
                'delete_topic' => 'Smazané téma',
                'edit_topic' => 'Změněný titulek tématu',
                'edit_poll' => 'Upraveno téma hlasování',
                'fork' => 'Téma zkopírované',
                'issue_tag' => 'Tag vydaný',
                'lock' => 'Téma uzamčeno',
                'merge' => 'Příspěvky byly sloučeny do tohoto tématu',
                'move' => 'Téma přesunuto',
                'pin' => 'Téma připnuto',
                'post_edited' => 'Upravený příspěvek',
                'restore_post' => 'Příspěvek obnoven',
                'restore_topic' => 'Téma obnoveno',
                'split_destination' => 'Rozdělené příspěvky přesunuty',
                'split_source' => 'Příspěvky rozděleny',
                'topic_type' => 'Typ témata nastaven',
                'topic_type_changed' => 'Typ tématu změněn',
                'unlock' => 'Téma odemknuto',
                'unpin' => 'Téma odepnuto',
                'user_lock' => 'Vlastní téma uzamčeno',
                'user_unlock' => 'Vlastní téma odemčeno',
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
                'hide_results' => 'Skrýt výsledky ankety.',
                'hide_results_info' => 'Budou zobrazeny až po konci hlasování.',
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

        'lock' => [
            'is_locked' => 'Toto téma je uzamčené a nelze na něj odpovědět',
            'to_0' => 'Odemknout téma',
            'to_0_confirm' => 'Odemknout téma?',
            'to_0_done' => 'Téma bylo odemčeno',
            'to_1' => 'Uzamknout téma',
            'to_1_confirm' => 'Uzamknout téma?',
            'to_1_done' => 'Téma bylo uzamčeno',
        ],

        'moderate_move' => [
            'title' => 'Přesunout do jiného fóra',
        ],

        'moderate_pin' => [
            'to_0' => 'Odepnout téma',
            'to_0_confirm' => 'Odepnout téma?',
            'to_0_done' => 'Téma bylo odepnuto',
            'to_1' => 'Připnout téma',
            'to_1_confirm' => 'Připnout téma?',
            'to_1_done' => 'Téma bylo připnuto',
            'to_2' => 'Připíchni téma a označ jako oznámení',
            'to_2_confirm' => 'Připnout téma a označit jako oznámení?',
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
                    'count' => '{0} nula hlasů|{1} :count_delimited hlas|[2,4] :count_delimited hlasy|[5,*] :count_delimited hlasů',
                    'current' => 'Zbývá vám :votes.',
                    'not_enough' => "Nemáte žádné další hlasy",
                ],
            ],

            'poll' => [
                'edit' => 'Upravení ankety',
                'edit_warning' => 'Upravování ankety odstraní všechny aktuální hlasy! ',
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
                    'results_hidden' => 'Výsledky budou zobrazeny po ukončení hlasování.',
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
