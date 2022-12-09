<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => '',
    'slogan' => "",
    'subforums' => '',
    'title' => '',

    'covers' => [
        'edit' => '',

        'create' => [
            '_' => '',
            'button' => '',
            'info' => '',
        ],

        'destroy' => [
            '_' => '',
            'confirm' => '',
        ],
    ],

    'forums' => [
        'latest_post' => '',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => '',
        ],
    ],

    'mark_as_read' => [
        'forum' => '',
        'forums' => '',
        'busy' => '',
    ],

    'post' => [
        'confirm_destroy' => 'Realment voleu eliminar la publicació?',
        'confirm_restore' => 'Realment voleu restaurar la publicació?',
        'edited' => '',
        'posted_at' => '',
        'posted_by' => '',

        'actions' => [
            'destroy' => 'Eliminar publicació',
            'edit' => '',
            'report' => '',
            'restore' => '',
        ],

        'create' => [
            'title' => [
                'reply' => '',
            ],
        ],

        'info' => [
            'post_count' => '',
            'topic_starter' => '',
        ],
    ],

    'search' => [
        'go_to_post' => '',
        'post_number_input' => '',
        'total_posts' => '',
    ],

    'topic' => [
        'confirm_destroy' => 'Realment voleu eliminar el tema?',
        'confirm_restore' => 'Realment voleu restaurar el tema?',
        'deleted' => 'tema eliminat',
        'go_to_latest' => '',
        'has_replied' => '',
        'in_forum' => '',
        'latest_post' => '',
        'latest_reply_by' => '',
        'new_topic' => '',
        'new_topic_login' => '',
        'post_reply' => '',
        'reply_box_placeholder' => '',
        'reply_title_prefix' => '',
        'started_by' => 'per :user',
        'started_by_verbose' => '',

        'actions' => [
            'destroy' => 'Eliminar tema',
            'restore' => '',
        ],

        'create' => [
            'close' => '',
            'preview' => '',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Escriure',
            'submit' => '',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
                ],
            ],

            'placeholder' => [
                'body' => '',
                'title' => '',
            ],
        ],

        'jump' => [
            'enter' => '',
            'first' => '',
            'last' => '',
            'next' => 'saltar les 10 publicacions següents',
            'previous' => '',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => 'Acció',
                'date' => 'Data',
                'user' => 'Usuari',
            ],

            'data' => [
                'add_tag' => 'etiqueta ":tag" agregada',
                'announcement' => '',
                'edit_topic' => 'a :title',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => 'Publicació eliminada',
                'delete_topic' => 'Tema eliminat',
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
            'cancel' => '',
            'post' => '',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => '',

            'box' => [
                'total' => '',
                'unread' => '',
            ],

            'info' => [
                'total' => '',
                'unread' => '',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '',
                'title' => '',
            ],
        ],
    ],

    'topics' => [
        '_' => '',

        'actions' => [
            'login_reply' => '',
            'reply' => '',
            'reply_with_quote' => '',
            'search' => '',
        ],

        'create' => [
            'create_poll' => '',

            'preview' => '',

            'create_poll_button' => [
                'add' => '',
                'remove' => '',
            ],

            'poll' => [
                'hide_results' => 'Amaga els resultats de l\'enquesta.',
                'hide_results_info' => 'Només es mostraran després que finalitzi l\'enquesta.',
                'length' => '',
                'length_days_suffix' => '',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => '',
                'options_info' => '',
                'title' => '',
                'vote_change' => 'Permetre tornar a votar.',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => '',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => '',
            'views' => '',
        ],

        'issue_tag_added' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_assigned' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_invalid' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_resolved' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'lock' => [
            'is_locked' => '',
            'to_0' => '',
            'to_0_confirm' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_confirm' => '',
            'to_1_done' => '',
        ],

        'moderate_move' => [
            'title' => '',
        ],

        'moderate_pin' => [
            'to_0' => '',
            'to_0_confirm' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_confirm' => '',
            'to_1_done' => '',
            'to_2' => '',
            'to_2_confirm' => '',
            'to_2_done' => '',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Mostra publicacions eliminades',
            'hide' => 'Amagar publicacions eliminades',
        ],

        'show' => [
            'deleted-posts' => 'Publicacions eliminades',
            'total_posts' => '',

            'feature_vote' => [
                'current' => '',
                'do' => '',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => '',
                    'current' => '',
                    'not_enough' => "",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => '',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => '',
                ],

                'detail' => [
                    'end_time' => '',
                    'ended' => '',
                    'results_hidden' => '',
                    'total' => '',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'tooltip_mail_disable' => '',
            'tooltip_mail_enable' => '',
        ],
    ],
];
