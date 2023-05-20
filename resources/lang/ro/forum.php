<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Subiecte fixate',
    'slogan' => "este periculos să te joci singur.",
    'subforums' => 'Subforum-uri',
    'title' => 'Forum-uri osu!',

    'covers' => [
        'edit' => 'Editează fundalul',

        'create' => [
            '_' => 'Setează imaginea de fundal',
            'button' => 'Încarcă fundal',
            'info' => 'Dimensiunea imaginii de fundal ar trebui să fie la :dimensions. Poți, de asemenea, să plasezi imaginea aici pentru a o încărca.',
        ],

        'destroy' => [
            '_' => 'Elimină imaginea de fundal',
            'confirm' => 'Ești sigur că vrei să elimini imaginea de fundal?',
        ],
    ],

    'forums' => [
        'forums' => 'Forum-uri',
        'latest_post' => 'Ultima Postare',

        'index' => [
            'title' => 'Index forum',
        ],

        'topics' => [
            'empty' => 'Niciun subiect!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marchează forum-ul ca citit',
        'forums' => 'Marchează forum-urile ca citite',
        'busy' => 'Se marchează ca citit...',
    ],

    'post' => [
        'confirm_destroy' => 'Sigur dorești să ștergi postarea?',
        'confirm_restore' => 'Sigur dorești să restaurezi postarea?',
        'edited' => 'Editat ultima dată de către :user :when, editat o dată în total.|Editat ultima dată de către :user :when, editat de :count_delimited ori în total.',
        'posted_at' => 'postat :when',
        'posted_by_in' => 'postat de :username în :forum',

        'actions' => [
            'destroy' => 'Șterge postarea',
            'edit' => 'Editează postarea',
            'report' => 'Raportați postarea',
            'restore' => 'Restaurează postarea',
        ],

        'create' => [
            'title' => [
                'reply' => 'Răspuns nou',
            ],
        ],

        'info' => [
            'post_count' => 'o postare|:count_delimited postări|:count_delimited de postări',
            'topic_starter' => 'Început de Subiect',
        ],
    ],

    'search' => [
        'go_to_post' => 'Mergi la postare',
        'post_number_input' => 'introdu numărul postării',
        'total_posts' => ':posts_count postări în total',
    ],

    'topic' => [
        'confirm_destroy' => 'Sigur dorești să ștergi subiectul?',
        'confirm_restore' => 'Sigur dorești să restaurezi subiectul?',
        'deleted' => 'subiect șters',
        'go_to_latest' => 'vezi cea mai recentă postare',
        'has_replied' => 'Ai răspuns în acest subiect',
        'in_forum' => 'in :forum',
        'latest_post' => ':when de :user',
        'latest_reply_by' => 'ultima replică de :user',
        'new_topic' => 'Postează un subiect nou',
        'new_topic_login' => 'Conectează-te pentru a posta un subiect nou',
        'post_reply' => 'Postează',
        'reply_box_placeholder' => 'Scrie aici pentru a răspunde',
        'reply_title_prefix' => 'Re',
        'started_by' => 'de :user',
        'started_by_verbose' => 'început de :user',

        'actions' => [
            'destroy' => 'Ștergeți subiectul',
            'restore' => 'Restaurați subiectul',
        ],

        'create' => [
            'close' => 'Închide',
            'preview' => 'Previzualizare',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Scrie',
            'submit' => 'Postează',

            'necropost' => [
                'default' => 'Acest subiect a fost inactiv pentru o vreme. Postează aici doar dacă ai un motiv specific.',

                'new_topic' => [
                    '_' => "Acest subiect a fost inactiv pentru o vreme. Dacă nu ai un motiv specific pentru a posta aici, te rugăm să :create în schimb.",
                    'create' => 'creează un subiect nou',
                ],
            ],

            'placeholder' => [
                'body' => 'Introdu conținutul postării aici',
                'title' => 'Faceți clic aici pentru a stabili un titlu',
            ],
        ],

        'jump' => [
            'enter' => 'faceți clic pentru a introduce numărul postării',
            'first' => 'mergi la prima postare',
            'last' => 'mergi la ultima postare',
            'next' => 'sari peste 10 postări',
            'previous' => 'mergi înapoi 10 postări',
        ],

        'logs' => [
            '_' => 'Istoric subiecte',
            'button' => 'Navigați istoricul subiectului',

            'columns' => [
                'action' => 'Acțiune ',
                'date' => 'Dată ',
                'user' => 'Utilizator',
            ],

            'data' => [
                'add_tag' => 'adăugat tag-ul ":tag"',
                'announcement' => 'subiect fixat şi marcat ca anunţ',
                'edit_topic' => 'către :title',
                'fork' => 'din :topic',
                'pin' => 'subiect fixat',
                'post_operation' => 'postat de :username',
                'remove_tag' => 'eliminat tag-ul ":tag"',
                'source_forum_operation' => 'din :forum',
                'unpin' => 'subiect nefixat ',
            ],

            'no_results' => 'niciun istoric găsit...',

            'operations' => [
                'delete_post' => 'Postare ștearsă',
                'delete_topic' => 'Subiect șters ',
                'edit_topic' => 'Titlul subiectului a fost modificat',
                'edit_poll' => 'Sondaj subiect modificat',
                'fork' => 'Subiect copiat',
                'issue_tag' => 'Tag adăugat',
                'lock' => 'Subiect blocat',
                'merge' => 'Postări unite în acest subiect',
                'move' => 'Subiect mutat',
                'pin' => 'Subiect fixat',
                'post_edited' => 'Postare editată',
                'restore_post' => 'Postare restaurată',
                'restore_topic' => 'Subiect restaurat',
                'split_destination' => 'Mesaje separate mutate',
                'split_source' => 'Separă postările',
                'topic_type' => 'Setează tipul subiectului',
                'topic_type_changed' => 'Tipul subiectului a fost modificat',
                'unlock' => 'Subiect deblocat',
                'unpin' => 'Subiect nefixat',
                'user_lock' => 'Subiect propriu închis',
                'user_unlock' => 'Subiect propriu deschis',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Anulează',
            'post' => 'Salvează',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'abonamente subiecte forum',

            'box' => [
                'total' => 'Subiecte abonate',
                'unread' => 'Subiecte cu răspunsuri noi',
            ],

            'info' => [
                'total' => 'Te-ai abonat la :total subiecte.',
                'unread' => 'Aveți :unread răspunsuri necitite la subiecte abonate.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Te dezabonezi de la acest subiect?',
                'title' => 'Dezabonare',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Subiecte',

        'actions' => [
            'login_reply' => 'Conectează-te pentru a răspunde',
            'reply' => 'Răspunde',
            'reply_with_quote' => 'Citează mesajul și răspunde',
            'search' => 'Caută',
        ],

        'create' => [
            'create_poll' => 'Crearea unui sondaj',

            'preview' => 'Previzualizare',

            'create_poll_button' => [
                'add' => 'Creează un sondaj',
                'remove' => 'Anulează crearea unui sondaj',
            ],

            'poll' => [
                'hide_results' => 'Ascunde rezultatele poll-ului.',
                'hide_results_info' => 'Vor fi arătate doar după ce poll-ul conclude.',
                'length' => 'Rulează sondajul pentru',
                'length_days_suffix' => 'zile',
                'length_info' => 'Lasă liber pentru un sondaj ce nu se termină niciodată',
                'max_options' => 'Opțiuni per utilizator',
                'max_options_info' => 'Acesta este numărul de opțiuni pe care fiecare utilizator îl poate selecta când votează.',
                'options' => 'Opțiuni',
                'options_info' => 'Plasează fiecare opțiune pe o linie nouă. Poți introduce până la 10 opțiuni.',
                'title' => 'Întrebare',
                'vote_change' => 'Permite re-votarea.',
                'vote_change_info' => 'Dacă este activată, utilizatorii au posibilitatea de a-și schimba votul.',
            ],
        ],

        'edit_title' => [
            'start' => 'Editează titlul',
        ],

        'index' => [
            'feature_votes' => 'prioritatea stelelor',
            'replies' => 'răspunsuri',
            'views' => 'vizualizări',
        ],

        'issue_tag_added' => [
            'to_0' => 'Elimină eticheta "added"',
            'to_0_done' => 'A fost eliminată eticheta "added"',
            'to_1' => 'Adaugă eticheta "added"',
            'to_1_done' => 'A fost adăugată eticheta "added"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Elimină eticheta "assigned"',
            'to_0_done' => 'A fost eliminată eticheta "assigned"',
            'to_1' => 'Adaugă eticheta "assigned"',
            'to_1_done' => 'A fost adăugată eticheta "assigned"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Elimină eticheta "confirmed"',
            'to_0_done' => 'A fost eliminată eticheta "confirmed"',
            'to_1' => 'Adaugă eticheta "confirmed"',
            'to_1_done' => 'A fost adăugată eticheta "confirmed"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Elimină eticheta "duplicate"',
            'to_0_done' => 'A fost eliminată eticheta "duplicate"',
            'to_1' => 'Adaugă eticheta "duplicate"',
            'to_1_done' => 'A fost adăugată eticheta "duplicate"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Elimină eticheta "invalid"',
            'to_0_done' => 'A fost eliminată eticheta "invalid"',
            'to_1' => 'Adaugă eticheta "invalid"',
            'to_1_done' => 'A fost adăugată eticheta "invalid"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Elimină eticheta "resolved"',
            'to_0_done' => 'A fost eliminată eticheta "resolved"',
            'to_1' => 'Adaugă eticheta "resolved"',
            'to_1_done' => 'A fost adăugată eticheta "resolved"',
        ],

        'lock' => [
            'is_locked' => 'Acest subiect este închis și nu se pot adăuga răspunsuri',
            'to_0' => 'Deblochează subiectul',
            'to_0_confirm' => 'Deblochează subiectul?',
            'to_0_done' => 'Subiectul a fost deblocat',
            'to_1' => 'Blochează subiectul',
            'to_1_confirm' => 'Blochează subiectul?',
            'to_1_done' => 'Subiectul a fost blocat',
        ],

        'moderate_move' => [
            'title' => 'Mergi la un alt forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Defixează subiectului',
            'to_0_confirm' => 'Defixezi subiectul?',
            'to_0_done' => 'Subiectul nu mai este fixat',
            'to_1' => 'Fixează subiectul',
            'to_1_confirm' => 'Fixează subiectul?',
            'to_1_done' => 'Subiectul a fost fixat',
            'to_2' => 'Fixează subiectul și marchează-l ca un anunț',
            'to_2_confirm' => 'Fixează subiectul și marchează-l ca un anunț?',
            'to_2_done' => 'Subiectul a fost fixat și marcat ca un anunț',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Arată postări șterse',
            'hide' => 'Ascunde postări șterse',
        ],

        'show' => [
            'deleted-posts' => 'Postări șterse',
            'total_posts' => 'Total postări',

            'feature_vote' => [
                'current' => 'Prioritate actuală: +:count',
                'do' => 'Promovează această cerere',

                'info' => [
                    '_' => 'Aceasta este o :feature_request. Cererile pot fi votate de către :supporters.',
                    'feature_request' => 'solicitare funcție',
                    'supporters' => 'suporteri',
                ],

                'user' => [
                    'count' => '{0} niciun vot|{1} un vot|[2,19] :count_delimited voturi|[20,*] :count_delimited de voturi',
                    'current' => 'Tu ai :votes rămase.',
                    'not_enough' => "Tu nu mai ai niciun vot rămas",
                ],
            ],

            'poll' => [
                'edit' => 'Editare Poll',
                'edit_warning' => 'Editarea unui poll va înlătura rezultatele curente!',
                'vote' => 'Votează',

                'button' => [
                    'change_vote' => 'Schimbă votul',
                    'edit' => 'Editează poll-ul',
                    'view_results' => 'Sări la rezultate',
                    'vote' => 'Votează',
                ],

                'detail' => [
                    'end_time' => 'Votarea se va termina în :time',
                    'ended' => 'Votarea s-a terminat :time',
                    'results_hidden' => 'Rezultatele vor fi arătate după sfârșirea poll-ului.',
                    'total' => 'Total voturi: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nu este marcat',
            'to_watching' => 'Marchează',
            'to_watching_mail' => 'Marchează cu notificare',
            'tooltip_mail_disable' => 'Notificările sunt activate. Faceți clic pentru a le dezactiva',
            'tooltip_mail_enable' => 'Notificările sunt dezactivate. Faceți clic pentru a le activa',
        ],
    ],
];
