<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Бекітілген тақырыптар',
    'slogan' => "жалғыз ойнау қауіпті. ",
    'subforums' => '',
    'title' => 'Форум',

    'covers' => [
        'edit' => 'Мұқабаны өзгерту',

        'create' => [
            '_' => 'Мұқаба сүретін қою',
            'button' => 'Мұқабаны жүктеу',
            'info' => '',
        ],

        'destroy' => [
            '_' => 'Мұқабаны жою',
            'confirm' => '',
        ],
    ],

    'forums' => [
        'forums' => 'Форум',
        'latest_post' => 'Соңғы жазба',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'Тақырып жоқ!',
        ],
    ],

    'mark_as_read' => [
        'forum' => '',
        'forums' => '',
        'busy' => '',
    ],

    'post' => [
        'confirm_destroy' => 'Жазбаны жою?',
        'confirm_restore' => 'Жазбаны қалпына келтіру?',
        'edited' => 'Соңғы рет :user :when өзгертті, жалпы :count_delimited рет өзгертілген.',
        'posted_at' => ':when жарияланған ',
        'posted_by_in' => ':forum-да :username жариялаған',

        'actions' => [
            'destroy' => 'Постты жою',
            'edit' => 'Постты өзгерту',
            'report' => '',
            'restore' => 'Постты қалпына келтіру',
        ],

        'create' => [
            'title' => [
                'reply' => 'Жаңа жауап',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited жазба',
            'topic_starter' => 'Тақырып авторы',
        ],
    ],

    'search' => [
        'go_to_post' => 'Жазбаға өту',
        'post_number_input' => 'жазба номерін жазыңыз ',
        'total_posts' => 'барлығы :posts_count жазба',
    ],

    'topic' => [
        'confirm_destroy' => '',
        'confirm_restore' => '',
        'deleted' => 'жойылған тақырып',
        'go_to_latest' => 'соңғы жазбаны қарау',
        'go_to_unread' => '',
        'has_replied' => 'Сіз осы тақырыпқа жауап бердіңіз',
        'in_forum' => ':forum-да',
        'latest_post' => '',
        'latest_reply_by' => '',
        'new_topic' => 'Жаңа тақырып',
        'new_topic_login' => 'Жаңа жазба жасау үшін аккаунтыңызға кіріңіз',
        'post_reply' => 'Жариялау',
        'reply_box_placeholder' => 'Жауап беру',
        'reply_title_prefix' => 'Жауап',
        'started_by' => ':user жасады',
        'started_by_verbose' => ':user бастады',

        'actions' => [
            'destroy' => 'Тақырыпты өшіру ',
            'restore' => 'Тақырыпты қалпына келтіру',
        ],

        'create' => [
            'close' => 'Жабу',
            'preview' => '',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Өзгерту',
            'submit' => 'Жариялау',

            'necropost' => [
                'default' => 'Бұл тақырып біраз уақыттан бері белсенді емес. Осы жерге нақты себеп болса ғана жазыңыз.',

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
            'first' => 'бірінші жазбаға бару',
            'last' => 'соңғы жазбаға бару',
            'next' => '',
            'previous' => '',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => 'Әрекет',
                'date' => 'Күні',
                'user' => 'Пайдаланушы',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => ':title-ға',
                'fork' => ':topic-ден',
                'pin' => 'бекітілген тақырып',
                'post_operation' => 'жариялаған :username',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => 'Жойылған жазба',
                'delete_topic' => 'Жойылған тақырып',
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
            'login_reply' => 'Жауап беру үшін аккаунтыңызға кіріңіз',
            'reply' => 'Жауап беру',
            'reply_with_quote' => '',
            'search' => 'Іздеу',
        ],

        'create' => [
            'create_poll' => '',

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Сауалнама жасау',
                'remove' => '',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
                'length' => '',
                'length_days_suffix' => 'күн',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => 'Баптау',
                'options_info' => '',
                'title' => 'Сұрақ',
                'vote_change' => '',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => 'Атын өзгерту',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => 'жауап',
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
            'to_1' => 'Тақырыпты жабу',
            'to_1_confirm' => '',
            'to_1_done' => '',
        ],

        'moderate_move' => [
            'title' => '',
        ],

        'moderate_pin' => [
            'to_0' => 'Тақырыпты шешу',
            'to_0_confirm' => '',
            'to_0_done' => '',
            'to_1' => 'Тақырыпты бекіту',
            'to_1_confirm' => 'Тақырыпты бекіту?',
            'to_1_done' => '',
            'to_2' => '',
            'to_2_confirm' => '',
            'to_2_done' => '',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => '',
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
                'edit' => 'Сауалнаманы өзгерту',
                'edit_warning' => '',
                'vote' => 'Дауыс беру',

                'button' => [
                    'change_vote' => 'Дауыс өзгерту',
                    'edit' => 'Сауалнаманы өзгерту',
                    'view_results' => '',
                    'vote' => 'Дауыс беру',
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
