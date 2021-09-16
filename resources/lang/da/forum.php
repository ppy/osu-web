<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Fastgjorte Emner',
    'slogan' => "det er farligt at spille alene.",
    'subforums' => 'Subforumer',
    'title' => 'Forum',

    'covers' => [
        'edit' => 'Rediger coverbillede',

        'create' => [
            '_' => 'Sæt coverbillede',
            'button' => 'Upload billede',
            'info' => 'Cover-størrelsen bør være :dimensions. Du kan også smide dit billede her for at uploade det.',
        ],

        'destroy' => [
            '_' => 'Fjern coverbillede',
            'confirm' => 'Er du sikker på, at du vil fjerne coverbilledet?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Seneste Opslag',

        'index' => [
            'title' => 'Debatforumoversigt',
        ],

        'topics' => [
            'empty' => 'Ingen emner!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marker forum som læst',
        'forums' => 'Marker forums som læst',
        'busy' => 'Marker som læst...',
    ],

    'post' => [
        'confirm_destroy' => 'Slet opslag?',
        'confirm_restore' => 'Gendan opslag?',
        'edited' => 'Sidst redigeret af :user den :when, redigeret i alt :count gange.',
        'posted_at' => 'slået op på :when',
        'posted_by' => 'Nyt oplsag af :username',

        'actions' => [
            'destroy' => 'Slet opslag',
            'edit' => 'Rediger opslag',
            'report' => '',
            'restore' => 'Gendan opslag',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nyt svar',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited opslag|:count_delimited opslag',
            'topic_starter' => 'Emne Starter',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå til opslag',
        'post_number_input' => 'indtast opslagsnummer',
        'total_posts' => ':posts_count opslag i alt',
    ],

    'topic' => [
        'confirm_destroy' => 'Slet opslag?',
        'confirm_restore' => 'Gendan opslag?',
        'deleted' => 'slettede emne',
        'go_to_latest' => 'vis det seneste opslag',
        'has_replied' => '',
        'in_forum' => '',
        'latest_post' => ':when af :user',
        'latest_reply_by' => 'seneste svar af :user',
        'new_topic' => 'Nyt emne',
        'new_topic_login' => 'Log ind for at kunne lave et nyt emne',
        'post_reply' => 'Slå op',
        'reply_box_placeholder' => 'Skriv her for at svare',
        'reply_title_prefix' => 'Re',
        'started_by' => 'af :user',
        'started_by_verbose' => 'startet af :user',

        'actions' => [
            'destroy' => 'Slet emne',
            'restore' => 'Gendan emne',
        ],

        'create' => [
            'close' => 'Luk',
            'preview' => 'Forhåndsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Slå op',

            'necropost' => [
                'default' => 'Dette emne har været inaktivt i et stykke tid. Post kun her hvis du har en særlig grund til det.',

                'new_topic' => [
                    '_' => "Dette opslag har været inaktivt i et stykke tid. Hvis du ikke har en specifik grund til at sende noget, så :create et nyt opslag i stedet.",
                    'create' => 'opret nyt emne',
                ],
            ],

            'placeholder' => [
                'body' => 'Skriv opslagets indhold her',
                'title' => 'Klik her for at lave en overskrift',
            ],
        ],

        'jump' => [
            'enter' => 'klik for at vælge et specifikt opslags-nummer',
            'first' => 'gå til første opslag',
            'last' => 'gå til sidste opslag',
            'next' => 'spring over 10 opslag',
            'previous' => 'gå 10 opslag tilbage',
        ],

        'post_edit' => [
            'cancel' => 'Annullér',
            'post' => 'Gem',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forum abonnementer',

            'box' => [
                'total' => 'Emner abonneret',
                'unread' => 'Emner med nye svar',
            ],

            'info' => [
                'total' => 'Du abonnerer i alt på :total emner.',
                'unread' => 'Du har :unread ulæste svar til abonnerede emner.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Opsig abonnement fra emnet?',
                'title' => 'Opsig abonnement',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Emner',

        'actions' => [
            'login_reply' => 'Log ind for at kunne svare',
            'reply' => 'Svar',
            'reply_with_quote' => 'Citér opslag til svar',
            'search' => 'Søg',
        ],

        'create' => [
            'create_poll' => 'Oprettelse af afstemning',

            'preview' => 'Indlæs forhåndsvisning',

            'create_poll_button' => [
                'add' => 'Opret afstemning',
                'remove' => 'Annullér oprettelsen af afstemning',
            ],

            'poll' => [
                'hide_results' => 'Gem resultater fra afstemningen.',
                'hide_results_info' => 'De vil kun blive vist efter afstemningen er afsluttet.',
                'length' => 'Kør afstemning i',
                'length_days_suffix' => 'dage',
                'length_info' => 'Efterlad blank for at køre afstemning på ubestemt tid',
                'max_options' => 'Muligheder pr. bruger',
                'max_options_info' => 'Dette er antallet af muligheder, en bruger har.',
                'options' => 'Muligheder',
                'options_info' => 'Placer hver mulighed på en ny linje. Du kan lave op til 10 muligheder.',
                'title' => 'Spørgsmål',
                'vote_change' => 'Tillad ændring af stemme.',
                'vote_change_info' => 'Hvis aktiveret, kan brugerne ændre deres stemme.',
            ],
        ],

        'edit_title' => [
            'start' => 'Rediger titel',
        ],

        'index' => [
            'feature_votes' => 'stjerneprioritet',
            'replies' => 'svar',
            'views' => 'visninger',
        ],

        'issue_tag_added' => [
            'to_0' => 'Fjern "tilføjet" tag',
            'to_0_done' => 'Fjern "tilføjet" tag',
            'to_1' => 'Tilføj "tilføjet" tag',
            'to_1_done' => 'Tilføj "tilføjet" tag',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Fjern "tildelt" tag',
            'to_0_done' => 'Fjern "tildelt" tag',
            'to_1' => 'Tilføj "tildelt" tag',
            'to_1_done' => 'Tilføj "tildelt" tag',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Fjern "bekræftet" tag',
            'to_0_done' => 'Fjern "bekræftet" tag',
            'to_1' => 'Tilføj "bekræftet" tag',
            'to_1_done' => 'Tilføj "bekræftet" tag',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Fjern "duplikeret" tag',
            'to_0_done' => 'Fjern "duplikeret" tag',
            'to_1' => 'Tilføj "duplikeret" tag',
            'to_1_done' => 'Tilføj "duplikeret" tag',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Fjern "ugyldigt" tag',
            'to_0_done' => 'Fjern "ugyldigt" tag',
            'to_1' => 'Tilføj "ugyldigt" tag',
            'to_1_done' => 'Tilføj "ugyldigt" tag',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Fjern "løst" tag',
            'to_0_done' => 'Fjern "løst" tag',
            'to_1' => 'Tilføj "løst" tag',
            'to_1_done' => 'Tilføj "løst" tag',
        ],

        'lock' => [
            'is_locked' => 'Dette emne er arkiveret og kan ikke svares',
            'to_0' => 'Oplås emne',
            'to_0_confirm' => 'Lås emne op?',
            'to_0_done' => 'Emnet er blevet låst op',
            'to_1' => 'Lås emne',
            'to_1_confirm' => 'Lås emne?',
            'to_1_done' => 'Emnet er blevet låst',
        ],

        'moderate_move' => [
            'title' => 'Flyt til et andet forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Fjern fra pins',
            'to_0_confirm' => 'Fjern fra pins?',
            'to_0_done' => 'Emnet er blevet fjernet fra pins',
            'to_1' => 'Fastgør emne',
            'to_1_confirm' => 'Pin emne?',
            'to_1_done' => 'Emnet er blevet fastgjort',
            'to_2' => 'Fastgør emne og marker som en service-meddelelse',
            'to_2_confirm' => 'Pin emne og marker som en service-meddelelse?',
            'to_2_done' => 'Emnet er blevet fastgjort og markeret som en service-meddelelse',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Vis slettede opslag',
            'hide' => 'Gem slettede opslag',
        ],

        'show' => [
            'deleted-posts' => 'Slettede Opslag',
            'total_posts' => 'Opslag i alt',

            'feature_vote' => [
                'current' => 'Nuværende Prioritet: +:count',
                'do' => 'Promovér denne anmodning',

                'info' => [
                    '_' => 'Dette er en :feature_request. Foreslag om ny funktionalitet kan kun upvotes af :supporters.',
                    'feature_request' => 'foreslag om ny funktionalitet',
                    'supporters' => 'supportere',
                ],

                'user' => [
                    'count' => '{0} ingen stemmer|{1} :count stemme|[2,*] :count stemmer',
                    'current' => 'Du har :votes stemmer tilbage.',
                    'not_enough' => "Du har ikke flere stemmer tilbage",
                ],
            ],

            'poll' => [
                'edit' => 'Rediger Afstemning',
                'edit_warning' => 'Redigering af afstemningen vil fjerne de nuværende resultater!',
                'vote' => 'Stem',

                'button' => [
                    'change_vote' => 'Ændr stemme',
                    'edit' => 'Rediger afstemning',
                    'view_results' => 'Spring til resultater',
                    'vote' => 'Stem',
                ],

                'detail' => [
                    'end_time' => 'Afstemning slutter :time',
                    'ended' => 'Afstemning sluttede :time',
                    'results_hidden' => 'Resultater vil blive vist efter afstemningen er færdiggjort.',
                    'total' => 'Stemmer i alt: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Ikke gemt',
            'to_watching' => 'Gem',
            'to_watching_mail' => 'Gem med notifikation',
            'tooltip_mail_disable' => 'Notifikationer er slået til. Klik for at slå dem fra',
            'tooltip_mail_enable' => 'Notifikationer er slået fra. Klik for at slå dem til',
        ],
    ],
];
