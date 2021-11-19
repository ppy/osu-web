<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Angepinnte Threads',
    'slogan' => "es ist gefährlich, alleine zu spielen.",
    'subforums' => 'Subforen',
    'title' => 'Foren',

    'covers' => [
        'edit' => 'Cover bearbeiten',

        'create' => [
            '_' => 'Banner festlegen',
            'button' => 'Bild hochladen',
            'info' => 'Das Bild sollte :dimensions groß sein. Hier kannst du es auch ablegen, um es hochzuladen.',
        ],

        'destroy' => [
            '_' => 'Banner entfernen',
            'confirm' => 'Bist du dir sicher, dass du das Banner entfernen willst?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Neuester Beitrag',

        'index' => [
            'title' => 'Forum-Startseite',
        ],

        'topics' => [
            'empty' => 'Keine Threads!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Forum als gelesen markieren',
        'forums' => 'Foren als gelesen markieren',
        'busy' => 'Als gelesen markieren...',
    ],

    'post' => [
        'confirm_destroy' => 'Beitrag wirklich entfernen?',
        'confirm_restore' => 'Beitrag wirklich wiederherstellen?',
        'edited' => 'Zuletzt von :user :when bearbeitet, insgesamt :count_delimited Mal bearbeitet.',
        'posted_at' => 'erstellt :when',
        'posted_by' => 'gepostet von :username',

        'actions' => [
            'destroy' => 'Beitrag löschen',
            'edit' => 'Beitrag bearbeiten',
            'report' => 'Beitrag melden',
            'restore' => 'Beitrag wiederherstellen',
        ],

        'create' => [
            'title' => [
                'reply' => 'Neue Antwort',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited Beitrag | :count_delimited Beiträge',
            'topic_starter' => 'Thread-Starter',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gehe zu Beitrag',
        'post_number_input' => 'beitragsnummer hier eingeben',
        'total_posts' => 'Insgesamt :posts_count Beiträge',
    ],

    'topic' => [
        'confirm_destroy' => 'Thread wirklich löschen?',
        'confirm_restore' => 'Thread wirklich wiederherstellen?',
        'deleted' => 'gelöschter thread',
        'go_to_latest' => 'letzten beitrag anschauen',
        'has_replied' => 'Du hast auf diesen Thread geantwortet',
        'in_forum' => 'in :forum',
        'latest_post' => ':when von :user',
        'latest_reply_by' => 'letzte antwort von :user',
        'new_topic' => 'Neuen Thread erstellen',
        'new_topic_login' => 'Melde dich an, um einen neuen Thread zu erstellen',
        'post_reply' => 'Antworten',
        'reply_box_placeholder' => 'Zum Antworten hier Text eingeben',
        'reply_title_prefix' => 'Re',
        'started_by' => 'von :user',
        'started_by_verbose' => 'gestartet von :user',

        'actions' => [
            'destroy' => 'Thread löschen',
            'restore' => 'Thread wiederherstellen',
        ],

        'create' => [
            'close' => 'Schließen',
            'preview' => 'Vorschau',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Bearbeiten',
            'submit' => 'Erstellen',

            'necropost' => [
                'default' => 'Dieser Thread ist seit längerer Zeit inaktiv. Poste nur, wenn du einen wichtigen Grund dazu hast.',

                'new_topic' => [
                    '_' => "Dieser Thread ist seit längerer Zeit inaktiv. Wenn du keinen wichtigen Grund zum Posten hast, :create stattdessen.",
                    'create' => 'erstelle einen neuen Thread',
                ],
            ],

            'placeholder' => [
                'body' => 'Inhalt hier eingeben',
                'title' => 'Hier klicken, um den Titel festzulegen',
            ],
        ],

        'jump' => [
            'enter' => 'hier klicken, um eine beitragsnummer einzugeben',
            'first' => 'zum ersten beitrag',
            'last' => 'zum letzten beitrag',
            'next' => '10 beiträge überspringen',
            'previous' => '10 beiträge zurückgehen',
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
            'cancel' => 'Abbrechen',
            'post' => 'Speichern',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forenabos',

            'box' => [
                'total' => 'Abonnierte Threads',
                'unread' => 'Threads mit ungelesenen Antworten',
            ],

            'info' => [
                'total' => 'Du hast :total Threads abonniert.',
                'unread' => 'Du hast :unread ungelesene Antworten in abonnierten Threads.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Thread deabonnieren?',
                'title' => 'Deabonnieren',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Threads',

        'actions' => [
            'login_reply' => 'Melde dich an, um zu antworten',
            'reply' => 'Antworten',
            'reply_with_quote' => 'Beitrag in der Antwort zitieren',
            'search' => 'Suchen',
        ],

        'create' => [
            'create_poll' => 'Abstimmung erstellen',

            'preview' => 'Beitragsvorschau',

            'create_poll_button' => [
                'add' => 'Erstelle eine Abstimmung',
                'remove' => 'Brich die Abstimmungserstellung ab',
            ],

            'poll' => [
                'hide_results' => 'Ergebnisse der Umfrage verstecken.',
                'hide_results_info' => 'Sie werden erst nach Abschluss der Umfrage angezeigt.',
                'length' => 'Abstimmung offen für',
                'length_days_suffix' => 'Tage',
                'length_info' => 'Nichts eingeben für eine nie endende Abstimmung',
                'max_options' => 'Antworten pro Benutzer',
                'max_options_info' => 'Dies ist die Anzahl an Antworten, die jeder maximal Benutzer wählen kann.',
                'options' => 'Antworten',
                'options_info' => 'Platziere jede Antwort in einer neuen Zeile. Du kannst maximal 10 Antworten eingeben.',
                'title' => 'Frage',
                'vote_change' => 'Erlaube Antwortänderungen.',
                'vote_change_info' => 'Wenn aktiv, können Benutzer ihre Antworten ändern.',
            ],
        ],

        'edit_title' => [
            'start' => 'Titel bearbeiten',
        ],

        'index' => [
            'feature_votes' => 'Sternpriorität',
            'replies' => 'Antworten',
            'views' => 'Aufrufe',
        ],

        'issue_tag_added' => [
            'to_0' => 'Tag "added" entfernen',
            'to_0_done' => 'Tag "added" entfernt',
            'to_1' => 'Tag "added" hinzufügen',
            'to_1_done' => 'Tag "added" hinzugefügt',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Tag "assigned" entfernen',
            'to_0_done' => 'Tag "assigned" entfernt',
            'to_1' => 'Tag "assigned" hinzufügen',
            'to_1_done' => 'Tag "assigned" hinzugefügt',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Tag "confirmed" entfernen',
            'to_0_done' => 'Tag "confirmed" entfernt',
            'to_1' => 'Tag "confirmed" hinzufügen',
            'to_1_done' => 'Tag "confirmed" hinzugefügt',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Tag "duplicate" entfernen',
            'to_0_done' => 'Tag "duplicate" entfernt',
            'to_1' => 'Tag "duplicate" hinzufügen',
            'to_1_done' => 'Tag "duplicate" hinzugefügt',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Tag "invalid" entfernen',
            'to_0_done' => 'Tag "invalid" entfernt',
            'to_1' => 'Tag "invalid" hinzufügen',
            'to_1_done' => 'Tag "invalid" hinzugefügt',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Tag "resolved" entfernen',
            'to_0_done' => 'Tag "resolved" entfernt',
            'to_1' => 'Tag "resolved" hinzufügen',
            'to_1_done' => 'Tag "resolved" hinzugefügt',
        ],

        'lock' => [
            'is_locked' => 'Dieser Thread ist gesperrt und erlaubt keine weiteren Antworten',
            'to_0' => 'Thread entsperren',
            'to_0_confirm' => 'Thread entsperren?',
            'to_0_done' => 'Thread wurde entsperrt',
            'to_1' => 'Thread sperren',
            'to_1_confirm' => 'Thread sperren?',
            'to_1_done' => 'Thread wurde gesperrt',
        ],

        'moderate_move' => [
            'title' => 'In ein anderes Forum bewegen',
        ],

        'moderate_pin' => [
            'to_0' => 'Thread von den angepinnten Threads lösen',
            'to_0_confirm' => 'Thread lösen?',
            'to_0_done' => 'Thread wurde von den angepinnten Threads entfernt',
            'to_1' => 'Thread anpinnen',
            'to_1_confirm' => 'Thread anpinnen?',
            'to_1_done' => 'Thread wurde angepinnt',
            'to_2' => 'Thread anpinnen und als Ankündigung markieren',
            'to_2_confirm' => 'Thread anpinnen und als Ankündigung markieren?',
            'to_2_done' => 'Thread wurde angepinnt und als Ankündigung markiert',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Gelöschte Beiträge anzeigen',
            'hide' => 'Gelöschte Beiträge ausblenden',
        ],

        'show' => [
            'deleted-posts' => 'Gelöschte Beiträge',
            'total_posts' => 'Beiträge insgesamt',

            'feature_vote' => [
                'current' => 'Aktuelle Priorität: +:count',
                'do' => 'Priorität hinzufügen',

                'info' => [
                    '_' => 'Dies ist ein :feature_request. Über Funktionsvorschläge können nur :supporters abstimmen.',
                    'feature_request' => 'Funktionsvorschlag',
                    'supporters' => 'Unterstützer',
                ],

                'user' => [
                    'count' => '{0} Keine Stimme|{1} :count_delimited Stimme|[2,*] :count_delimited Stimmen',
                    'current' => 'Du hast noch :votes.',
                    'not_enough' => "Du hast keine Stimmen mehr",
                ],
            ],

            'poll' => [
                'edit' => 'Umfrage bearbeiten',
                'edit_warning' => 'Bearbeiten der Umfrage wird die derzeitigen Ergebnisse entfernen!',
                'vote' => 'Abstimmung',

                'button' => [
                    'change_vote' => 'Stimme ändern',
                    'edit' => 'Umfrage bearbeiten',
                    'view_results' => 'Zu Ergebnissen springen',
                    'vote' => 'Abstimmen',
                ],

                'detail' => [
                    'end_time' => 'Abstimmung endet am :time',
                    'ended' => 'Abstimmung beendet am :time',
                    'results_hidden' => 'Ergebnisse werden nach dem Abstimmungsende angezeigt.',
                    'total' => 'Stimmen insgesamt: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Kein Lesezeichen gesetzt',
            'to_watching' => 'Lesezeichen setzen',
            'to_watching_mail' => 'Lesezeichen setzen und benachrichtigt werden',
            'tooltip_mail_disable' => 'Benachrichtigungen sind aktiviert. Klicken zum Deaktivieren',
            'tooltip_mail_enable' => 'Benachrichtigungen sind deaktiviert. Klicken zum Aktivieren',
        ],
    ],
];
