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

    'covers' => [
        'create' => [
            '_' => '设置封面',
            'button' => '上传图片',
            'info' => '图片尺寸应为 :dimensions.将图片拖动到这里也可以上传.',
        ],

        'destroy' => [
            '_' => '移除封面',
            'confirm' => '您真的要移除这个封面吗?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] 主题 ":title" 有新回复',
    ],

    'forums' => [
        'topics' => [
            'empty' => '没有主题!',
        ],
    ],

    'pinned_topics' => 'Pinned Topics', //TODO 需要帮助
    'post' => [
        'confirm_destroy' => '真的要删除这个回复吗?',
        'confirm_restore' => 'Really restore post?', //TODO 需要帮助
        'edited' => '最后由 :user 于 :when 编辑,总共编辑了 :count 次.',
        'posted_at' => '发表于 :when',
        'actions' => [
            'destroy' => '删除回复',
            'restore' => 'Restore post', //TODO 需要帮助
            'edit' => '编辑回复',
        ],
    ],
    'search' => [ //需要上下文
        'go_to_post' => 'Go to post',
        'post_number_input' => 'enter post number',
        'total_posts' => ':posts_count posts total',
    ],
    'subforums' => 'Subforums',
    'title' => 'osu!社区',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => '在这里输入正文',
                'title' => '点击这里设置标题',
            ],
            'preview' => '预览',
            'submit' => '发表',
        ],
        'go_to_latest' => '查看最后的帖子',
        'jump' => [
            'enter' => '点击这里跳转到指定回复',
            'first' => '前往第一个回复',
            'last' => '前往最后一个回复',
            'next' => '往后10个回复',
            'previous' => '往前10个回复',
        ],
        'latest_post' => ':when :user', //DZ风格的写法
        'latest_reply_by' => '最后回复: :user',
        'new_topic' => '发表新主题',
        'post_edit' => [
            'cancel' => '取消',
            'post' => '保存',
            'zoom' => [
                'start' => '全屏',
                'end' => '退出全屏',
            ],
        ],
        'post_reply' => '发表',
        'reply_box_placeholder' => '在这里输入以回复',
        'started_by' => '发帖人: :user',
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Topic Subscriptions',
            'title_compact' => 'subscriptions',

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
        '_' => 'Topics',

        'actions' => [
            'reply' => 'Show reply box',
            'reply_with_quote' => 'Quote post for reply',
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

        'index' => [
            'views' => 'views',
            'replies' => 'replies',
        ],

        'lock' => [
            'is_locked' => 'This topic is locked and can not be replied to',
            'lock-0' => 'Unlock topic',
            'lock-1' => 'Lock topic',
            'state-0' => 'Topic has been unlocked',
            'state-1' => 'Topic has been locked',
        ],

        'moderate_move' => [
            'title' => 'Move to another forum',
        ],

        'moderate_pin' => [
            'pin-0' => 'Unpin topic',
            'pin-1' => 'Pin topic',
            'state-0' => 'Topic has been unpinned',
            'state-1' => 'Topic has been pinned',
        ],

        'show' => [
            'total_posts' => 'Total Posts',
            'deleted-posts' => 'Deleted Posts',

            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',

                'user' => [
                    'current' => 'You have :votes remaining.',
                    'count' => '{0} no vote|{1} :count vote|[2,Inf] :count votes',
                    'not_enough' => "You don't have any more votes remaining",
                ],
            ],

            'poll' => [
                'vote' => 'Vote',

                'detail' => [
                    'total' => 'Total votes: :count',
                    'ended' => 'Polling ended :time',
                    'end_time' => 'Polling will end at :time',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Unsubscribed from topic',
            'state-1' => 'Subscribed to topic',
            'watch-0' => 'Unsubscribe topic',
            'watch-1' => 'Subscribe topic',
        ],
    ],

];
