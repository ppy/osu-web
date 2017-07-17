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
            'info' => '图片尺寸应为 :dimensions. 也可以将图片拖动到这里上传.',
        ],

        'destroy' => [
            '_' => '移除封面',
            'confirm' => '您真的要移除这个封面吗？',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] 主题 ":title" 有新回复',
    ],

    'forums' => [
        'topics' => [
            'empty' => '没有主题！',
        ],
    ],

    'pinned_topics' => '置顶主题',
    'post' => [
        'confirm_destroy' => '真的要删除这个回复吗？',
        'confirm_restore' => '真的要恢复这个回复吗？',
        'edited' => '最后由 :user 于 :when 编辑，总共编辑了 :count 次。',
        'posted_at' => '发表于 :when',
        'actions' => [
            'destroy' => '删除回复',
            'restore' => '恢复回复',
            'edit' => '编辑回复',
        ],
    ],
    'search' => [ //搜索功能已经完成 17.06.25, 但是没有在搜索中看见字段使用
        'go_to_post' => '前往该楼层',
        'post_number_input' => '输入楼层数',
        'total_posts' => '一共有 :posts_count 楼',
    ],
    'subforums' => '子版块',
    'title' => 'osu! 社区',
    'slogan' => '一起来玩吧', //此处意译了
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => '在这里输入正文',
                'title' => '点击这里设置标题',
            ],
            'preview' => '预览',
            'preview_hide' => '编辑',
            'submit' => '发表',
        ],
        'go_to_latest' => '查看最后的帖子',
        'jump' => [
            'enter' => '点击这里跳转到指定回复',
            'first' => '跳转到第一条回复',
            'last' => '跳转到最后一条回复',
            'next' => '向后10条',
            'previous' => '向前10条',
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
        'reply_box_placeholder' => '输入回复',
        'started_by' => '发帖人: :user',
    ],

    'topic_watches' => [
        'index' => [
            'title' => '订阅的主题',
            'title_compact' => '订阅',
            'title_main' => '<strong>订阅</strong>主题',

            'box' => [
                'total' => '订阅的主题',
                'unread' => '主题有新回复',
            ],
            'info' => [
                'total' => '您总共订阅了 :total 个主题',
                'unread' => '有 :unread 个未读回复',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '取消订阅该主题？',
                'title' => '取消订阅',
            ],
        ],
    ],

    'topics' => [
        '_' => '主题',

        'actions' => [
            'reply' => '显示回复盒子',
            'reply_with_quote' => '引用以回复',
        ],

        'create' => [
            'create_poll' => '创建投票',

            'create_poll_button' => [
                'add' => '创建投票',
                'remove' => '取消创建投票',
            ],

            'poll' => [
                'length' => '投票持续',
                'length_days_prefix' => '',
                'length_days_suffix' => '天',
                'length_info' => '如果无期限则留空',
                'max_options' => '最大可选数',
                'max_options_info' => '填写每个人最多可以选的选项数。',
                'options' => '选项',
                'options_info' => '一个选项占一行，最多10个选项。',
                'title' => '问题',
                'vote_change' => '允许重选',
                'vote_change_info' => '如果选中，则用户可以更改他们的投票。',
            ],
        ],

        'index' => [
            'views' => '查看数',
            'replies' => '回复数',
        ],

        'issue_tag_added' => [ //TODO 所有的issue_tag_xxx都需要上下文
            'action-0' => '移除 "added" 标签',
            'action-1' => '添加 "added" 标签',
            'state-0' => '已移除 "added" 标签',
            'state-1' => '已添加 "added" 标签',
        ],

        'issue_tag_assigned' => [
            'action-0' => '移除 "assigned" 标签',
            'action-1' => '添加 "assigned" 标签',
            'state-0' => '已移除 "assigned" 标签',
            'state-1' => '已添加 "assigned" 标签',
        ],

        'issue_tag_confirmed' => [
            'action-0' => '移除 "confirmed" 标签',
            'action-1' => '添加 "confirmed" 标签',
            'state-0' => '已移除 "confirmed" 标签',
            'state-1' => '已添加 "confirmed" 标签',
        ],

        'issue_tag_duplicate' => [
            'action-0' => '移除 "duplicate" 标签',
            'action-1' => '添加 "duplicate" 标签',
            'state-0' => '已移除 "duplicate" 标签',
            'state-1' => '已添加 "duplicate" 标签',
        ],

        'issue_tag_invalid' => [
            'action-0' => '移除 "invalid" 标签',
            'action-1' => '添加 "invalid" 标签',
            'state-0' => '已移除 "invalid" 标签',
            'state-1' => '已添加 "invalid" 标签',
        ],

        'issue_tag_resolved' => [
            'action-0' => '移除 "resolved" 标签',
            'action-1' => '添加 "resolved" 标签',
            'state-0' => '已移除 "resolved" 标签',
            'state-1' => '已添加 "resolved" 标签',
        ],

        'lock' => [
            'is_locked' => '主题已被锁定，不能回复',
            'lock-0' => '解锁主题',
            'lock-1' => '锁定主题',
            'state-0' => '主题已经解锁',
            'state-1' => '主题已被锁定',
        ],

        'moderate_move' => [
            'title' => '将主题移动到其他板块',
        ],

        'moderate_pin' => [
            'pin-0' => '取消置顶',
            'pin-1' => '置顶',
            'state-0' => '该主题已取消置顶',
            'state-1' => '该主题已置顶',
        ],

        'show' => [
            'total_posts' => '总主题数量',
            'deleted-posts' => '删除主题',

            'feature_vote' => [
                'current' => '当前优先级: +:count',
                'do' => '提升这个请求',

                'user' => [
                    'current' => '您还有 :votes 票.',
                    'count' => '{0} 没有票|[1,*] :count票',
                    'not_enough' => '您没有票了',
                ],
            ],

            'poll' => [
                'vote' => '投票',

                'detail' => [
                    'total' => '总票数: :count',
                    'ended' => '结束于 :time',
                    'end_time' => '将于 :time 结束',
                ],
            ],
        ],

        'watch' => [
            'state-0' => '取消了订阅',
            'state-1' => '订阅了主题',
            'watch-0' => '取消订阅',
            'watch-1' => '订阅',
        ],
    ],

];
