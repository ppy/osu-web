<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Закачене Теме',
    'slogan' => "опасно је играти сам.",
    'subforums' => 'Подфоруми',
    'title' => 'Форуми',

    'covers' => [
        'edit' => 'Уреди насловницу',

        'create' => [
            '_' => 'Постављање насловне слике',
            'button' => 'Отпреми насловницу',
            'info' => 'Величина насловнице треба да буде на :dimensions. Такође можете да испустите своју слику овде да бисте је отпремили.',
        ],

        'destroy' => [
            '_' => 'Уклони насловницу',
            'confirm' => 'Да ли сте сигурни да желите уклонити насловну слику?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Најновији Постови',

        'index' => [
            'title' => 'Индекс форума',
        ],

        'topics' => [
            'empty' => 'Нема теме!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Форум обележени као прочитан',
        'forums' => 'Форуме обележени као прочитан',
        'busy' => 'Означавање као прочитано...',
    ],

    'post' => [
        'confirm_destroy' => 'Стварно обрисати пост?',
        'confirm_restore' => 'Стварно вратити пост?',
        'edited' => 'Последње измењено од :user :when, измењено :count_delimited пута и укупно.|Последње измењено од :user :when, измењено :count_delimited пута укупно.',
        'posted_at' => 'постовао :when',
        'posted_by' => 'аутор поста :username',

        'actions' => [
            'destroy' => 'Обриши пост',
            'edit' => 'Измени пост',
            'report' => 'Пријави пост',
            'restore' => 'Врати пост',
        ],

        'create' => [
            'title' => [
                'reply' => 'Нови одговор',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited пост|:count_delimited постови',
            'topic_starter' => 'Аутор Теме',
        ],
    ],

    'search' => [
        'go_to_post' => 'Иди на пост',
        'post_number_input' => 'унесите број постова',
        'total_posts' => ':posts_count постова укупно',
    ],

    'topic' => [
        'confirm_destroy' => 'Стварно обрисати тему?',
        'confirm_restore' => 'Стварно вратити тему?',
        'deleted' => 'обрисана тема',
        'go_to_latest' => 'погледај најновији пост',
        'has_replied' => 'Одговорили сте на ову тему',
        'in_forum' => 'у :forum',
        'latest_post' => ':when од :user',
        'latest_reply_by' => 'последњи одговор од :user',
        'new_topic' => 'Нова тема',
        'new_topic_login' => 'Пријавите се да би сте постовали нову тему',
        'post_reply' => 'Пост',
        'reply_box_placeholder' => 'Унесите овде да бисте одговорили',
        'reply_title_prefix' => 'Re',
        'started_by' => 'од :user',
        'started_by_verbose' => 'покренут од :user',

        'actions' => [
            'destroy' => 'Избриши тему',
            'restore' => 'Врати тему',
        ],

        'create' => [
            'close' => 'Затвори',
            'preview' => 'Преглед',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Напиши',
            'submit' => 'Пост',

            'necropost' => [
                'default' => 'Ова тема је била неактивна неко време. Објављујте овде само ако имате конкретан разлог за то.',

                'new_topic' => [
                    '_' => "",
                    'create' => 'направиte нову тему',
                ],
            ],

            'placeholder' => [
                'body' => '',
                'title' => 'Кликни овде да поставиш наслов',
            ],
        ],

        'jump' => [
            'enter' => '',
            'first' => '',
            'last' => '',
            'next' => '',
            'previous' => '',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => 'Радња',
                'date' => 'Датум',
                'user' => 'Корисник',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => 'закачена тема и означена као најава',
                'edit_topic' => '',
                'fork' => '',
                'pin' => 'закачена тема',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => 'Обрисан пост',
                'delete_topic' => 'Обрисана тема',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => 'Закључана тема',
                'merge' => '',
                'move' => '',
                'pin' => 'Закачена тема',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => 'Откључана тема',
                'unpin' => 'Откачена тема',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Поништи',
            'post' => 'Сачувај',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => '',

            'box' => [
                'total' => 'Претплаћене теме',
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
        '_' => 'Теме',

        'actions' => [
            'login_reply' => 'Пријави се да би сте одговорили',
            'reply' => 'Одговори',
            'reply_with_quote' => '',
            'search' => 'Претражи',
        ],

        'create' => [
            'create_poll' => '',

            'preview' => '',

            'create_poll_button' => [
                'add' => '',
                'remove' => '',
            ],

            'poll' => [
                'hide_results' => '',
                'hide_results_info' => '',
                'length' => 'Покрени анкету за',
                'length_days_suffix' => 'дана',
                'length_info' => '',
                'max_options' => 'Опције по кориснику',
                'max_options_info' => 'Ово је број опција које сваки корисник може изабрати приликом гласања.',
                'options' => 'Опције',
                'options_info' => 'Постави сваку опцију у нови ред. Можеш да унесеш до 10 опција.',
                'title' => 'Питање',
                'vote_change' => 'Дозволи поновно гласање.',
                'vote_change_info' => 'Ако је омогућено, корисници могу да промене свој глас.',
            ],
        ],

        'edit_title' => [
            'start' => 'Измени наслов',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => 'одговори',
            'views' => 'приказа',
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
            'is_locked' => 'Ова тема је закључана и на њу се не може одговорити',
            'to_0' => 'Откључај тему',
            'to_0_confirm' => 'Откључај тему?',
            'to_0_done' => 'Тема је откључана',
            'to_1' => 'Закључај тему',
            'to_1_confirm' => 'Закључај тему?',
            'to_1_done' => 'Тема је закључана',
        ],

        'moderate_move' => [
            'title' => 'Премести у други форум',
        ],

        'moderate_pin' => [
            'to_0' => 'Откачи тему',
            'to_0_confirm' => 'Откачи тему?',
            'to_0_done' => 'Тема је откачена',
            'to_1' => 'Закачи тему',
            'to_1_confirm' => 'Закачи тему?',
            'to_1_done' => 'Тема је закачена',
            'to_2' => 'Закачите тему и означите као најаву',
            'to_2_confirm' => 'Закачите тему и означите као најаву?',
            'to_2_done' => 'Тема је закачена и означена као најава',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Прикажи избрисане постове',
            'hide' => 'Сакриј обрисане постове',
        ],

        'show' => [
            'deleted-posts' => 'Обрисане Постове',
            'total_posts' => 'Укупно Постова',

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
                'edit_warning' => 'Уређивање анкете ће уклонити тренутне резултате!',
                'vote' => 'Гласај',

                'button' => [
                    'change_vote' => '',
                    'edit' => 'Измени анкету',
                    'view_results' => 'Пређи на резултате',
                    'vote' => 'Гласај',
                ],

                'detail' => [
                    'end_time' => '',
                    'ended' => 'Гласање је завршено :time',
                    'results_hidden' => 'Резултати ће бити приказани након завршетка гласања.',
                    'total' => 'Укупно гласова :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'tooltip_mail_disable' => 'Обавештење је омогућено. Кликните да бисте онемогућили
',
            'tooltip_mail_enable' => 'Обавештење је онемогућено. Кликните да бисте омогућили',
        ],
    ],
];
