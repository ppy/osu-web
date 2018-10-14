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
    'pinned_topics' => 'Angepinnte Threads',
    'slogan' => "es ist gefährlich, alleine zu spielen.",
    'subforums' => 'Subforen',
    'title' => 'osu! Foren',

    'covers' => [
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

    'email' => [
        'new_reply' => '[osu!] Neue Antwort auf Thread ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Keine Threads!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Post entfernen?',
        'confirm_restore' => 'Post wiederherstellen?',
        'edited' => 'Zuletzt von :user :when bearbeitet, insgesamt :count Mal bearbeitet.',
        'posted_at' => 'erstellt :when',

        'actions' => [
            'destroy' => 'Post löschen',
            'restore' => 'Post wiederherstellen',
            'edit' => 'Post bearbeiten',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gehe zu Post',
        'post_number_input' => 'postnummer hier eingeben',
        'total_posts' => 'Insgesamt :posts_count Posts',
    ],

    'topic' => [
        'deleted' => 'gelöschter thread',
        'go_to_latest' => 'letzten post anschauen',
        'latest_post' => ':when von :user',
        'latest_reply_by' => 'letzte antwort von :user',
        'new_topic' => 'Neuen Thread erstellen',
        'new_topic_login' => 'Melde dich an, um einen neuen Thread zu erstellen',
        'post_reply' => 'Antworten',
        'reply_box_placeholder' => 'Zum Antworten hier Text eingeben',
        'reply_title_prefix' => 'Re',
        'started_by' => 'von :user',
        'started_by_verbose' => 'gestartet von :user',

        'create' => [
            'preview' => 'Vorschau',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Bearbeiten',
            'submit' => 'Erstellen',

            'necropost' => [
                'default' => 'Dieser Beitrag ist seit längerer Zeit inaktiv. Poste nur, wenn du einen wichtigen Grund dazu hast.',

                'new_topic' => [
                    '_' => "Dieser Beitrag ist seit längerer Zeit inaktiv. Wenn du keinen wichtigen Grund zum posten hast, dann :create hier einen neuen.",
                    'create' => 'Erstelle einen neuen Beitrag',
                ],
            ],

            'placeholder' => [
                'body' => 'Inhalt hier eingeben',
                'title' => 'Hier klicken, um den Titel festzulegen',
            ],
        ],

        'jump' => [
            'enter' => 'hier klicken, um eine postnummer einzugeben',
            'first' => 'zum ersten post',
            'last' => 'zum letzten post',
            'next' => '10 posts überspringen',
            'previous' => '10 posts zurückgehen',
        ],

        'post_edit' => [
            'cancel' => 'Abbrechen',
            'post' => 'Speichern',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forenabonnements',
            'title_compact' => 'forenabos',
            'title_main' => 'Foren<strong>abonnenements</strong>',

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
            'reply_with_quote' => 'Post in der Antwort zitieren',
            'search' => 'Suchen',
        ],

        'create' => [
            'create_poll' => 'Abstimmung erstellen',

            'create_poll_button' => [
                'add' => 'Erstelle eine Abstimmung',
                'remove' => 'Brich die Abstimmungserstellung ab',
            ],

            'poll' => [
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
            'views' => 'Aufrufe',
            'replies' => 'Antworten',
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
            'to_0_done' => 'Thread wurde entsperrt',
            'to_1' => 'Thread sperren',
            'to_1_done' => 'Thread wurde gesperrt',
        ],

        'moderate_move' => [
            'title' => 'In ein anderes Forum bewegen',
        ],

        'moderate_pin' => [
            'to_0' => 'Thread von den angepinnten Threads entfernen',
            'to_0_done' => 'Thread wurde von den angepinnten Threads entfernt',
            'to_1' => 'Thread anpinnen',
            'to_1_done' => 'Thread wurde angepinnt',
            'to_2' => 'Thread anpinnen und als Ankündigung markieren',
            'to_2_done' => 'Thread wurde angepinnt und als Ankündigung markiert',
        ],

        'show' => [
            'deleted-posts' => 'Gelöschte Posts',
            'total_posts' => 'Posts insgesamt',

            'feature_vote' => [
                'current' => 'Aktuelle Priorität: +:count',
                'do' => 'Priorität hinzufügen',

                'user' => [
                    'count' => '{0} Keine Stimme|{1} :count Stimme|[2,*] :count Stimmen',
                    'current' => 'Du hast noch :votes.',
                    'not_enough' => "Du hast keine Stimmen mehr",
                ],
            ],

            'poll' => [
                'vote' => 'Abstimmung',

                'detail' => [
                    'end_time' => 'Abstimmung endet am :time',
                    'ended' => 'Abstimmung beendet am :time',
                    'total' => 'Stimmen insgesamt: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Kein Lesezeichen gesetzt',
            'to_watching' => 'Lesezeichen setzen',
            'to_watching_mail' => 'Lesezeichen setzen und benachrichtigt werden',
            'mail_disable' => 'Benachrichtigungen deaktivieren',
        ],
    ],
];
