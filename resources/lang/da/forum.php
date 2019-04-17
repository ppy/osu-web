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
    'pinned_topics' => 'Pinned Emner',
    'slogan' => "det er farlig at spille alene.",
    'subforums' => 'Subforums',
    'title' => 'osu! forums',

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

    'mark_as_read' => [
        'forum' => 'Marker forum som læst',
        'forums' => 'Marker forums som læst',
        'busy' => 'Marker som læst...',
    ],

    'poll' => [
        'edit_warning' => 'Redigering af en afstemning vil fjerne de aktuelle resultater!',

        'actions' => [
            'edit' => 'Rediger afstemning',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Slet opslag?',
        'confirm_restore' => 'Gendan opslag?',
        'edited' => 'Sidst redigeret af :user den :when, redigeret i alt :count gange.',
        'posted_at' => 'slået op på :when',

        'actions' => [
            'destroy' => 'Slet opslag',
            'restore' => 'Gendan opslag',
            'edit' => 'Rediger opslag',
        ],

        'info' => [
            'post_count' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå til opslag',
        'post_number_input' => 'indtast opslagsnummer',
        'total_posts' => ':posts_count opslag i alt',
    ],

    'topic' => [
        'deleted' => 'slettede emne',
        'go_to_latest' => 'vis seneste opslag',
        'latest_post' => ':when af :user',
        'latest_reply_by' => 'seneste svar af :user',
        'new_topic' => 'Slå nyt emne op',
        'new_topic_login' => 'Log ind for at kunne lave et nyt emne',
        'post_reply' => 'Slå op',
        'reply_box_placeholder' => 'Skriv her for at svare',
        'reply_title_prefix' => 'Re',
        'started_by' => 'af :user',
        'started_by_verbose' => 'startet af :user',

        'create' => [
            'preview' => 'Forhåndsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Slå op',

            'necropost' => [
                'default' => 'Dette emne har været inaktiv i et stykke tid. Kun post her hvis du har en særlig grund til.',

                'new_topic' => [
                    '_' => "Dette opslag har været inaktiv i et stykke tid. Hvis du ikke har en specifik grund til at sende noget, så :create et nyt opslag istedet.",
                    'create' => 'lav et nyt emne',
                ],
            ],

            'placeholder' => [
                'body' => 'Skriv opslagets indhold her',
                'title' => 'Klik her for at lave en overskrift',
            ],
        ],

        'jump' => [
            'enter' => 'klik for at vælge et specifikt opslagsnummer',
            'first' => 'gå til det første opslag',
            'last' => 'gå til det sidste opslag',
            'next' => 'spring over de næste 10 opslag',
            'previous' => 'gå 10 opslag tilbage',
        ],

        'post_edit' => [
            'cancel' => 'Annullér',
            'post' => 'Gem',
        ],
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

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Lav en afstemning',
                'remove' => 'Annullér oprettelsen af afstemning',
            ],

            'poll' => [
                'length' => 'Kør afstemning i',
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
            'start' => 'Rediger titel',
        ],

        'index' => [
            'feature_votes' => 'stjerne prioritet',
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
            'to_0' => 'Fjern "tildelelt" tag',
            'to_0_done' => 'Fjern "tildelelt" tag',
            'to_1' => 'Tilføj "tildelelt" tag',
            'to_1_done' => 'Tilføj "tildelelt" tag',
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
            'is_locked' => 'Dette emne er arkiveret og kan ikke svares til',
            'to_0' => 'Oplås emne',
            'to_0_done' => 'Emnet er blevet oplåst',
            'to_1' => 'Lås emne',
            'to_1_done' => 'Emnet er blevet låst',
        ],

        'moderate_move' => [
            'title' => 'Flyt til et andet forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Fjern fra pins',
            'to_0_done' => 'Emnet er blevet fjernet fra pins',
            'to_1' => 'Fastgør emne',
            'to_1_done' => 'Emnet er blevet pinned',
            'to_2' => 'pin emne og marker som en meddelelse',
            'to_2_done' => 'Emnet er blevet pinned og markeret som en meddelelse',
        ],

        'show' => [
            'deleted-posts' => 'Slettede opslag',
            'total_posts' => 'Opslag i alt',

            'feature_vote' => [
                'current' => 'Nuværende prioritet: +:count',
                'do' => 'Promovér denne anmodning',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => 'supportere',
                ],

                'user' => [
                    'count' => '{0} ingen stemmer|{1} :count stemme|[2,*] :count stemmer',
                    'current' => 'Du har :votes stemmer tilbage.',
                    'not_enough' => "Du har ikke flere stemmer tilbage",
                ],
            ],

            'poll' => [
                'vote' => 'Stem',

                'detail' => [
                    'end_time' => 'Afstemning slutter :time',
                    'ended' => 'Afstemning sluttede :time',
                    'total' => 'Stemmer i alt: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Ikke bogmærked',
            'to_watching' => 'Bogmærke',
            'to_watching_mail' => 'Bogmærk med notifikation',
            'tooltip_mail_disable' => 'Notifikationer er slået til. Klik for at slå dem fra',
            'tooltip_mail_enable' => 'Notifikationer er slået fra. Klik for at slå dem til',
        ],
    ],
];
