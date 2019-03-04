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
    'pinned_topics' => 'Pripnuté témy',
    'slogan' => "hrať sám je nebezpečné.",
    'subforums' => 'Subfóra',
    'title' => 'osu! fóra',

    'covers' => [
        'create' => [
            '_' => 'Pridať titulný obrázok',
            'button' => 'Nahrať obrázok',
            'info' => 'Veľkosť titulného obrázku by mala mať veľkosť :dimensions. Obrázok sem môžete aj pretiahnúť.',
        ],

        'destroy' => [
            '_' => 'Odstrániť titulný obrázok',
            'confirm' => 'Si si istý, že chceš odstraniť titulný obrázok?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nová odpoveď na tému ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Žiadne témy!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Označiť fórum ako prečítané',
        'forums' => 'Označiť fóra ako prečítané',
        'busy' => 'Označujem ako prečítané...',
    ],

    'poll' => [
        'edit_warning' => 'Zmena hlasovania odstráni momentálne výsledky!',

        'actions' => [
            'edit' => 'Upraviť hlasovanie',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Naozaj chceš tento príspevok odstrániť?',
        'confirm_restore' => 'Naozaj chceš tento príspevok obnoviť?',
        'edited' => 'Naposledy upravil :user :when, celkový počet úprav :count.',
        'posted_at' => 'publikované :when',

        'actions' => [
            'destroy' => 'Odstraniť príspevok',
            'restore' => 'Obnoviť príspevok',
            'edit' => 'Upraviť príspevok',
        ],

        'info' => [
            'post_count' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Prejsť na príspevok',
        'post_number_input' => 'zadajte číslo príspevku',
        'total_posts' => ':posts_count počet príspevkov',
    ],

    'topic' => [
        'deleted' => 'odstranená téma',
        'go_to_latest' => 'zobraziť najnovší príspevok',
        'latest_post' => ':when použivateľom :user',
        'latest_reply_by' => 'posledná odpoveď od :user',
        'new_topic' => 'Založiť novú tému',
        'new_topic_login' => 'Prihlás sa k vytvoreniu novej témy',
        'post_reply' => 'Pridať príspevok',
        'reply_box_placeholder' => 'Pre odpoveď klikni sem',
        'reply_title_prefix' => 'Re',
        'started_by' => 'od :user',
        'started_by_verbose' => 'začaté použivateľom :user',

        'create' => [
            'preview' => 'Náhlad',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Písať',
            'submit' => 'Odoslať',

            'necropost' => [
                'default' => 'Táto téma bola chvíľu neaktívna. Odpovedajte iba ak máte špecifický dôvod.',

                'new_topic' => [
                    '_' => "Táto téma bola chvíľu neaktívna. Ak nemáte žiadny špecifický dôvod, prečo tu pridávať odpoveď, prosím namiesto toho použite :create .",
                    'create' => 'vytvoriť novú tému',
                ],
            ],

            'placeholder' => [
                'body' => 'Sem napíš obsah príspevku',
                'title' => 'Klikni sem pre nastavenie názvu',
            ],
        ],

        'jump' => [
            'enter' => 'klikni pre zadanie špecifického čísla príspevku',
            'first' => 'prejsť na prvý príspevok',
            'last' => 'prejsť na posledný príspevok',
            'next' => 'preskočiť ďalších 10 príspevkov',
            'previous' => 'vrátiť sa o 10 príspevkov',
        ],

        'post_edit' => [
            'cancel' => 'Zrušiť',
            'post' => 'Uložiť',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Sledované príspevky',
            'title_compact' => 'sledované fóra',
            'title_main' => 'Sledované <strong>príspevky</strong>',

            'box' => [
                'total' => 'Počet sledovaných tém',
                'unread' => 'Témy s novými odpoveďami',
            ],

            'info' => [
                'total' => 'Sleduješ :total tém.',
                'unread' => 'Máš :unread neprečítaných odpovedí v sledovaných témach.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Prestať sledovať tému?',
                'title' => 'Prestať sledovať',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Témy',

        'actions' => [
            'login_reply' => 'Pre odpoveď sa musíš prihlásiť',
            'reply' => 'Odpovedať',
            'reply_with_quote' => 'Citovať príspevok v odpovedi',
            'search' => 'Vyhľadať',
        ],

        'create' => [
            'create_poll' => 'Vytvorenie ankety',

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Vytvoriť anketu',
                'remove' => 'Zrušiť vytváranie ankety',
            ],

            'poll' => [
                'length' => 'Spustit anketu na dobu',
                'length_days_suffix' => 'dni',
                'length_info' => 'Ponechaj prázdne pre dobu neurčitú',
                'max_options' => 'Výberov na uživatela',
                'max_options_info' => 'Toto je počet možností, ktoré môže použivateľ v ankete zaškrtnúť.',
                'options' => 'Možnosti',
                'options_info' => 'Vložte jednu možnosť na jeden riadok. Môžete vložiť až 10 možností.',
                'title' => 'Otázka',
                'vote_change' => 'Povoliť zmenu vybranej možnosti.',
                'vote_change_info' => 'Ak povolené, používatelia môžu zmeniť svoj hlas.',
            ],
        ],

        'edit_title' => [
            'start' => 'Upraviť názov',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => 'odpovedí',
            'views' => 'videní',
        ],

        'issue_tag_added' => [
            'to_0' => 'Odstrániť označenie "pridané"',
            'to_0_done' => 'Odstránenie označenia "pridané"',
            'to_1' => 'Pridať označenie "pridané"',
            'to_1_done' => 'Pridané označenie "pridané"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Odstrániť označenie "pridelený"',
            'to_0_done' => 'Odstránenie označenia "pridelený"',
            'to_1' => 'Pridanie označenia "pridelený"',
            'to_1_done' => 'Pridané označenie "pridelený"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Odstrániť označenie "potvrdený"',
            'to_0_done' => 'Odstránenie označenia "potvrdený"',
            'to_1' => 'Pridať označenie "potvrdený"',
            'to_1_done' => 'Pridané označenie "potvrdený"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Odstrániť označenie "duplicitný"',
            'to_0_done' => 'Odstránenie označenia "duplicitný"',
            'to_1' => 'Pridať označenie "duplicitný"',
            'to_1_done' => 'Pridané označenie "duplicitný"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Odstrániť označenie "neplatný"',
            'to_0_done' => 'Odstránenie označenia "neplatný"',
            'to_1' => 'Pridať označenie "neplatný"',
            'to_1_done' => 'Pridané označenie "neplatný"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Odstrániť označenie "vyriešené"',
            'to_0_done' => 'Odstránenie označenia "vyriešené"',
            'to_1' => 'Pridať označenie "vyriešené"',
            'to_1_done' => 'Pridané označenie "vyriešené"',
        ],

        'lock' => [
            'is_locked' => 'Táto téma je uzamknutá a nedá sa na ňu odpovedať',
            'to_0' => 'Odomknúť tému',
            'to_0_done' => 'Téma bola odomknutá',
            'to_1' => 'Uzamknúť tému',
            'to_1_done' => 'Téma bola uzamknutá',
        ],

        'moderate_move' => [
            'title' => 'Presunút sa do ďalšieho fóra',
        ],

        'moderate_pin' => [
            'to_0' => 'Odopnúť tému',
            'to_0_done' => 'Téma bola odopnutá',
            'to_1' => 'Pripnúť tému',
            'to_1_done' => 'Téma bola pripnutá',
            'to_2' => 'Pripni tému a označ ako oznámenie',
            'to_2_done' => 'Téma bola pripnutá a označená ako oznámenie',
        ],

        'show' => [
            'deleted-posts' => 'Odstránené Príspevky',
            'total_posts' => 'Celkovo Príspevkov',

            'feature_vote' => [
                'current' => 'Aktuálna priorita: +:count',
                'do' => 'Podporiť túto žiadosť',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => '{0} žiadne hlasy |{1} :count hlas |[2,*] :count hlasov',
                    'current' => 'Zostávajúce hlasy: :votes.',
                    'not_enough' => "Nemáte už žiadne ďalšie hlasy",
                ],
            ],

            'poll' => [
                'vote' => 'Hlasovať',

                'detail' => [
                    'end_time' => 'Hlasovanie skončí za :time',
                    'ended' => 'Hlasovanie skončilo :time',
                    'total' => 'Celkových hlasov: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nezáložkované',
            'to_watching' => 'Záložka',
            'to_watching_mail' => 'Záložka s oznámením',
            'tooltip_mail_disable' => 'Notifikácie sú zapnuté. Kliknite na vypnutie',
            'tooltip_mail_enable' => 'Notifikácie sú vypnuté. Kliknite na zapnutie',
        ],
    ],
];
