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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '無法撤銷推薦。',
            'has_reply' => '有回應的討論無法刪除',
        ],
        'nominate' => [
            'exhausted' => '您今天提名的次數已達上限，請明天再試。',
            'incorrect_state' => '執行操作時發生錯誤，請重新載入頁面。',
            'owner' => "不能提名自己的圖譜。",
        ],
        'resolve' => [
            'not_owner' => '只有樓主和譜面所有者才能標記為已解決。',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'limit_exceeded' => '在投更多票之前請稍等一會',
            'owner' => "不能為自己的討論投票。",
            'wrong_beatmapset_state' => '只能對等待中的譜面討論進行投票。',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => '無法編輯自動回覆。',
            'not_owner' => '只有作者可以編輯。',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => '沒有權限進入該頻道。',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => '需要有指定頻道的權限。',
                    'moderated' => '頻道已滿。',
                    'not_lazer' => '當前只能在 #lazer 聊天。',
                ],

                'not_allowed' => '帳戶處於限制模式，無法發言。',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => '投票已結束，無法修改投票。',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => '只有最後的回覆可以被刪除。',
                'locked' => '無法刪除被鎖定主題的回覆。',
                'no_forum_access' => '沒有權限進入該板塊。',
                'not_owner' => '只有作者能刪除此回覆。',
            ],

            'edit' => [
                'deleted' => '無法編輯已刪除的回覆。',
                'locked' => '此回覆已被鎖定。',
                'no_forum_access' => '沒有權限進入該板塊。',
                'not_owner' => '只有作者能編輯此回覆。',
                'topic_locked' => '無法編輯被鎖定主題的回覆。',
            ],

            'store' => [
                'play_more' => '在发帖之前先玩上两局吧！如果你在游戏时遇到问题，请在 Help and Support 版块发帖求助。',
                'too_many_help_posts' => "如果你想发更多的帖子，再多玩几把吧！如果你仍然在游戏时遇到问题请邮件联系 support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '',
                'locked' => '無法回覆被鎖定的主題。',
                'no_forum_access' => '沒有權限，無法進入該板塊。',
                'no_permission' => '沒有權限，無法回覆。',

                'user' => [
                    'require_login' => '回覆前請先登錄。',
                    'restricted' => "帳戶處於限制模式，無法回覆。",
                    'silenced' => "帳戶被禁言，無法回覆。",
                ],
            ],

            'store' => [
                'no_forum_access' => '沒有權限，無法進入該板塊。',
                'no_permission' => '沒有權限，無法創建新主題。',
                'forum_closed' => '該板塊已關閉，無法發表新主題。',
            ],

            'vote' => [
                'no_forum_access' => '沒有權限，無法進入該板塊。',
                'over' => '投票已結束！',
                'voted' => '不允許修改投票。',

                'user' => [
                    'require_login' => '投票前請先登錄。',
                    'restricted' => "帳戶處於限制模式，無法投票。",
                    'silenced' => "帳戶被禁言，無法投票。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '沒有權限，無法進入該板塊。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定的封面不可用。',
                'not_owner' => '只有樓主可以編輯封面。',
            ],
        ],

        'view' => [
            'admin_only' => '該板塊僅限管理員查看。',
        ],
    ],

    'require_login' => '登錄以繼續。',

    'unauthorized' => '沒有權限。',

    'silenced' => "帳戶被禁言，無法進行該操作。",

    'restricted' => "帳戶處於限制模式，無法進行該操作。",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '個人頁面被鎖定。',
                'not_owner' => '只能編輯自己的個人頁面。',
                'require_supporter_tag' => '',
            ],
        ],
    ],
];
