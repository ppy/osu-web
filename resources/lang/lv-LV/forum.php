<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Piespraustās Tēmas',
    'slogan' => "ir bīstami spēlēt vienam.",
    'subforums' => 'Subforums',
    'title' => 'Forums',

    'covers' => [
        'edit' => 'Rediģēt Pārklājumu',

        'create' => [
            '_' => 'Uzstādīt pārklājuma bildi',
            'button' => 'Augšuplādēt attēlu',
            'info' => 'Pārklājuma izmēram būtu jābūt ap :dimensions. Tu vari arī nomest bildi šeit, lai augšupielādētu.',
        ],

        'destroy' => [
            '_' => 'Noņemt pārklājumu',
            'confirm' => 'Vai tiešām esi pārliecināts, ka vēlies noņemt pārklājuma bildi?',
        ],
    ],

    'forums' => [
        'forums' => 'Forumi',
        'latest_post' => 'Beidzamais Raksts',

        'index' => [
            'title' => 'Foruma Indekss',
        ],

        'topics' => [
            'empty' => 'Nav tēmu!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Atzīmēt forumu kā lasītu',
        'forums' => 'Atzīmēt forumus kā lasītus',
        'busy' => 'Atzīmēt kā lasītu...',
    ],

    'post' => [
        'confirm_destroy' => 'Vai tiešām izdzēst rakstu?',
        'confirm_restore' => 'Vai tiešām atjaunot rakstu?',
        'edited' => 'Beidzamo reizi rediģēts pēc :user :when, rediģējot :count reizes kopumā.',
        'posted_at' => 'publicēts :when',
        'posted_by_in' => 'publicēja :username iekš :forum',

        'actions' => [
            'destroy' => 'Izdzēst rakstu',
            'edit' => 'Rediģēt rakstu',
            'report' => 'Ziņot rakstu',
            'restore' => 'Atjaunot rakstu',
        ],

        'create' => [
            'title' => [
                'reply' => 'Jauna atbilde',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited raksts|:count_delimited raksti',
            'topic_starter' => 'Tēmas Sāknētājs',
        ],
    ],

    'search' => [
        'go_to_post' => 'Dodies uz rakstu',
        'post_number_input' => 'ievadīt raksta numuru',
        'total_posts' => ':posts_count raksti kopumā',
    ],

    'topic' => [
        'confirm_destroy' => 'Vai tiešām dzēst tēmu?',
        'confirm_restore' => 'Vai tiešām atjaunot tēmu?',
        'deleted' => 'izdzēstā tēma',
        'go_to_latest' => 'skatīt beidzamo rakstu',
        'go_to_unread' => 'skatīt pirmo neizlasīto rakstu',
        'has_replied' => 'Jūs atbildējāt uz šo tēmu',
        'in_forum' => 'iekš :forum',
        'latest_post' => ':when no :user',
        'latest_reply_by' => 'beidzamā atbilde no :user',
        'new_topic' => 'Jauna tēma',
        'new_topic_login' => 'Ielogojieties, lai publicētu jaunu tēmu',
        'post_reply' => 'Publicēt',
        'reply_box_placeholder' => 'Rakstiet šeit, lai atbildētu',
        'reply_title_prefix' => 'Re',
        'started_by' => 'autors: :user',
        'started_by_verbose' => 'iesāka :user',

        'actions' => [
            'destroy' => 'Dzēst tēmu',
            'restore' => 'Atjaunot tēmu',
        ],

        'create' => [
            'close' => 'Aizslēgts',
            'preview' => 'Priekšskatījums',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Rakstīt',
            'submit' => 'Publicēt',

            'necropost' => [
                'default' => 'Šī tēma jau kādu laiku ir neaktīva. Publicējiet šeit tikai tad, ja jums ir konkrēts iemesls to darīt.',

                'new_topic' => [
                    '_' => "Šī tēma jau kādu laiku ir neaktīva. Ja jums nav konkrēta iemesla šeit rakstīt, lūdzu, tā vietā: :create",
                    'create' => 'izveidot jaunu tēmu',
                ],
            ],

            'placeholder' => [
                'body' => 'Ievadiet raksta saturu šeit',
                'title' => 'Klikšķiniet šeit, lai iestatītu nosaukumu',
            ],
        ],

        'jump' => [
            'enter' => 'noklikšķiniet, lai ievadītu konkrētu raksta numuru',
            'first' => 'doties uz pirmo rakstu',
            'last' => 'doties uz pēdējo rakstu',
            'next' => 'izlaist nākamos 10 rakstus',
            'previous' => 'atgriezties 10 rakstus atpakaļ',
        ],

        'logs' => [
            '_' => 'Tēmas žurnāli',
            'button' => 'Pārlūkot tēmas žurnālus',

            'columns' => [
                'action' => 'Darbība',
                'date' => 'Datums',
                'user' => 'Lietotājs',
            ],

            'data' => [
                'add_tag' => 'pievienots ":tag" tags',
                'announcement' => 'tēma ir piesprausta un atzīmēta kā paziņojums',
                'edit_topic' => 'uz :title',
                'fork' => 'no :topic',
                'pin' => 'piesprausta tēma',
                'post_operation' => 'publicēja :username',
                'remove_tag' => 'noņemts ":tag" tags',
                'source_forum_operation' => 'no :forum',
                'unpin' => 'atsprausta tēma',
            ],

            'no_results' => 'žurnāli nav atrasti...',

            'operations' => [
                'delete_post' => 'Izdzēsts raksts',
                'delete_topic' => 'Izdzēsta tēma',
                'edit_topic' => 'Mainīts tēmas nosaukums',
                'edit_poll' => 'Rediģēta tēmas aptauja',
                'fork' => 'Nokopēta tēma',
                'issue_tag' => 'Izsniegts tags',
                'lock' => 'Slēgta tēma',
                'merge' => 'Apvienot rakstus šajā tematā',
                'move' => 'Pārvietoja tematu',
                'pin' => 'Piesprauda tematu',
                'post_edited' => 'Rediģēja rakstu',
                'restore_post' => 'Atjaunoja rakstu',
                'restore_topic' => 'Atjaunoja tematu',
                'split_destination' => 'Pārvietot sadalītos rakstus',
                'split_source' => 'Sadalīt rakstus',
                'topic_type' => 'Uzstādi temata tipu',
                'topic_type_changed' => 'Izmaini temata tipu',
                'unlock' => 'Neaizslēgts temats',
                'unpin' => 'Nepiesprausts temats',
                'user_lock' => 'Aizslēdzi savu tematu',
                'user_unlock' => 'Atvēri savu tematu',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Atcelt',
            'post' => 'Saglabāt',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'foruma tematu ',

            'box' => [
                'total' => 'Abonētie temati',
                'unread' => 'Temati ar jaunām atbildēm',
            ],

            'info' => [
                'total' => 'Tu esi abonējis :total tematus.',
                'unread' => 'Tev ir :unread neizlasītas atbildes abonētajos tematos.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Izbeigt abonementu šim tematam?',
                'title' => 'Izbeigt abonementu.',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Temati',

        'actions' => [
            'login_reply' => 'Pierakstīties lai atbildētu',
            'reply' => 'Atbildēt',
            'reply_with_quote' => 'Citēt rakstu priekš atbildes',
            'search' => 'Meklēt',
        ],

        'create' => [
            'create_poll' => 'Aptaujas Izveide',

            'preview' => 'Raksta Priekšskatījums',

            'create_poll_button' => [
                'add' => 'Izveidot aptauju',
                'remove' => 'Atcelt aptaujas izveidi',
            ],

            'poll' => [
                'hide_results' => 'Paslēpt aptaujas rezultātus.',
                'hide_results_info' => 'Tie tiks parādīti tikai pēc tam, kad aptauja būs beigusies.',
                'length' => '',
                'length_days_suffix' => 'dienas',
                'length_info' => 'Atstāt tukšu priekš nekad nebeidzošas aptaujas',
                'max_options' => 'Opciju daudzums lietotājam',
                'max_options_info' => 'Šis ir cik daudz opcijas katrs lietotājs var izvēlēties kad balso.',
                'options' => 'Opcijas',
                'options_info' => 'Saliec katru opciju uz jaunas līnijas. Tu vari ievadīt līdz 10 opcijām.',
                'title' => 'Jautājums',
                'vote_change' => 'Atļaut pārbalsot.',
                'vote_change_info' => 'Ja ieslēgts, lietotāji var izmainīt savu balsi.',
            ],
        ],

        'edit_title' => [
            'start' => 'Rediģēt nosaukumu',
        ],

        'index' => [
            'feature_votes' => 'zvaigznes prioritāte',
            'replies' => 'atbildes',
            'views' => 'skatījumi',
        ],

        'issue_tag_added' => [
            'to_0' => 'Noņemt "pievienots" piespraudni',
            'to_0_done' => 'Noņemts "pievienots" piespraudnis',
            'to_1' => 'Pievienot "pievienots" piespraudni',
            'to_1_done' => 'Pievienots "pievienots" piespraudnis',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Noņemt "piešķirts" piespraudni',
            'to_0_done' => 'Noņemts "piešķirts" piespraudnis',
            'to_1' => 'Pievienot "piešķirts" piespraudni',
            'to_1_done' => 'Pievienots "piešķirts" piespraudnis',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Noņemt "apstiprināts" piespraudni',
            'to_0_done' => 'Noņemts "apstiprināts" piespraudnis',
            'to_1' => 'Pievienot "apstiprināt" piespraudnis',
            'to_1_done' => 'Pievienots "apstiprināt" piespraudnis',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Noņemt "dublicēt" piespraudni',
            'to_0_done' => 'Noņemts "dublicēt" piespraudnis',
            'to_1' => 'Pievienot "dublicēt" piespraudni',
            'to_1_done' => 'Pievienots "dublicēt" piespraudnis',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Noņemt "nederīgs" piespraudni',
            'to_0_done' => 'Noņemts "nederīgs" piespraudnis',
            'to_1' => 'Pievienot "nederīgs" piespraudni',
            'to_1_done' => 'Pievienots "nederīgs" piespraudnis',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Noņemt "atrisināts" piespraudni',
            'to_0_done' => 'Noņemts "atrisināts" piespraudnis',
            'to_1' => 'Pievienot "atrisināts" piespraudni',
            'to_1_done' => 'Pievienots "atrisināts" piespraudnis',
        ],

        'lock' => [
            'is_locked' => 'Šī tēma ir slēgta un nav iespējams caur to atbildēt',
            'to_0' => 'Atvērt tēmu',
            'to_0_confirm' => 'Atslēgt tematu?',
            'to_0_done' => 'Tēma tika atvērta',
            'to_1' => 'Slēgt tēmu',
            'to_1_confirm' => 'Slēgt tematu?',
            'to_1_done' => 'Tēma tika slēgta',
        ],

        'moderate_move' => [
            'title' => 'Pārvietot uz citu forumu',
        ],

        'moderate_pin' => [
            'to_0' => 'Atspraust tēmu',
            'to_0_confirm' => 'Atspraust tematu?',
            'to_0_done' => 'Tēma tika atsprausta',
            'to_1' => 'Piespraust tēmu',
            'to_1_confirm' => 'Piespraust tematu?',
            'to_1_done' => 'Tēma tika piesprausta',
            'to_2' => 'Piespraust tēmu un atzīmēt kā paziņojumu',
            'to_2_confirm' => 'Piespraust tematu un atzīmēt kā paziņojumu?',
            'to_2_done' => 'Tēma tika piesprausta un atzīmēta kā paziņojums',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Rādīt dzēstos rakstus',
            'hide' => 'Slēpt dzēstos rakstus',
        ],

        'show' => [
            'deleted-posts' => 'Dzēstie Raksti',
            'total_posts' => 'Raksti Kopumā',

            'feature_vote' => [
                'current' => 'Pašreizējā Prioritāte: +:count',
                'do' => 'Paaugstināt šo pieprasījumu',

                'info' => [
                    '_' => 'Šī ir :feature_request. Iezīmētie pieprasījumi var tikt nobalsoti ar :supporters.',
                    'feature_request' => 'iezīmēt pieprasījumu',
                    'supporters' => 'atbalstītāji',
                ],

                'user' => [
                    'count' => '{0} nav balsu|{1} :count_delimited balss|[2,*] :count_delimited balsis',
                    'current' => 'Jums palikušas :votes balsis.',
                    'not_enough' => "Tev vairs nav atlikušu balsu",
                ],
            ],

            'poll' => [
                'edit' => 'Balsošanas Rediģēšana',
                'edit_warning' => 'Rediģējot balsošanas metodi tiks noņemti visi esošie rezultāti!',
                'vote' => 'Balsot',

                'button' => [
                    'change_vote' => 'Mainīt balsi',
                    'edit' => 'Rediģēt balsošanu',
                    'view_results' => 'Pārlēkt uz rezultātiem',
                    'vote' => 'Balsot',
                ],

                'detail' => [
                    'end_time' => 'Balsošana beigsies :time',
                    'ended' => 'Balsošana beidzās :time',
                    'results_hidden' => 'Rezultāti tiks parādīti kad aptauja beigsies.',
                    'total' => 'Balsis kopā: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nav izcelts',
            'to_watching' => 'Izceltie',
            'to_watching_mail' => 'Izcelt ar paziņojumiem',
            'tooltip_mail_disable' => 'Paziņojumi ir ieslēgti. Uzspiest lai izslēgtu',
            'tooltip_mail_enable' => 'Paziņojumi ir izslēgti. Uzspiest lai ieslēgtu',
        ],
    ],
];
