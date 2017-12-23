<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

    'covers' => [
        'create' => [
            '_' => 'Sæt coverbillede',
            'button' => 'Upload billede',
            'info' => 'Coverstørrelse skal være :dimensions. Du kan også smide dit cover her for at uploade det.',
        ],

        'destroy' => [
            '_' => 'Fjern coverbillede',
            'confirm' => 'Er du sikker på, at du vil fjerne coverbilledet?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nyt svar for emne ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Ingen emner!',
        ],
    ],

    'pinned_topics' => 'Fastgjorte Emner',
    'post' => [
        'confirm_destroy' => 'Slet opslag?',
        'confirm_restore' => 'Gendag opslag?',
        'edited' => 'Sidst redigeret af :user på :when, redigeret i alt :count gange.',
        'posted_at' => 'slået op på :when',
        'actions' => [
            'destroy' => 'Slet opslag',
            'restore' => 'Gendan opslag',
            'edit' => 'Redigér opslag',
        ],
    ],
    'search' => [
        'go_to_post' => 'Gå til opslag',
        'post_number_input' => 'indtast opslagsnummer',
        'total_posts' => ':posts_count opslag i alt',
    ],
    'subforums' => 'Subforums',
    'title' => 'osu!community',
    'slogan' => 'det er farlig at spille alene.',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Skriv opslagets indhold her',
                'title' => 'Klik her for at lave en overskrift',
            ],
            'preview' => 'Forhåndsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Slå op',
        ],
        'go_to_latest' => 'vist seneste opslag',
        'jump' => [
            'enter' => 'klik for at vælge et specifikt opslagsnummer',
            'first' => 'gå til første opslag',
            'last' => 'gå til sidste opslag',
            'next' => 'spring over næste 10 opslag',
            'previous' => 'gå 10 opslag tilbage',
        ],
        'latest_post' => ':when af :user',
        'latest_reply_by' => 'seneste svar af :user',
        'new_topic' => 'Slå nyt emne op',
        'post_edit' => [
            'cancel' => 'Annullér',
            'post' => 'Gem',
        ],
        'post_reply' => 'Slå op',
        'reply_box_placeholder' => 'Skriv her for at svare',
        'started_by' => 'af :user',
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forum Abonnementer',
            'title_compact' => 'forum abonnementer',
            'title_main' => 'Forum <strong>Abonnementer</strong>',

            'box' => [
                'total' => 'Emner Abonneret',
                'unread' => 'Emner med nye svar',
            ],
            'info' => [
                'total' => 'Du abonnerer i alt på :total emner.',
                'unread' => 'Du har :unread ulæste svar til abonnerede emner.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Opsig abonnement fra emne?',
                'title' => 'Opsig abonnement',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Emner',

        'actions' => [
            'reply' => 'Svar',
            'reply_with_quote' => 'Citér opslag til svar',
            'search' => 'Søg',
        ],

        'create' => [
            'create_poll' => 'Oprettelse af afstemning',

            'create_poll_button' => [
                'add' => 'Lav en afstemning',
                'remove' => 'Annullér oprettelsen af afstemning',
            ],

            'poll' => [
                'length' => 'Kør afstemning i',
                'length_days_prefix' => '',
                'length_days_suffix' => 'dage',
                'length_info' => 'Efterlad blank for at køre afstemning på ubestemt tid',
                'max_options' => 'Muligheder pr. bruger',
                'max_options_info' => 'Dette er antallet af muligheder, en bruger har.',
                'options' => 'Muligheder',
                'options_info' => 'Placer hver mulighed på en ny linje. Du kan lave op til 10 muligheder.',
                'title' => 'Spørgsmål',
                'vote_change' => 'Tillad ændring af stemme.',
                'vote_change_info' => 'Hvis aktiveret, kan brugerne undervejs ændre stemme.',
            ],
        ],

        'edit_title' => [
            'start' => 'Ændr titel',
        ],

        'index' => [
            'views' => 'visninger',
            'replies' => 'svar',
        ],

        'issue_tag_added' => [
            'action-0' => 'Fjern "tilføjet" tag',
            'action-1' => 'Tilføj "tilføjet" tag',
            'state-0' => 'Fjern "tilføjet" tag',
            'state-1' => 'Tilføj "tilføjet" tag',
        ],

        'issue_tag_assigned' => [
            'action-0' => 'Fjern "tildelelt" tag',
            'action-1' => 'Tilføj "tildelelt" tag',
            'state-0' => 'Fjern "tildelelt" tag',
            'state-1' => 'Tilføj "tildelelt" tag',
        ],

        'issue_tag_confirmed' => [
            'action-0' => 'Fjern "bekræftet" tag',
            'action-1' => 'Tilføj "bekræftet" tag',
            'state-0' => 'Fjern "bekræftet" tag',
            'state-1' => 'Tilføj "bekræftet" tag',
        ],

        'issue_tag_duplicate' => [
            'action-0' => 'Fjern "duplikeret" tag',
            'action-1' => 'Tilføj "duplikeret" tag',
            'state-0' => 'Fjern "duplikeret" tag',
            'state-1' => 'Tilføj "duplikeret" tag',
        ],

        'issue_tag_invalid' => [
            'action-0' => 'Fjern "ugyldigt" tag',
            'action-1' => 'Tilføj "ugyldigt" tag',
            'state-0' => 'Fjern "ugyldigt" tag',
            'state-1' => 'Tilføj "ugyldigt" tag',
        ],

        'issue_tag_resolved' => [
            'action-0' => 'Fjern "løst" tag',
            'action-1' => 'Tilføj "løst" tag',
            'state-0' => 'Fjern "løst" tag',
            'state-1' => 'Tilføj "løst" tag',
        ],

        'lock' => [
            'is_locked' => 'Dette emne er arkiveret og kan ikke svares til',
            'lock-0' => 'Oplås emne',
            'lock-1' => 'Lås emne',
            'state-0' => 'Emnet er blevet oplåst',
            'state-1' => 'Emnet er blevet låst',
        ],

        'moderate_move' => [
            'title' => 'Flyt til et andet forum',
        ],

        'moderate_pin' => [
            'pin-0' => 'Fjern fastgørelse af emne',
            'pin-1' => 'Fastgør emne',
            'pin-2' => 'Fastgør emne og marker som en meddelelse',
            'state-0' => 'Emnet er blevet løsgjort',
            'state-1' => 'Emnet er blevet fastgjort',
            'state-2' => 'Emnet er blevet fastgjort og markeret som en meddelelse',
        ],

        'show' => [
            'total_posts' => 'Opslag i alt',
            'deleted-posts' => 'Slettede opslag',

            'feature_vote' => [
                'current' => 'Nuværende prioritet: +:count',
                'do' => 'Promovér denne anmodning',

                'user' => [
                    'current' => 'Du har :votes stemmer tilbage.',
                    'count' => '{0} ingen stemmer|{1} :count stemme|[2,*] :count stemmer',
                    'not_enough' => 'Du har ikke flere stemmer tilbage',
                ],
            ],

            'poll' => [
                'vote' => 'Stem',

                'detail' => [
                    'total' => 'Stemmer i alt: :count',
                    'ended' => 'Afstemning sluttede :time',
                    'end_time' => 'Afstemning slutter :time',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Opsagde abonnement for emnet',
            'state-1' => 'Abonnerede på emnet',
            'watch-0' => 'Opsagde abonnement for emnet',
            'watch-1' => 'Abonnerede på emnet',
        ],
    ],

];
