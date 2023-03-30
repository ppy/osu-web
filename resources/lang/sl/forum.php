<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Pripete Teme',
    'slogan' => "nevarno je igrati sam.",
    'subforums' => 'Podforumi',
    'title' => 'Forumi',

    'covers' => [
        'edit' => 'Uredi naslovnico',

        'create' => [
            '_' => 'Nastavi naslovno sliko',
            'button' => 'Naloži naslovno sliko',
            'info' => 'Naslovna slika naj bo velikosti :dimensions. Sliko lahko tudi tukaj spustiš za nalaganje.',
        ],

        'destroy' => [
            '_' => 'Odstrani naslovno sliko',
            'confirm' => 'Ali si prepričan, da bi odstranil naslovno sliko?',
        ],
    ],

    'forums' => [
        'forums' => 'Forumi',
        'latest_post' => 'Zadnja objava',

        'index' => [
            'title' => 'Indeks foruma',
        ],

        'topics' => [
            'empty' => 'Ni tem!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Označi forum kot prebrano',
        'forums' => 'Označi forume kot prebrane',
        'busy' => 'Označevanje kot prebrano...',
    ],

    'post' => [
        'confirm_destroy' => 'Res želiš izbrisati objavo?',
        'confirm_restore' => 'Res želiš povrniti objavo?',
        'edited' => 'Nazadnje uredil :user :when, uredil skupno :count_delimited-krat.|Nazadnje uredil :user :when, uredil skupno :count_delimited-krat.',
        'posted_at' => 'objavljeno :when',
        'posted_by_in' => 'objavil :username v :forum',

        'actions' => [
            'destroy' => 'Odstrani objavo',
            'edit' => 'Uredi objavo',
            'report' => 'Prijavi objavo',
            'restore' => 'Povrni objavo',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nov odgovor',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited objava|:count_delimited objav',
            'topic_starter' => 'Začetnik teme',
        ],
    ],

    'search' => [
        'go_to_post' => 'Pojdi na objavo',
        'post_number_input' => 'vnesi številko objave',
        'total_posts' => 'skupno :posts_count objav',
    ],

    'topic' => [
        'confirm_destroy' => 'Res želiš izbrisati temo?',
        'confirm_restore' => 'Res želiš povrniti temo?',
        'deleted' => 'odstranjena tema',
        'go_to_latest' => 'ogled zadnje objave',
        'has_replied' => 'Odgovoril si na to temo',
        'in_forum' => 'v :forum',
        'latest_post' => ':when od :user',
        'latest_reply_by' => 'zadnji odgovor od :user',
        'new_topic' => 'Nova tema',
        'new_topic_login' => 'Za objavo nove teme se vpiši',
        'post_reply' => 'Objavi',
        'reply_box_placeholder' => 'Piši tukaj za odgovor',
        'reply_title_prefix' => 'Odg',
        'started_by' => 'od :user',
        'started_by_verbose' => 'začel :user',

        'actions' => [
            'destroy' => 'Odstrani temo',
            'restore' => 'Povrni temo',
        ],

        'create' => [
            'close' => 'Zapri',
            'preview' => 'Predogled',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Zapiši',
            'submit' => 'Objavi',

            'necropost' => [
                'default' => 'Ta tema je že dolgo neaktivna. Objavi tukaj le z določenim razlogom.',

                'new_topic' => [
                    '_' => "Ta tema je že dolgo neaktivna. Če nimaš določenega razloga za objavo tukaj, namesto tega poskusi :create.",
                    'create' => 'kreirati novo temo',
                ],
            ],

            'placeholder' => [
                'body' => 'Napiši vsebino objave tukaj',
                'title' => 'Klikni tukaj za nastavitev naslova',
            ],
        ],

        'jump' => [
            'enter' => 'klikni za vnos določene številke objave',
            'first' => 'pojdi na prvo objavo',
            'last' => 'pojdi na zadnjo objavo',
            'next' => 'preskoči naslednjih 10 objav',
            'previous' => 'pojdi nazaj za 10 objav',
        ],

        'logs' => [
            '_' => 'Dnevniki teme',
            'button' => 'Brskaj dnevnike teme',

            'columns' => [
                'action' => 'Dejanje',
                'date' => 'Datum',
                'user' => 'Uporabnik',
            ],

            'data' => [
                'add_tag' => 'dodana ":tag" oznaka',
                'announcement' => 'tema pripeta in označena kot obvestilo',
                'edit_topic' => 'na :title',
                'fork' => 'od :topic',
                'pin' => 'pripeta tema',
                'post_operation' => 'objavil :username',
                'remove_tag' => 'odstranjena ":tag" oznaka',
                'source_forum_operation' => 'od :forum',
                'unpin' => 'odpeta tema',
            ],

            'no_results' => 'ni najdenih dnevnikov...',

            'operations' => [
                'delete_post' => 'Odstranjena objava',
                'delete_topic' => 'Odstranjena tema',
                'edit_topic' => 'Spremenjen naslov teme',
                'edit_poll' => 'Urejena anketa teme',
                'fork' => 'Kopirana tema',
                'issue_tag' => 'Izdana oznaka',
                'lock' => 'Zaklenjena tema',
                'merge' => 'Združene objave v to temo',
                'move' => 'Premaknjena tema',
                'pin' => 'Pripeta tema',
                'post_edited' => 'Urejena objava',
                'restore_post' => 'Povrnjena objava',
                'restore_topic' => 'Povrnjena tema',
                'split_destination' => 'Premaknjene razdeljene objave',
                'split_source' => 'Razdeljene objave',
                'topic_type' => 'Izbran tip teme',
                'topic_type_changed' => 'Spremenjen tip teme',
                'unlock' => 'Odklenjena tema',
                'unpin' => 'Odpeta tema',
                'user_lock' => 'Zaklenjena lastna tema',
                'user_unlock' => 'Odklenjena lastna tema',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Prekliči',
            'post' => 'Shrani',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'opazovane teme foruma',

            'box' => [
                'total' => 'Naročene teme',
                'unread' => 'Teme z novimi odgovori',
            ],

            'info' => [
                'total' => 'Naročen si na :total tem.',
                'unread' => 'Imaš :unread neprebranih odgovorov na naročene teme.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Se res želiš izpisati od te teme?',
                'title' => 'Izpis',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Teme',

        'actions' => [
            'login_reply' => 'Vpiši se za odgovor',
            'reply' => 'Odgovori',
            'reply_with_quote' => 'Citiraj objavo za odgovor',
            'search' => 'Išči',
        ],

        'create' => [
            'create_poll' => 'Ustvaritev glasovanja',

            'preview' => 'Predogled objave',

            'create_poll_button' => [
                'add' => 'Ustvari glasovanje',
                'remove' => 'Prekliči ustvarjanje glasovanja',
            ],

            'poll' => [
                'hide_results' => 'Skrij rezultate glasovanja.',
                'hide_results_info' => 'Prikazani bodo, ko se glasovanje zaključi.',
                'length' => 'Trajanje glasovanja',
                'length_days_suffix' => 'dni',
                'length_info' => 'Pusti prazno, če se glasovanje ne bo nikoli končalo',
                'max_options' => 'Možnosti za igralca',
                'max_options_info' => 'To je število možnosti, ki jih igralec lahko izbere med glasovanjem.',
                'options' => 'Možnosti',
                'options_info' => 'Postavi vsako možnost v novo vrstico. Vstaviš lahko vse do 10 možnosti.',
                'title' => 'Vprašanje',
                'vote_change' => 'Dovoli ponovno glasovanje.',
                'vote_change_info' => 'Če je omogočeno, lahko igralci spremenijo svoj glas.',
            ],
        ],

        'edit_title' => [
            'start' => 'Uredi naslov',
        ],

        'index' => [
            'feature_votes' => 'star prioriteta',
            'replies' => 'odgovori',
            'views' => 'ogledi',
        ],

        'issue_tag_added' => [
            'to_0' => 'Odstrani oznako "dodano"',
            'to_0_done' => 'Odstranjena oznaka "dodano" ',
            'to_1' => 'Dodaj oznako "dodano"',
            'to_1_done' => 'Dodana oznaka "dodano"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Odstrani oznako "dodeljeno"',
            'to_0_done' => 'Odstranjena oznaka "dodeljeno"',
            'to_1' => 'Dodaj oznako "dodeljeno"',
            'to_1_done' => 'Dodana oznaka "dodeljeno"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Odstrani oznako "potrjeno"',
            'to_0_done' => 'Odstranjena oznaka "potrjeno"',
            'to_1' => 'Dodaj oznako "potrjeno"',
            'to_1_done' => 'Dodana oznaka "potrjeno"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Odstrani oznako "podvojeno"',
            'to_0_done' => 'Odstranjena oznaka "podvojeno"',
            'to_1' => 'Dodaj oznako "podvojeno"',
            'to_1_done' => 'Dodana oznaka "podvojeno"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Odstrani oznako "neveljavno"',
            'to_0_done' => 'Odstranjena oznaka "neveljavno" ',
            'to_1' => 'Dodaj oznako "neveljavno"',
            'to_1_done' => 'Dodana oznaka "neveljavno"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Odstrani oznako "razrešeno"',
            'to_0_done' => 'Odstranjena oznaka "razrešeno"',
            'to_1' => 'Dodaj oznako "razrešeno"',
            'to_1_done' => 'Dodana oznaka "razrešeno"',
        ],

        'lock' => [
            'is_locked' => 'Ta tema je zaklenjena in ni možno odgovarjati nanjo',
            'to_0' => 'Odkleni temo',
            'to_0_confirm' => 'Odkleni temo?',
            'to_0_done' => 'Tema je sedaj odklenjena',
            'to_1' => 'Zakleni temo',
            'to_1_confirm' => 'Zakleni temo?',
            'to_1_done' => 'Tema je sedaj zaklenjena',
        ],

        'moderate_move' => [
            'title' => 'Premakni v drug forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Odpni temo',
            'to_0_confirm' => 'Odpni temo?',
            'to_0_done' => 'Tema je sedaj odpeta',
            'to_1' => 'Pripni temo',
            'to_1_confirm' => 'Pripni temo?',
            'to_1_done' => 'Tema je sedaj pripeta',
            'to_2' => 'Pripni temo in označi kot obvestilo',
            'to_2_confirm' => 'Pripni temo in označi kot obvestilo?',
            'to_2_done' => 'Tema je sedaj pripeta in označena kot obvestilo',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Prikaži odstranjene objave',
            'hide' => 'Skrij odstranjene objave',
        ],

        'show' => [
            'deleted-posts' => 'Odstranjene objave',
            'total_posts' => 'Skupaj objav',

            'feature_vote' => [
                'current' => 'Trenutna prioriteta: +:count',
                'do' => 'Promoviraj to željo',

                'info' => [
                    '_' => 'To je :feature_request. :supporters lahko glasujejo za funkcijske želje.',
                    'feature_request' => 'zahteva za funkcijo',
                    'supporters' => 'Podporniki',
                ],

                'user' => [
                    'count' => '{0} ni glasov|{1} :count_delimited glas|[2,*] :count_delimited glasov',
                    'current' => 'Imaš še :votes preostalih glasov.',
                    'not_enough' => "Nimaš več nobenih preostalih glasov",
                ],
            ],

            'poll' => [
                'edit' => 'Uredi glasovanje',
                'edit_warning' => 'Urejanje glasovanja bo razveljavilo trenutne rezultate!',
                'vote' => 'Glasuj',

                'button' => [
                    'change_vote' => 'Sprememba glasu',
                    'edit' => 'Uredi glasovanje',
                    'view_results' => 'Preskoči do rezultatov',
                    'vote' => 'Glasuj',
                ],

                'detail' => [
                    'end_time' => 'Glasovanje se bo končalo ob :time',
                    'ended' => 'Glasovanje se je končalo ob :time',
                    'results_hidden' => 'Rezultati bodo prikazani, ko se glasovanje konča.',
                    'total' => 'Skupno glasov: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Ni dodano med zaznamke',
            'to_watching' => 'Dodaj med zaznamke',
            'to_watching_mail' => 'Dodaj med zaznamke z obvestilom',
            'tooltip_mail_disable' => 'Obveščanje je omogočeno. Klikni, da onemogočiš',
            'tooltip_mail_enable' => 'Obveščanje je onemogočeno. Klikni, da omogočiš',
        ],
    ],
];
