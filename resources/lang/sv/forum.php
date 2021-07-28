<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Nålade Ämnen',
    'slogan' => "det är farligt att spela ensam.",
    'subforums' => 'Subforums',
    'title' => 'osu! forumen',

    'covers' => [
        'edit' => 'Redigera omslag',

        'create' => [
            '_' => 'Välj omslagsbild',
            'button' => 'Ladda upp bild',
            'info' => 'Omslagsstorlek bör vara :dimensions. Du kan också släppa din bild här för att ladda upp.',
        ],

        'destroy' => [
            '_' => 'Ta bort omslagsbild',
            'confirm' => 'Är du säker på att du vill ta bort omslagsbilden?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Senaste inlägg',

        'index' => [
            'title' => 'Forumets index',
        ],

        'topics' => [
            'empty' => 'Inga ämnen!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Markera forumet som läst',
        'forums' => 'Markera forumen som läst',
        'busy' => 'Markera som läst....',
    ],

    'post' => [
        'confirm_destroy' => 'Vill du verkligen radera inlägget?',
        'confirm_restore' => 'Vill du verkligen återställa inlägget?',
        'edited' => 'Senast redigerad av :user :when, redigerad :count gånger totalt.',
        'posted_at' => 'upplagd :when',
        'posted_by' => 'upplagd av :username',

        'actions' => [
            'destroy' => 'Radera inlägg',
            'edit' => 'Redigera inlägg',
            'report' => 'Anmäl inlägg',
            'restore' => 'Återställ inlägg',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nytt svar',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited inlägg|:count_delimited inlägg',
            'topic_starter' => 'Ämnestartare ',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gå till inlägg',
        'post_number_input' => 'skriv inläggsnummer',
        'total_posts' => ':posts_count inlägg totalt',
    ],

    'topic' => [
        'confirm_destroy' => 'Vill du verkligen radera ämnet?',
        'confirm_restore' => 'Vill du verkligen återställa ämnet?',
        'deleted' => 'raderat ämne',
        'go_to_latest' => 'visa senaste inlägg',
        'has_replied' => 'Du har svarat på detta ämne',
        'in_forum' => 'i :forum',
        'latest_post' => ':when av :user',
        'latest_reply_by' => 'senaste svar av :user',
        'new_topic' => 'Lägg upp nytt ämne',
        'new_topic_login' => 'Logga in för att lägga upp ett nytt ämne',
        'post_reply' => 'Skicka',
        'reply_box_placeholder' => 'Skriv här för att svara',
        'reply_title_prefix' => 'Åter',
        'started_by' => 'av :user',
        'started_by_verbose' => 'startad av :user',

        'actions' => [
            'destroy' => 'Ta bort ämne',
            'restore' => 'Återställ ämne',
        ],

        'create' => [
            'close' => 'Stäng',
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
            'title_compact' => 'forum prenumerationer',

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
            'login_reply' => 'Logga in för att svara',
            'reply' => 'Svara',
            'reply_with_quote' => 'Citera inlägg för svar',
            'search' => 'Sök',
        ],

        'create' => [
            'create_poll' => 'Skapande av enkät',

            'preview' => 'Skicka förhandsvisningen',

            'create_poll_button' => [
                'add' => 'Skapa en enkät',
                'remove' => 'Avbryt skapande av enkät',
            ],

            'poll' => [
                'hide_results' => 'Dölj resultaten av enkäten.',
                'hide_results_info' => 'De kommer att visas först efter enkätens avslutande.',
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
            'feature_votes' => 'stjärnprioritet',
            'replies' => 'svar',
            'views' => 'visningar',
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
            'to_0_confirm' => 'Lås upp ämnet?',
            'to_0_done' => 'Ämne har blivit upplåst',
            'to_1' => 'Lås ämne',
            'to_1_confirm' => 'Lås ämnet?',
            'to_1_done' => 'Ämne har blivit låst',
        ],

        'moderate_move' => [
            'title' => 'Flytta till annat forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Ta bort nålat ämne',
            'to_0_confirm' => 'Lossa ämnet?',
            'to_0_done' => 'Nål på ämne har tagits bort',
            'to_1' => 'Nåla ämne',
            'to_1_confirm' => 'Fäst ämnet?',
            'to_1_done' => 'Ämne har blivit nålat',
            'to_2' => 'Nåla ämne och markera som meddelande',
            'to_2_confirm' => 'Fäst ämnet och markera det som meddelande?',
            'to_2_done' => 'Ämne har blivit nålat och markerat som meddelande',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Visa raderade inlägg',
            'hide' => 'Dölj raderade inlägg',
        ],

        'show' => [
            'deleted-posts' => 'Raderade Inlägg',
            'total_posts' => 'Totala Inlägg',

            'feature_vote' => [
                'current' => 'Nuvarande Prioritet: +:count',
                'do' => 'Uppmuntra denna begäran',

                'info' => [
                    '_' => 'Detta är en :feature_request. Funktionsförfrågningar kan röstas upp av :supporters.',
                    'feature_request' => 'funktionönskemål',
                    'supporters' => 'supportrar',
                ],

                'user' => [
                    'count' => '{0} ingen röst|{1} :count röst|[2,*] :count röster',
                    'current' => 'Du har :votes kvar.',
                    'not_enough' => "Du har inga röster kvar",
                ],
            ],

            'poll' => [
                'edit' => 'Redigera enkät',
                'edit_warning' => 'Redigering av en enkät kommer att ta bort det aktuella resultatet!',
                'vote' => 'Rösta',

                'button' => [
                    'change_vote' => 'Ändra röst',
                    'edit' => 'Redigera enkät',
                    'view_results' => 'Hoppa till resultaten',
                    'vote' => 'Rösta',
                ],

                'detail' => [
                    'end_time' => 'Enkät kommer avslutas :time',
                    'ended' => 'Enkät avslutades :time',
                    'results_hidden' => 'Resultaten kommer att visas efter enkätröstningens slut.',
                    'total' => 'Totala röster: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Inte bokmärkt',
            'to_watching' => 'Bokmärk',
            'to_watching_mail' => 'Bokmärke med notifikation',
            'tooltip_mail_disable' => 'Avisering är aktiverad. Klicka för att inaktivera',
            'tooltip_mail_enable' => 'Avisering är inaktiverad. Klicka för att aktivera',
        ],
    ],
];
