<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Festede emner',
    'slogan' => "det er farlig å spille alene.",
    'subforums' => 'Underforumer',
    'title' => 'osu! forumet',

    'covers' => [
        'edit' => 'Endre omslag',

        'create' => [
            '_' => 'Velg bannerbilde',
            'button' => 'Last opp bilde',
            'info' => 'Størrelsen på banneret burde være :dimensions. Du kan også slippe bildet ditt her for å laste det opp.',
        ],

        'destroy' => [
            '_' => 'Fjern bannerbilde',
            'confirm' => 'Er du sikker på at du vil fjerne bannerbildet?',
        ],
    ],

    'forums' => [
        'forums' => 'Forum',
        'latest_post' => 'Siste Innlegg',

        'index' => [
            'title' => 'Forumindeks',
        ],

        'topics' => [
            'empty' => 'Ingen emner!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marker forum som lest',
        'forums' => 'Marker forumer som lest',
        'busy' => 'Marker som lest...',
    ],

    'post' => [
        'confirm_destroy' => 'Vil du virkelig slette innlegget?',
        'confirm_restore' => 'Vil du virkelig gjenopprette innlegget?',
        'edited' => 'Sist endret av :user :when, redigert :count ganger totalt.',
        'posted_at' => 'lagt ut :when',
        'posted_by_in' => 'lagt ut av :username i :forum',

        'actions' => [
            'destroy' => 'Slett innlegg',
            'edit' => 'Rediger innlegget',
            'report' => 'Rapporter innlegg',
            'restore' => 'Gjenopprett innlegg',
        ],

        'create' => [
            'title' => [
                'reply' => 'Ny kommentar',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited innlegg|:count_delimited innlegg',
            'topic_starter' => 'Trådstarter',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå til innlegg',
        'post_number_input' => 'skriv innleggsnummeret',
        'total_posts' => ':posts_count totale innlegg',
    ],

    'topic' => [
        'confirm_destroy' => 'Vil du virkelig slette emnet?',
        'confirm_restore' => 'Vil du virkelig gjenopprette emnet?',
        'deleted' => 'slettet emne',
        'go_to_latest' => 'vis nyeste innlegg',
        'go_to_unread' => '',
        'has_replied' => 'Du har svart på dette emnet',
        'in_forum' => 'i :forum',
        'latest_post' => ':when av :user',
        'latest_reply_by' => 'siste svar av :user',
        'new_topic' => 'Nytt emne',
        'new_topic_login' => 'Logg inn for å legge inn et nytt emne',
        'post_reply' => 'Innlegg',
        'reply_box_placeholder' => 'Skriv her for å svare',
        'reply_title_prefix' => 'Re',
        'started_by' => 'av :user',
        'started_by_verbose' => 'startet av :user',

        'actions' => [
            'destroy' => 'Slett emne',
            'restore' => 'Gjenopprett emne',
        ],

        'create' => [
            'close' => 'Lukk',
            'preview' => 'Forhåndsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Del',

            'necropost' => [
                'default' => 'Dette emnet har vært inaktivt i en stund. Svar bare hvis du har en spesifikk grunn til å gjøre det.',

                'new_topic' => [
                    '_' => "Dette emne har vært inaktivt i en stund. Hvis du ikke har en spesifikk grunn til å svare her, vennligst :create istedenfor.",
                    'create' => 'opprett et nytt emne',
                ],
            ],

            'placeholder' => [
                'body' => 'Skriv innholdet til innlegget her',
                'title' => 'Klikk her for å sette tittelen',
            ],
        ],

        'jump' => [
            'enter' => 'klikk for å gå til et bestemt innlegg',
            'first' => 'gå til første innlegg',
            'last' => 'gå til siste innlegg',
            'next' => 'hopp over neste 10 innlegg',
            'previous' => 'gå tilbake 10 innlegg',
        ],

        'logs' => [
            '_' => 'Emnelogger',
            'button' => 'Bla gjennom emnelogger',

            'columns' => [
                'action' => 'Handling',
                'date' => 'Dato',
                'user' => 'Bruker',
            ],

            'data' => [
                'add_tag' => 'la til ":tag" taggen',
                'announcement' => 'festet emne og markert som kunngjøring',
                'edit_topic' => 'til :title',
                'fork' => 'fra :topic',
                'pin' => 'festet innlegg',
                'post_operation' => 'lagt ut av :username',
                'remove_tag' => 'fjernet ":tag" taggen',
                'source_forum_operation' => 'fra :forum',
                'unpin' => 'løsnet emne',
            ],

            'no_results' => 'ingen loggføringer ble funnet...',

            'operations' => [
                'delete_post' => 'Slettet innlegg',
                'delete_topic' => 'Slettet emne',
                'edit_topic' => 'Endret emnetittel',
                'edit_poll' => 'Redigerte emneavstemming',
                'fork' => 'Kopierte emne',
                'issue_tag' => 'Annga tag',
                'lock' => 'Låst emne',
                'merge' => 'Flyttet innlegg til dette emnet',
                'move' => 'Flyttet emne',
                'pin' => 'Festet emne',
                'post_edited' => 'Redigerte innlegget',
                'restore_post' => 'Gjenopprettet innlegg',
                'restore_topic' => 'Gjenopprettet emne',
                'split_destination' => 'Flyttet delte innlegg',
                'split_source' => 'Delte innlegg',
                'topic_type' => 'Angi emne type',
                'topic_type_changed' => 'Endret emne type',
                'unlock' => 'Låste opp emnet',
                'unpin' => 'Løsnet emnet',
                'user_lock' => 'Låste eget emne',
                'user_unlock' => 'Låste opp eget emne',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Avbryt',
            'post' => 'Lagre',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forum abonnementer',

            'box' => [
                'total' => 'Abonnerte emner',
                'unread' => 'Emner med nye svar',
            ],

            'info' => [
                'total' => 'Du abonnerte til :total emner.',
                'unread' => 'Du har :unread uleste svar på abonnerte emner.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Avslutt abonnement fra emnet?',
                'title' => 'Avslutt abonnement',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Emner',

        'actions' => [
            'login_reply' => 'Logg inn for å svare',
            'reply' => 'Svar',
            'reply_with_quote' => 'Siter innlegget for svar',
            'search' => 'Søk',
        ],

        'create' => [
            'create_poll' => 'Opprett avstemme',

            'preview' => 'Forhåndsvisning av innlegg',

            'create_poll_button' => [
                'add' => 'Lag en avstemming',
                'remove' => 'Avbryt å skape en avstemming',
            ],

            'poll' => [
                'hide_results' => 'Skjul resultatene til avstemningen.',
                'hide_results_info' => 'De kommer bare til å vises etter at avstemningen konkluderer.',
                'length' => 'Kjør avstemmingen for',
                'length_days_suffix' => 'dager',
                'length_info' => 'La være tom for en uendelig avstemming',
                'max_options' => 'Alternativer pr. bruker',
                'max_options_info' => 'Dette er antall alternativer hver bruker kan velge når de stemmer.',
                'options' => 'Alternativer',
                'options_info' => 'Plasser hvert alternativ på en ny linje. Du kan angi opptil 10 valg.',
                'title' => 'Spørsmål',
                'vote_change' => 'Tillatt gjenstemming.',
                'vote_change_info' => 'Hvis aktivert, kan brukerne endre stemmen sin.',
            ],
        ],

        'edit_title' => [
            'start' => 'Rediger tittel',
        ],

        'index' => [
            'feature_votes' => 'stjerneprioritet',
            'replies' => 'svar',
            'views' => 'visninger',
        ],

        'lock' => [
            'is_locked' => 'Dette emne er låst og kan ikke besvares',
            'to_0' => 'Lås opp emne',
            'to_0_confirm' => 'Lås opp emne?',
            'to_0_done' => 'Emnet har blitt låst opp',
            'to_1' => 'Lås emne',
            'to_1_confirm' => 'Lås emne?',
            'to_1_done' => 'Emne har blitt låst',
        ],

        'moderate_move' => [
            'title' => 'Flytt til et annet forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Løsne emnet',
            'to_0_confirm' => 'Løsne emne?',
            'to_0_done' => 'Emne har blitt løsnet',
            'to_1' => 'Fest emne',
            'to_1_confirm' => 'Fest emne?',
            'to_1_done' => 'Emne har blitt festet',
            'to_2' => 'Fest emne og marker som kunngjøring',
            'to_2_confirm' => 'Fest emne og marker som opplysning?',
            'to_2_done' => 'Emne har blitt festet og markert som en kunngjøring',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Vis slettede innlegg',
            'hide' => 'Skjul slettede innlegg',
        ],

        'show' => [
            'deleted-posts' => 'Slettede innlegg',
            'total_posts' => 'Totalt antall innlegg',

            'feature_vote' => [
                'current' => 'Prioritering: +:count',
                'do' => 'Fremhev denne forespørselen',

                'info' => [
                    '_' => 'Dette er en :feature_request. Funksjonsforespørsler kan bli stemt opp av :supporters.',
                    'feature_request' => 'funksjonsforespørsel',
                    'supporters' => 'supportere',
                ],

                'user' => [
                    'count' => '{0} ingen stemme|{1} :count stemme|[2,*] :count stemmer',
                    'current' => 'Du har :votes igjen.',
                    'not_enough' => "Du har ingen flere gjenværende stemmer",
                ],
            ],

            'poll' => [
                'edit' => 'Avstemning Rediger',
                'edit_warning' => 'Redigering av en avstemming vil fjerne de gjeldene resultatene!',
                'vote' => 'Stem',

                'button' => [
                    'change_vote' => 'Endre stemme',
                    'edit' => 'Rediger avstemming',
                    'view_results' => 'Hopp til resultater',
                    'vote' => 'Stem',
                ],

                'detail' => [
                    'end_time' => 'Avstemming vil ende om :time',
                    'ended' => 'Avstemming endte :time',
                    'results_hidden' => 'Resultater vil bli vist etter at avstemningen slutter.',
                    'total' => 'Total antall stemmer: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Ikke bokmerket',
            'to_watching' => 'Bokmerke',
            'to_watching_mail' => 'Bokmerke med notifikasjon',
            'tooltip_mail_disable' => 'Varslinger er aktivert. Klikk for å deaktivere',
            'tooltip_mail_enable' => 'Varslinger er deaktivert. Klikk for å aktivere',
        ],
    ],
];
