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
    'pinned_topics' => 'Nålade Ämnen',
    'slogan' => 'det är farligt att spela ensam.',
    'subforums' => 'Subforums',
    'title' => 'osu!community',

    'covers' => [
        'create' => [
            '_' => 'Sätt omslags bild',
            'button' => 'Ladda upp bild',
            'info' => 'Omslags storlek bör vara :dimensions. Du kan också släppa din bild här för att ladda upp.',
        ],

        'destroy' => [
            '_' => 'Ta bort omslags bild',
            'confirm' => 'Är du säker på att du vill ta bort omslags bilden?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nytt svar på ämne ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Inga ämnen!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Verkligen radera inlägg?',
        'confirm_restore' => 'Verkligen återställa inlägg?',
        'edited' => 'Senast redigerad av :user den :when, redigerad :count gånger totalt.',
        'posted_at' => 'upplagd :when',

        'actions' => [
            'destroy' => 'Radera inlägg',
            'restore' => 'Återställ inlägg',
            'edit' => 'Redigera inlägg',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå till inlägg',
        'post_number_input' => 'skriv inläggs nummer',
        'total_posts' => ':posts_count inlägg totalt',
    ],

    'topic' => [
        'go_to_latest' => 'visa senaste inlägg',
        'latest_post' => ':when av :user',
        'latest_reply_by' => 'senaste svar av :user',
        'new_topic' => 'Lägg upp nytt ämne',
        'post_reply' => 'Lägg upp',
        'reply_box_placeholder' => 'Tryck här för att svara',
        'started_by' => 'av :user',

        'create' => [
            'preview' => 'Förhandsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Lägg upp',

            'placeholder' => [
                'body' => 'Skriv ditt inläggs innehåll här',
                'title' => 'Klicka här för att sätta titel',
            ],
        ],

        'jump' => [
            'enter' => 'klicka för att skriva ett specifik inläggs nummer',
            'first' => 'gå till första inlägget',
            'last' => 'gå till sista inlägget',
            'next' => 'hoppa över nästa 10 inlägg',
            'previous' => 'gå bakåt 10 inlägg',
        ],

        'post_edit' => [
            'cancel' => 'Avbryt',
            'post' => 'Spara',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forum Prenumerationer',
            'title_compact' => 'forum prenumerationer',
            'title_main' => 'Forum <strong>Prenumerationer</strong>',

            'box' => [
                'total' => 'Ämne prenumererade',
                'unread' => 'Ämnen med nya svar',
            ],

            'info' => [
                'total' => 'Du prenumererade till :total ämnen.',
                'unread' => 'Du har :unread olästa svar till prenumererade ämnen.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Säga upp prenumeration från ämne?',
                'title' => 'Säga upp prenumeration',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Ämnen',

        'actions' => [
            'reply' => 'Svara',
            'reply_with_quote' => 'Citera inlägg för svar',
            'search' => 'Sök',
        ],

        'create' => [
            'create_poll' => 'Skapande av enkät',

            'create_poll_button' => [
                'add' => 'Skapa en enkät',
                'remove' => 'Avbryt skapande av enkät',
            ],

            'poll' => [
                'length' => 'Kör enkät i',
                'length_days_prefix' => '',
                'length_days_suffix' => 'dagar',
                'length_info' => 'Lämna tom för inget avslut av enkät',
                'max_options' => 'Val per användare',
                'max_options_info' => 'Detta är antalet val varje användare kan välja när man röstar.',
                'options' => 'Val',
                'options_info' => 'Sätt varje val på en ny linje. Du kan skriva upp till 10 val.',
                'title' => 'Fråga',
                'vote_change' => 'Tillåt omröstning.',
                'vote_change_info' => 'Om aktiverad, så kan användare ändra sina röster.',
            ],
        ],

        'edit_title' => [
            'start' => 'Ändra titel',
        ],

        'index' => [
            'replies' => 'svar',
            'views' => 'visningar',
        ],

        'issue_tag_added' => [
            'action-0' => 'Ta bort "tillagd" tagg',
            'action-1' => 'Lägg till "tillagd" tagg',
            'state-0' => 'Tog bort "tillagd" tagg',
            'state-1' => 'La till "tillagd" tagg',
        ],

        'issue_tag_assigned' => [
            'action-0' => 'Ta bort "tilldelad" tagg',
            'action-1' => 'Lägg till "tilldelad" tagg',
            'state-0' => 'Tog bort "tilldelad" tagg',
            'state-1' => 'La till "tilldelad" tagg',
        ],

        'issue_tag_confirmed' => [
            'action-0' => 'Ta bort "bekräftad" tagg',
            'action-1' => 'Lägg till "bekräftad" tagg',
            'state-0' => 'Tog bort "bekräftad" tagg',
            'state-1' => 'La till "bekräftad" tagg',
        ],

        'issue_tag_duplicate' => [
            'action-0' => 'Ta bort "duplikat" tagg',
            'action-1' => 'Lägg till "duplikat" tagg',
            'state-0' => 'Tog bort "duplikat" tagg',
            'state-1' => 'La till "duplikat" tagg',
        ],

        'issue_tag_invalid' => [
            'action-0' => 'Ta bort "ogiltlig" tagg',
            'action-1' => 'Lägg till "ogiltlig" tagg',
            'state-0' => 'Tog bort "ogiltlig" tagg',
            'state-1' => 'La till "ogiltlig" tagg',
        ],

        'issue_tag_resolved' => [
            'action-0' => 'Ta bort "löst" tagg',
            'action-1' => 'Lägg till "löst" tagg',
            'state-0' => 'Tog bort "löst" tagg',
            'state-1' => 'La till "löst" tagg',
        ],

        'lock' => [
            'is_locked' => 'Detta ämne är låst och kan ej svaras på',
            'lock-0' => 'Lås upp ämne',
            'lock-1' => 'Lås ämne',
            'state-0' => 'Ämne har blivit upplåst',
            'state-1' => 'Ämne har blivit låst',
        ],

        'moderate_move' => [
            'title' => 'Flytta till annat forum',
        ],

        'moderate_pin' => [
            'pin-0' => 'Ta bort nålat ämne',
            'pin-1' => 'Nåla ämne',
            'pin-2' => 'Nåla ämne och markera som meddelande',
            'state-0' => 'Nål på ämne har tagits bort',
            'state-1' => 'Ämne har blivit nålat',
            'state-2' => 'Ämne har blivit nålat och markerat som meddelande',
        ],

        'show' => [
            'deleted-posts' => 'Raderade Inlägg',
            'total_posts' => 'Totala Inlägg',

            'feature_vote' => [
                'current' => 'Nuvarande Prioritet: +:count',
                'do' => 'Uppmuntra denna begäran',

                'user' => [
                    'count' => '{0} ingen röst|{1} :count röst|[2,*] :count röster',
                    'current' => 'Du har :votes kvar.',
                    'not_enough' => 'Du har inga röster kvar',
                ],
            ],

            'poll' => [
                'vote' => 'Rösta',

                'detail' => [
                    'end_time' => 'Enkät kommer avslutas :time',
                    'ended' => 'Enkät avslutades :time',
                    'total' => 'Totala röster: :count',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Prenumeration sades upp från ämne',
            'state-1' => 'Prenumererade på ämne',
            'watch-0' => 'Säg upp prenumeration från ämne',
            'watch-1' => 'Prenumerera på ämne',
        ],
    ],
];
