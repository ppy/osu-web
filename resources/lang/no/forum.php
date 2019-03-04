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
    'pinned_topics' => 'Festede emner',
    'slogan' => "det er farlig å spille alene.",
    'subforums' => 'Underforumer',
    'title' => 'osu! forumet',

    'covers' => [
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

    'email' => [
        'new_reply' => '[osu!] Nytt svar for emnet ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Ingen emner!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marker forum som lest',
        'forums' => 'Marker forumer som lest',
        'busy' => 'Marker som lest...',
    ],

    'poll' => [
        'edit_warning' => 'Redigering av avstemming vil fjerne gjeldene resultater!',

        'actions' => [
            'edit' => 'Rediger avstemming',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Virkelig slette innlegget?',
        'confirm_restore' => 'Virkelig gjenopprette innlegget?',
        'edited' => 'Sist endret av :user :when, redigert :count ganger totalt.',
        'posted_at' => 'lagt ut :when',

        'actions' => [
            'destroy' => 'Slett innlegg',
            'restore' => 'Gjenopprett innlegg',
            'edit' => 'Rediger innlegg',
        ],

        'info' => [
            'post_count' => ':count_delimited innlegg|:count_delimited innlegg',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå til innlegg',
        'post_number_input' => 'skriv innleggsnummeret',
        'total_posts' => ':posts_count totale innlegg',
    ],

    'topic' => [
        'deleted' => 'slettet emne',
        'go_to_latest' => 'vis nyeste innlegg',
        'latest_post' => ':when av :user',
        'latest_reply_by' => 'siste svar av :user',
        'new_topic' => 'Nytt emne',
        'new_topic_login' => 'Logg inn for å legge inn et nytt emne',
        'post_reply' => 'Innlegg',
        'reply_box_placeholder' => 'Skriv her for å svare',
        'reply_title_prefix' => 'Re',
        'started_by' => 'av :user',
        'started_by_verbose' => 'startet av :user',

        'create' => [
            'preview' => 'Forhåndsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Innlegg',

            'necropost' => [
                'default' => 'Dette emnet har vært inaktivt i en stund. Skriv et svar bare hvis du har en spesifikk grunn til å gjøre det.',

                'new_topic' => [
                    '_' => "Dette emne har vært inaktivt i en stund. Hvis du ikke har en spesifikk grunn til å svare her, vennligst :create istedenfor.",
                    'create' => 'opprett et nytt emne',
                ],
            ],

            'placeholder' => [
                'body' => 'Skriv innhold til innlegget her',
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

        'post_edit' => [
            'cancel' => 'Avbryt',
            'post' => 'Lagre',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forum Abonnementer',
            'title_compact' => 'forum abonnementer',
            'title_main' => 'Forum <strong>Abonnementer</strong>',

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
            'to_0_done' => 'Emnet har blitt låst opp',
            'to_1' => 'Lås emne',
            'to_1_done' => 'Emne har blitt låst',
        ],

        'moderate_move' => [
            'title' => 'Flytt til et annet forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Løsne emnet',
            'to_0_done' => 'Emne har blitt løsnet',
            'to_1' => 'Fest emne',
            'to_1_done' => 'Emne har blitt festet',
            'to_2' => 'Fest emne og marker som kunngjøring',
            'to_2_done' => 'Emne har blitt festet og markert som en kunngjøring',
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
                'vote' => 'Stem',

                'detail' => [
                    'end_time' => 'Avstemming vil ende om :time',
                    'ended' => 'Avstemming endte :time',
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
