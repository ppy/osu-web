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
        'posted_by' => '',

        'actions' => [
            'destroy' => 'Slett innlegg',
            'edit' => 'Rediger innlegget',
            'report' => '',
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
        'confirm_destroy' => '',
        'confirm_restore' => '',
        'deleted' => 'slettet emne',
        'go_to_latest' => 'vis nyeste innlegg',
        'has_replied' => '',
        'in_forum' => '',
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
            'destroy' => '',
            'restore' => '',
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
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
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

        'issue_tag_added' => [
            'to_0' => 'Fjern "lagt til" merknaden',
            'to_0_done' => 'Fjernet "lagt til" merknaden',
            'to_1' => 'Legg til "lagt til" merknad',
            'to_1_done' => 'Lagt til "lagt til" merknad',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Fjern "tilordnet" merknad',
            'to_0_done' => 'Fjernet "tilordnet" merknaden',
            'to_1' => 'Legg til "tilordnet" merknad',
            'to_1_done' => 'Lagt til "tilordnet" merknad',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Fjern "bekreftet" merknad',
            'to_0_done' => 'Fjernet "bekreftet" merknaden',
            'to_1' => 'Legg til "bekreftet" merknad',
            'to_1_done' => 'Lagt til "bekreftet" merknad',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Fjern "kopi" merknad',
            'to_0_done' => 'Fjernet "kopi" merknaden',
            'to_1' => 'Legg til "kopi" merknad',
            'to_1_done' => 'Lagt til "kopi" merknad',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Fjern "ugyldig" merknad',
            'to_0_done' => 'Fjernet "ugyldig" merknaden',
            'to_1' => 'Legg til "ugyldig" merknad',
            'to_1_done' => 'Lagt til "ugyldig" merknad',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Fjern "løst" merknaden',
            'to_0_done' => 'Fjernet "løst" merknaden',
            'to_1' => 'Legg til "løst" merknad',
            'to_1_done' => 'Lagt til "løst" merknad',
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
