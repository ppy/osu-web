<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Prisegtos Temos',
    'slogan' => "pavojinga žaisti vienam.",
    'subforums' => 'Poforumiai',
    'title' => 'Forumai',

    'covers' => [
        'edit' => 'Redaguoti viršelį',

        'create' => [
            '_' => 'Išrinkti viršelio paveikslėlį',
            'button' => 'Įkelti viršelį',
            'info' => 'Viršelio dydis turėtu būti :dimensions. Jūs taip pat galite čia įmesti paveikslėlį įkėlimui.',
        ],

        'destroy' => [
            '_' => 'Pašalinti viršelį',
            'confirm' => 'Ar tikrai norite pašalinti viršelį?',
        ],
    ],

    'forums' => [
        'forums' => '',
        'latest_post' => 'Paskutinis Įrašas',

        'index' => [
            'title' => 'Forumo pradžia',
        ],

        'topics' => [
            'empty' => 'Nėra temų!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Pažymėti forumą kaip skaitytą',
        'forums' => 'Pažymėti forumus kaip skaitytus',
        'busy' => 'Pažymima kaip skaityta...',
    ],

    'post' => [
        'confirm_destroy' => 'Tikrai ištrinti įrašą?',
        'confirm_restore' => 'Tikrai gražinti įrašą?',
        'edited' => 'Paskutini kartą redagavo :user :when, redaguota :count_delimited kartų. |Paskutini kartą redagavo :user :when, redaguota :count_delimited kartų.',
        'posted_at' => 'publikuota :when',
        'posted_by_in' => '',

        'actions' => [
            'destroy' => 'Ištrinti įrašą',
            'edit' => 'Redaguoti įrašą',
            'report' => 'Pranešti apie įrašą',
            'restore' => 'Atkūrti įrašą',
        ],

        'create' => [
            'title' => [
                'reply' => 'Naujas atsakymas',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited įrašas|:count_delimited įrašų',
            'topic_starter' => 'Temos Pradininkas',
        ],
    ],

    'search' => [
        'go_to_post' => 'Eiti į įrašą',
        'post_number_input' => 'įveskite įrašo numerį',
        'total_posts' => ':posts_count iš viso įrašų',
    ],

    'topic' => [
        'confirm_destroy' => 'Tikrai ištrinti temą?',
        'confirm_restore' => 'Tikrai gražinti temą?',
        'deleted' => 'ištrintos temos',
        'go_to_latest' => 'peržiūrėti naujausius įrašus',
        'has_replied' => 'Jūs atsakėte į šią temą',
        'in_forum' => 'tarp :forum',
        'latest_post' => ':when iš :user',
        'latest_reply_by' => 'paskutinį atsakymą pateikė :user',
        'new_topic' => 'Nauja tema',
        'new_topic_login' => 'Naujos temos publikavimui reikia prisijungti',
        'post_reply' => 'Publikuoti',
        'reply_box_placeholder' => 'Rašykite čia norėdami atsakyti',
        'reply_title_prefix' => 'Re',
        'started_by' => 'iš :user',
        'started_by_verbose' => 'pradėjo :user',

        'actions' => [
            'destroy' => 'Ištrinti temą',
            'restore' => 'Atkurti tema',
        ],

        'create' => [
            'close' => 'Uždaryti',
            'preview' => 'Išankstinė peržiūra',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Rašyti',
            'submit' => 'Publikuoti',

            'necropost' => [
                'default' => 'Tema neveikli jau kuri laiką. Rašykite čia tik jei turite konkrečią priežastį.',

                'new_topic' => [
                    '_' => "Tema neveikli jau kuri laiką. Jei neturite konkrečios priežasties rašyti čia, prašome :create.",
                    'create' => 'sukurti naują temą',
                ],
            ],

            'placeholder' => [
                'body' => 'Rašyk įrašo turinį čia',
                'title' => 'Spausk čia, kad nustatyti pavadinimą',
            ],
        ],

        'jump' => [
            'enter' => 'spausk, kad įvesti įrašo numerį',
            'first' => 'eiti į pirmą įrašą',
            'last' => 'eiti į paskutinį įrašą',
            'next' => 'praleisti kitus 10 įrašų',
            'previous' => 'grįžti atgal 10 įrašų',
        ],

        'logs' => [
            '_' => 'Temos žurnalas',
            'button' => 'Naršyti temos žurnalą',

            'columns' => [
                'action' => 'Veiksmas',
                'date' => 'Data',
                'user' => 'Vartotojas',
            ],

            'data' => [
                'add_tag' => 'pridėta ":tag" žyma',
                'announcement' => 'prisegta tema ir pažymėta kaip skelbimas',
                'edit_topic' => 'tarp :title',
                'fork' => 'iš :topic',
                'pin' => 'prisegta tema',
                'post_operation' => 'publikavo :username',
                'remove_tag' => 'pašalinta ":tag" žyma',
                'source_forum_operation' => 'iš :forum',
                'unpin' => 'atsegta tema',
            ],

            'no_results' => 'žurnalas tuščias...',

            'operations' => [
                'delete_post' => 'Ištrintas įrašas',
                'delete_topic' => 'Ištrinta tema',
                'edit_topic' => 'Pakeistas temos pavadinimas',
                'edit_poll' => 'Redaguota temos apklausa',
                'fork' => 'Nukopijuota tema',
                'issue_tag' => 'Pridėta žyma',
                'lock' => 'Užrakinta tema',
                'merge' => 'Sujungti įrašai į šią temą',
                'move' => 'Tema perkelta',
                'pin' => 'Prisegta tema',
                'post_edited' => 'Redaguotas įrašas',
                'restore_post' => 'Atkurtas įrašas',
                'restore_topic' => 'Atkurta tema',
                'split_destination' => 'Perkelti skelti įrašai',
                'split_source' => 'Skelti įrašus',
                'topic_type' => 'Nustatyti temos tipą',
                'topic_type_changed' => 'Pakeistas temos tipas',
                'unlock' => 'Atrakinta tema',
                'unpin' => 'Atsegta tema',
                'user_lock' => 'Užrakinta sava tema',
                'user_unlock' => 'Atrakinta sava tema',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Atšaukti',
            'post' => 'Išsaugoti',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forumo temų stebėjimo sąrašas',

            'box' => [
                'total' => 'Prenumeruojamos temos',
                'unread' => 'Temos su naujais atsakymais',
            ],

            'info' => [
                'total' => 'Tu prenumeruoji :total temų.',
                'unread' => 'Jus turite :unread neperskaitytų atsakymų tarp pernumeruojamų temų. ',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Nebeprenumeruoti temos?',
                'title' => 'Neprenumeruoti',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Temos',

        'actions' => [
            'login_reply' => 'Atsakymui reikia prisijungti',
            'reply' => 'Atsakyti',
            'reply_with_quote' => 'Cituoti įrašąatsakymui',
            'search' => 'Ieškoti',
        ],

        'create' => [
            'create_poll' => 'Apklausos kūrimas',

            'preview' => 'Publikuoti Išankstinę Peržiūrą',

            'create_poll_button' => [
                'add' => 'Sukurti apklausą',
                'remove' => 'Atšaukti apklausos kūrimą',
            ],

            'poll' => [
                'hide_results' => 'Slėpti apklausos rezultatus.',
                'hide_results_info' => 'Bus rodoma, kai apklausa baigsis.',
                'length' => 'Apklausa dėl',
                'length_days_suffix' => 'dienos',
                'length_info' => 'Palik tuščia nesibaigiančiai apklausai',
                'max_options' => 'Pasirinkimų vartotojui',
                'max_options_info' => 'Tiek atsakymų variantų gali pasirinkti kiekvienas vartotojas.',
                'options' => 'Parinktys',
                'options_info' => 'Kiekvieną atsakymo variantą rašykite naujoje eilutėje. Iš viso galite įrašyti iki 10 pasirinkimų.',
                'title' => 'Klausimas',
                'vote_change' => 'Leisti perbalsavimą.',
                'vote_change_info' => 'Jei įjungta, vartotojams bus leista pakeisti savo balsą.',
            ],
        ],

        'edit_title' => [
            'start' => 'Keisti pavadinimą',
        ],

        'index' => [
            'feature_votes' => 'žvaigždžių pirmenybė',
            'replies' => 'atsakymai',
            'views' => 'peržiūros',
        ],

        'issue_tag_added' => [
            'to_0' => 'Pašalinti „pridėta“ žymą',
            'to_0_done' => 'Pašalinta „pridėta“ žyma',
            'to_1' => 'Pridėti „pridėta“ žymą',
            'to_1_done' => 'Pridėta "pridėta" žyma',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Pašalinti „priskirta“ žymą',
            'to_0_done' => 'Pašalinta „priskirta“ žyma',
            'to_1' => 'Pridėti „priskirta“ žymą',
            'to_1_done' => 'Pridėta „priskirta“ žyma',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Pašalinti „patvirtinta“ žymą',
            'to_0_done' => 'Pašalinta „patvirtinta“ žyma',
            'to_1' => 'Pridėti „patvirtinta“ žymą',
            'to_1_done' => 'Pridėta „patvirtinta“ žyma',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Pašalinti „dubliuota“ žymą',
            'to_0_done' => 'Pašalinta „dubliuota“ žyma',
            'to_1' => 'Pridėti „dubliuota“ žymą',
            'to_1_done' => 'Pridėta „dubliuota“ žyma',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Pašalinti „negalima“ žymą',
            'to_0_done' => 'Pašalinta „negalima“ žyma',
            'to_1' => 'Pridėti „negalima“ žymą',
            'to_1_done' => 'Pridėta „negalima“ žyma',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Pašalinti „išspręsta“ žymą',
            'to_0_done' => 'Pašalinta „išspręsta“ žyma',
            'to_1' => 'Pridėti „išspręsta“ žymą',
            'to_1_done' => 'Pridėta „išspręsta“ žyma',
        ],

        'lock' => [
            'is_locked' => 'Ši tema yra užrakinta ir negalima atsakyti joje',
            'to_0' => 'Atrakinti temą',
            'to_0_confirm' => 'Atrakinti temą?',
            'to_0_done' => 'Tema buvo atrakinta',
            'to_1' => 'Užrakinti temą',
            'to_1_confirm' => 'Užrakinti temą?',
            'to_1_done' => 'Tema buvo užrakinta',
        ],

        'moderate_move' => [
            'title' => 'Perkelti į kitą forumą',
        ],

        'moderate_pin' => [
            'to_0' => 'Atsegti temą',
            'to_0_confirm' => 'Atsegti temą?',
            'to_0_done' => 'Tema buvo atsegta',
            'to_1' => 'Prisegti temą',
            'to_1_confirm' => 'Prisegti temą?',
            'to_1_done' => 'Tema buvo prisegta',
            'to_2' => 'Prisegti temą ir pažymėti kaip skelbimą',
            'to_2_confirm' => 'Prisegti temą ir pažymėti kaip skelbimą?',
            'to_2_done' => 'Tema buvo prisegta ir pažymėta kaip skelbimas',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Rodyti ištrintus įrašus',
            'hide' => 'Slėpti ištrintus įrašus',
        ],

        'show' => [
            'deleted-posts' => 'Ištrinti Įrašai',
            'total_posts' => 'Iš viso Įrašų',

            'feature_vote' => [
                'current' => 'Dabartinis prioritetas: +:count',
                'do' => 'Aukštinti šį prašymą',

                'info' => [
                    '_' => 'Čia yra :feature_request. Už funkcijų prašymus gali balsuoti :supporters.',
                    'feature_request' => 'funkcijų prašymas',
                    'supporters' => 'rėmėjai',
                ],

                'user' => [
                    'count' => '{0} nėra balsų|{1} :count_delimited balsas|[2,*] :count_delimited balsų',
                    'current' => 'Tau liko :votes balsų.',
                    'not_enough' => "Nebeturi balsų",
                ],
            ],

            'poll' => [
                'edit' => 'Redaguota apklausa',
                'edit_warning' => 'Redaguodami apklausą pašalinsite dabartinius rezultatus!',
                'vote' => 'Balsuoti',

                'button' => [
                    'change_vote' => 'Keisti balsą',
                    'edit' => 'Redaguoti apklausą',
                    'view_results' => 'Pereiti į rezultatus',
                    'vote' => 'Balsuoti',
                ],

                'detail' => [
                    'end_time' => 'Apklausa baigsis :time',
                    'ended' => 'Apklausa baigėsi :time',
                    'results_hidden' => 'Rezultatai bus parodyti, kai baigsis apklausa.',
                    'total' => 'Iš viso balsų: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Nepažymėtas',
            'to_watching' => 'Pažymėti',
            'to_watching_mail' => 'Pažymėti su pranešimais',
            'tooltip_mail_disable' => 'Pranešimai įjungti. Spausk, kad išjungti',
            'tooltip_mail_enable' => 'Pranešimai išjungti. Spausk, kad įjungti',
        ],
    ],
];
