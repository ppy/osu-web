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
    'pinned_topics' => 'Gepinde Onderwerpen',
    'slogan' => "it's dangerous to play alone.",
    'subforums' => 'Subfora',
    'title' => 'osu!community',

    'covers' => [
        'create' => [
            '_' => 'Stel cover afbeelding in',
            'button' => 'Afbeelding uploaden',
            'info' => 'Cover groote moet :dimensions zijn. Je kunt ook een afbeelding hier loslaten om hem te uploaden.',
        ],

        'destroy' => [
            '_' => 'Verwijder cover afbeelding',
            'confirm' => 'Weet je zeker dat je de cover afbeelding wilt verwijderen?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] New reply for topic ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'No topics!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Really delete post?',
        'confirm_restore' => 'Really restore post?',
        'edited' => 'Laatst bewerkt door :user op :when. :count keer bewerkt.',
        'posted_at' => 'gepost op :when',

        'actions' => [
            'destroy' => 'Delete post',
            'restore' => 'Restore post',
            'edit' => 'Bewerk post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ga naar post',
        'post_number_input' => 'geef post nummer',
        'total_posts' => ':posts_count posts',
    ],

    'topic' => [
        'deleted' => 'deleted topic',
        'go_to_latest' => 'bekijk nieuwste post',
        'latest_post' => ':when door :user',
        'latest_reply_by' => 'laatste bericht door :user',
        'new_topic' => 'Maak nieuw onderwerp',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Typ hier om te antwoorden',
        'started_by' => 'door :user',

        'create' => [
            'preview' => 'Voorbeeld',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Write',
            'submit' => 'Post',

            'placeholder' => [
                'body' => 'Typ post inhoud hier',
                'title' => 'Klik hier om een titel in te stellen',
            ],
        ],

        'jump' => [
            'enter' => 'klik hier om een specifiek postnummer op te geven',
            'first' => 'ga naar eerste post',
            'last' => 'ga naar laatste post',
            'next' => 'sla 10 posts over',
            'previous' => 'ga 10 posts terug',
        ],

        'post_edit' => [
            'cancel' => 'Annuleren',
            'post' => 'Opslaan',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forum Subscriptions',
            'title_compact' => 'forum subscriptions',
            'title_main' => 'Forum <strong>Subscriptions</strong>',

            'box' => [
                'total' => 'Topics subscribed',
                'unread' => 'Topics with new replies',
            ],

            'info' => [
                'total' => 'You subscribed to :total topics.',
                'unread' => 'You have :unread unread replies to subscribed topics.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Unsubscribe from topic?',
                'title' => 'Unsubscribe',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Onderwerpen',

        'actions' => [
            'reply' => 'Reply',
            'reply_with_quote' => 'Citeer post voor antwoord',
            'search' => 'Search',
        ],

        'create' => [
            'create_poll' => 'Poll Creation',

            'create_poll_button' => [
                'add' => 'Create a poll',
                'remove' => 'Cancel creating a poll',
            ],

            'poll' => [
                'length' => 'Run poll for',
                'length_days_prefix' => '',
                'length_days_suffix' => 'days',
                'length_info' => 'Leave blank for a never ending poll',
                'max_options' => 'Options per user',
                'max_options_info' => 'This is the number of options each user may select when voting.',
                'options' => 'Options',
                'options_info' => 'Place each options on a new line. You may enter up to 10 options.',
                'title' => 'Question',
                'vote_change' => 'Allow re-voting.',
                'vote_change_info' => 'If enabled, users are able to change their vote.',
            ],
        ],

        'edit_title' => [
            'start' => 'Edit title',
        ],

        'index' => [
            'views' => 'keer bekeken',
            'replies' => 'keer beantwoordt',
        ],

        'issue_tag_added' => [
            'to_0' => 'Remove "added" tag',
            'to_0_done' => 'Removed "added" tag',
            'to_1' => 'Add "added" tag',
            'to_1_done' => 'Added "added" tag',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Remove "assigned" tag',
            'to_0_done' => 'Removed "assigned" tag',
            'to_1' => 'Add "assigned" tag',
            'to_1_done' => 'Added "assigned" tag',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Remove "confirmed" tag',
            'to_0_done' => 'Removed "confirmed" tag',
            'to_1' => 'Add "confirmed" tag',
            'to_1_done' => 'Added "confirmed" tag',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Remove "duplicate" tag',
            'to_0_done' => 'Removed "duplicate" tag',
            'to_1' => 'Add "duplicate" tag',
            'to_1_done' => 'Added "duplicate" tag',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Remove "invalid" tag',
            'to_0_done' => 'Removed "invalid" tag',
            'to_1' => 'Add "invalid" tag',
            'to_1_done' => 'Added "invalid" tag',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Remove "resolved" tag',
            'to_0_done' => 'Removed "resolved" tag',
            'to_1' => 'Add "resolved" tag',
            'to_1_done' => 'Added "resolved" tag',
        ],

        'lock' => [
            'is_locked' => 'Dit onderwerp is gesloten en kan niet meer op beantwoord worden',
            'to_0' => 'Unlock topic',
            'to_0_done' => 'Topic has been unlocked',
            'to_1' => 'Lock topic',
            'to_1_done' => 'Topic has been locked',
        ],

        'moderate_move' => [
            'title' => 'Verplaats naar een ander forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Unpin topic',
            'to_0_done' => 'Topic has been unpinned',
            'to_1' => 'Pin topic',
            'to_1_done' => 'Topic has been pinned',
            'to_2' => 'Pin topic and mark as announcement',
            'to_2_done' => 'Topic has been pinned and marked as announcement',
        ],

        'show' => [
            'deleted-posts' => 'Deleted Posts',
            'total_posts' => 'Total Posts',

            'feature_vote' => [
                'current' => 'Prioriteit: +:count',
                'do' => 'Promoot dit verzoek',

                'user' => [
                    'count' => '{0} geen stemmen|{1} :count stem|[2,*] :count stemmen',
                    'current' => 'Je hebt :votes stemmen over.',
                    'not_enough' => "Je hebt geen stemmen meer over",
                ],
            ],

            'poll' => [
                'vote' => 'Vote',

                'detail' => [
                    'end_time' => 'Polling will end at :time',
                    'ended' => 'Polling ended :time',
                    'total' => 'Total votes: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Not bookmarked',
            'to_watching' => 'Bookmark',
            'to_watching_mail' => 'Bookmark with notification',
            'mail_disable' => 'Disable notification',
        ],
    ],
];
