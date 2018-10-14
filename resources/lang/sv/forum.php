<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'slogan' => "det är farligt att spela ensam.",
    'subforums' => 'Subforums',
    'title' => 'osu! forumen',

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
        'deleted' => 'raderat ämne',
        'go_to_latest' => 'visa senaste inlägg',
        'latest_post' => ':when av :user',
        'latest_reply_by' => 'senaste svar av :user',
        'new_topic' => 'Lägg upp nytt ämne',
        'new_topic_login' => 'Logga in för att lägga upp ett nytt ämne',
        'post_reply' => 'Lägg upp',
        'reply_box_placeholder' => 'Tryck här för att svara',
        'reply_title_prefix' => 'Åter',
        'started_by' => 'av :user',
        'started_by_verbose' => 'startad av :user',

        'create' => [
            'preview' => 'Förhandsvisning',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Skriv',
            'submit' => 'Lägg upp',

            'necropost' => [
                'default' => 'Detta ämne har varit inaktiv ett tag. Skapa endast ett inlägg om du har en särskild skäl till att göra så.',

                'new_topic' => [
                    '_' => "Detta ämne har varit inaktiv ett tag. Om du inte har ett särskilt skäl att lägga upp här, vänligen :create istället.",
                    'create' => 'skapa ett nytt ämne',
                ],
            ],

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
            'login_reply' => 'Logga in för att Svara',
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
            'views' => 'visningar',
            'replies' => 'svar',
        ],

        'issue_tag_added' => [
            'to_0' => 'Ta bort "tillagd" tagg',
            'to_0_done' => 'Tog bort "tillagd" tagg',
            'to_1' => 'Lägg till "tillagd" tagg',
            'to_1_done' => 'La till "tillagd" tagg',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Ta bort "tilldelad" tagg',
            'to_0_done' => 'Tog bort "tilldelad" tagg',
            'to_1' => 'Lägg till "tilldelad" tagg',
            'to_1_done' => 'La till "tilldelad" tagg',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Ta bort "bekräftad" tagg',
            'to_0_done' => 'Tog bort "bekräftad" tagg',
            'to_1' => 'Lägg till "bekräftad" tagg',
            'to_1_done' => 'La till "bekräftad" tagg',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Ta bort "duplikat" tagg',
            'to_0_done' => 'Tog bort "duplikat" tagg',
            'to_1' => 'Lägg till "duplikat" tagg',
            'to_1_done' => 'La till "duplikat" tagg',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Ta bort "ogiltlig" tagg',
            'to_0_done' => 'Tog bort "ogiltlig" tagg',
            'to_1' => 'Lägg till "ogiltlig" tagg',
            'to_1_done' => 'La till "ogiltlig" tagg',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Ta bort "löst" tagg',
            'to_0_done' => 'Tog bort "löst" tagg',
            'to_1' => 'Lägg till "löst" tagg',
            'to_1_done' => 'La till "löst" tagg',
        ],

        'lock' => [
            'is_locked' => 'Detta ämne är låst och kan ej svaras på',
            'to_0' => 'Lås upp ämne',
            'to_0_done' => 'Ämne har blivit upplåst',
            'to_1' => 'Lås ämne',
            'to_1_done' => 'Ämne har blivit låst',
        ],

        'moderate_move' => [
            'title' => 'Flytta till annat forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Ta bort nålat ämne',
            'to_0_done' => 'Nål på ämne har tagits bort',
            'to_1' => 'Nåla ämne',
            'to_1_done' => 'Ämne har blivit nålat',
            'to_2' => 'Nåla ämne och markera som meddelande',
            'to_2_done' => 'Ämne har blivit nålat och markerat som meddelande',
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
                    'not_enough' => "Du har inga röster kvar",
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
            'to_not_watching' => 'Inte bokmärkt',
            'to_watching' => 'Bokmärk',
            'to_watching_mail' => 'Bokmärke med notifikation',
            'mail_disable' => 'Stäng av notifikationer',
        ],
    ],
];
