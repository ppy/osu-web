<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => '已閱畢所有通知！',
    'delete' => '刪除 :type',
    'loading' => '正在載入未讀通知...',
    'mark_read' => '清除 :type',
    'none' => '沒有通知',
    'see_all' => '查看所有通知',
    'see_channel' => '前往聊天',
    'verifying' => '',

    'filters' => [
        '_' => '全部',
        'user' => '個人簡介',
        'beatmapset' => '圖譜',
        'forum_topic' => '討論區',
        'news_post' => '最新消息',
        'build' => '版本',
        'channel' => '聊天',
    ],

    'item' => [
        'beatmapset' => [
            '_' => '圖譜',

            'beatmap_owner_change' => [
                '_' => '',
                'beatmap_owner_change' => '',
                'beatmap_owner_change_compact' => '',
            ],

            'beatmapset_discussion' => [
                '_' => '圖譜討論',
                'beatmapset_discussion_lock' => '已鎖定「:title」的討論',
                'beatmapset_discussion_lock_compact' => '討論已被鎖定',
                'beatmapset_discussion_post_new' => ':username 在":title"中發布了新的貼文:":content"',
                'beatmapset_discussion_post_new_empty' => ':username發布了主題為:title的新貼文',
                'beatmapset_discussion_post_new_compact' => ':username 的新主題',
                'beatmapset_discussion_post_new_compact_empty' => ':username 的新主題',
                'beatmapset_discussion_review_new' => '',
                'beatmapset_discussion_review_new_compact' => '',
                'beatmapset_discussion_unlock' => '討論於 ":title" 已解鎖',
                'beatmapset_discussion_unlock_compact' => '討論已被解鎖',
            ],

            'beatmapset_problem' => [
                '_' => 'Qualified 圖譜問題',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '由 :username 回報',
            ],

            'beatmapset_state' => [
                '_' => '圖譜狀態已變更',
                'beatmapset_disqualify' => '「:title」被取消提名',
                'beatmapset_disqualify_compact' => '圖譜被取消資格',
                'beatmapset_love' => '":title" 被提升為 loved',
                'beatmapset_love_compact' => '圖譜被提升為 loved',
                'beatmapset_nominate' => '「:title」已被提名',
                'beatmapset_nominate_compact' => '圖譜已被提名',
                'beatmapset_qualify' => '「:title」已獲得足夠提名并因此進入了上架列隊',
                'beatmapset_qualify_compact' => '圖譜已進入上架列隊',
                'beatmapset_rank' => '「:title」已進榜',
                'beatmapset_rank_compact' => '圖譜已進榜',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_remove_from_loved_compact' => '',
                'beatmapset_reset_nominations' => '「:title」的提名已被重置',
                'beatmapset_reset_nominations_compact' => '提名已被重置',
            ],

            'comment' => [
                '_' => '新評論',

                'comment_new' => ':username 在「:title」中評論了 「:content」',
                'comment_new_compact' => ':username 評論了 「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '聊天',

            'channel' => [
                '_' => '新訊息',
                'pm' => [
                    'channel_message' => ':username 發表了「:title」',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => '來自 :username',
                ],
            ],
        ],

        'build' => [
            '_' => '更新日誌',

            'comment' => [
                '_' => '新評論',

                'comment_new' => ':username 在「:title」中評論了 「:content」',
                'comment_new_compact' => ':username 評論了 「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '最新消息',

            'comment' => [
                '_' => '新評論',

                'comment_new' => ':username 在「:title」中評論了 「:content」',
                'comment_new_compact' => ':username 評論了 「:content」',
                'comment_reply' => '',
                'comment_reply_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => '論壇主題',

            'forum_topic_reply' => [
                '_' => '新論壇回覆',
                'forum_topic_reply' => ':username 回覆了主題 「:title」',
                'forum_topic_reply_compact' => ':username 回覆了',
            ],
        ],

        'legacy_pm' => [
            '_' => '舊論壇私訊',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited 則未讀訊息',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => '新圖譜',

                'user_beatmapset_new' => ':username 上傳了標題為 “:title” 的新圖譜',
                'user_beatmapset_new_compact' => '',
                'user_beatmapset_new_group' => '',
            ],
        ],

        'user_achievement' => [
            '_' => '成就',

            'user_achievement_unlock' => [
                '_' => '新成就',
                'user_achievement_unlock' => '解鎖「:title」！',
                'user_achievement_unlock_compact' => '解鎖「:title」！',
                'user_achievement_unlock_group' => '勳章解鎖！',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => '',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => '',
                'beatmapset_discussion_post_new' => '',
                'beatmapset_discussion_unlock' => '',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => '',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '',
                'beatmapset_love' => '',
                'beatmapset_nominate' => '":title" 已被提名',
                'beatmapset_qualify' => '',
                'beatmapset_rank' => '',
                'beatmapset_remove_from_loved' => '',
                'beatmapset_reset_nominations' => '',
            ],

            'comment' => [
                'comment_new' => '',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => '您收到了來自 :username 的新訊息',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => '',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => '',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => '',
                'user_achievement_unlock_self' => '您已解鎖了新成就 ":title"！',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username 建立了新圖譜',
            ],
        ],
    ],
];
