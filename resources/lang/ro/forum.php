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
    'pinned_topics' => 'Subiecte fixate',
    'slogan' => "este periculos să te joci singur.",
    'subforums' => 'Subforumuri',
    'title' => 'forumuri osu!',

    'covers' => [
        'create' => [
            '_' => 'Setează imaginea de copertă',
            'button' => 'Încarcă imaginea',
            'info' => 'Dimensiunea imaginii de copertă ar trebui să fie la :dimensions. Poți, de asemenea, să plasezi imaginea aici pentru a o încărca.',
        ],

        'destroy' => [
            '_' => 'Elimină imaginea de copertă',
            'confirm' => 'Ești sigur că vrei să elimini imaginea de copertă?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nou răspuns pentru subiectul ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Niciun subiect!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marchează forumul ca citit',
        'forums' => 'Marchează forumurile ca citite',
        'busy' => 'Se marchează ca citit...',
    ],

    'poll' => [
        'edit_warning' => 'Editarea unui sondaj va elimina rezultatele curente!',

        'actions' => [
            'edit' => 'Editează sondajul',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Sigur dorești să ștergi postarea?',
        'confirm_restore' => 'Sigur dorești să restaurezi postarea?',
        'edited' => 'Editat ultima dată de către :user :when, editat de :count ori în total.',
        'posted_at' => 'postat :when',

        'actions' => [
            'destroy' => 'Șterge postarea',
            'restore' => 'Restaurează postarea',
            'edit' => 'Editează postarea',
        ],

        'info' => [
            'post_count' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Mergi la postare',
        'post_number_input' => 'introdu numărul postării',
        'total_posts' => ':posts_count postări în total',
    ],

    'topic' => [
        'deleted' => 'subiect șters',
        'go_to_latest' => 'vezi cea mai recentă postare',
        'latest_post' => ':when de :user',
        'latest_reply_by' => 'ultima replică de :user',
        'new_topic' => 'Postează un subiect nou',
        'new_topic_login' => 'Conectează-te pentru a posta un subiect nou',
        'post_reply' => 'Postează',
        'reply_box_placeholder' => 'Scrie aici pentru a răspunde',
        'reply_title_prefix' => 'Re',
        'started_by' => 'de :user',
        'started_by_verbose' => 'început de :user',

        'create' => [
            'preview' => 'Previzualizare',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Scrie',
            'submit' => 'Postează',

            'necropost' => [
                'default' => 'Acest subiect a fost inactiv pentru o vreme. Postează aici doar dacă ai un motiv specific.',

                'new_topic' => [
                    '_' => "Acest subiect a fost inactiv pentru o vreme. Dacă nu ai un motiv specific pentru a posta aici, te rugăm să :create în schimb.",
                    'create' => 'creezi un subiect nou',
                ],
            ],

            'placeholder' => [
                'body' => 'Introdu conținutul postării aici',
                'title' => 'Click aici pentru a stabili un titlu',
            ],
        ],

        'jump' => [
            'enter' => 'click pentru a introduce numărul postării',
            'first' => 'mergi la prima postare',
            'last' => 'mergi la ultima postare',
            'next' => 'sari peste următoarele 10 postări',
            'previous' => 'mergi înapoi 10 postări',
        ],

        'post_edit' => [
            'cancel' => 'Anulează',
            'post' => 'Salvează',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Abonamente',
            'title_compact' => 'abonamente',
            'title_main' => '<strong>Abonamente</strong> la forumuri',

            'box' => [
                'total' => 'Subiecte la care te-ai abonat',
                'unread' => 'Subiecte cu răspunsuri noi',
            ],

            'info' => [
                'total' => 'Tu ești abonat la :total subiecte.',
                'unread' => 'Tu ai :unread răspunsuri necitite la subiectele la care te-ai abonat.',
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

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Creează un sondaj',
                'remove' => 'Anulează crearea unui sondaj',
            ],

            'poll' => [
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
            'feature_votes' => '',
            'replies' => 'răspunsuri',
            'views' => 'vizualizări',
        ],

        'issue_tag_added' => [
            'to_0' => 'Elimină tagul "added"',
            'to_0_done' => 'S-a eliminat tagul "added"',
            'to_1' => 'Adaugă tagul "added"',
            'to_1_done' => 'S-a adăugat tagul "added"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Elimină tagul "assigned"',
            'to_0_done' => 'S-a eliminat tagul "assigned"',
            'to_1' => 'Adaugă tagul "assigned"',
            'to_1_done' => 'S-a adăugat tagul "assigned"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Elimină tagul "confirmed"',
            'to_0_done' => 'S-a eliminat tagul "confirmed"',
            'to_1' => 'Adaugă tagul "confirmed"',
            'to_1_done' => 'S-a adăugat tagul "confirmed"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Elimină tagul "duplicate"',
            'to_0_done' => 'S-a eliminat tagul "duplicate"',
            'to_1' => 'Adaugă tagul "duplicate"',
            'to_1_done' => 'S-a adăugat tagul "duplicate"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Elimină tagul "invalid"',
            'to_0_done' => 'S-a eliminat tagul "invalid"',
            'to_1' => 'Adaugă tagul "invalid"',
            'to_1_done' => 'S-a adăugat tagul "invalid"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Elimină tagul "resolved"',
            'to_0_done' => 'S-a eliminat tagul "resolved"',
            'to_1' => 'Adaugă tagul "resolved"',
            'to_1_done' => 'S-a adăugat tagul "resolved"',
        ],

        'lock' => [
            'is_locked' => 'Acest subiect este închis și nu se pot adăuga răspunsuri',
            'to_0' => 'Deblochează subiectul',
            'to_0_done' => 'Subiectul a fost deblocat',
            'to_1' => 'Blochează subiectul',
            'to_1_done' => 'Subiectul a fost blocat',
        ],

        'moderate_move' => [
            'title' => 'Mergi la un alt forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Anulează fixarea subiectului',
            'to_0_done' => 'Subiectul nu mai este fixat',
            'to_1' => 'Fixează subiectul',
            'to_1_done' => 'Subiectul a fost fixat',
            'to_2' => 'Fixează subiectul și marchează-l ca un anunț',
            'to_2_done' => 'Subiectul a fost fixat și marcat ca un anunț',
        ],

        'show' => [
            'deleted-posts' => 'Postări șterse',
            'total_posts' => 'Total postări',

            'feature_vote' => [
                'current' => 'Prioritate curentă: +:count',
                'do' => 'Promovează această cerere',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => '{0} niciun vot|{1} :count vot|[2,*] :count voturi',
                    'current' => 'Tu ai :votes rămase.',
                    'not_enough' => "Tu nu mai ai niciun vot rămas",
                ],
            ],

            'poll' => [
                'vote' => 'Votează',

                'detail' => [
                    'end_time' => 'Votarea se va termina în :time',
                    'ended' => 'Votarea s-a terminat :time',
                    'total' => 'Total voturi: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nu este marcat',
            'to_watching' => 'Marchează',
            'to_watching_mail' => 'Marchează cu notificare',
            'tooltip_mail_disable' => 'Notificările sunt activate. Click pentru a le dezactiva',
            'tooltip_mail_enable' => 'Notificările sunt dezactivate. Click pentru a le activa',
        ],
    ],
];
