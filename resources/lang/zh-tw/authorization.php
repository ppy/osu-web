<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '不如馬上玩點 osu! 吧？',
    'require_login' => '登入以繼續。',
    'require_verification' => '需要驗證帳戶!',
    'restricted' => "帳戶處於限制模式，無法進行該操作。",
    'silenced' => "帳戶被禁言，無法進行該操作。",
    'unauthorized' => '沒有權限。',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => '無法撤銷推薦。',
            'has_reply' => '無法刪除有回覆的討論',
        ],
        'nominate' => [
            'exhausted' => '你今天的提名次數已達上限，請明天再試。',
            'incorrect_state' => '執行操作時發生錯誤，請重新載入頁面。',
            'owner' => "不能提名自己的圖譜。",
            'set_metadata' => '您必須在提名之前先設定類型和語言。',
        ],
        'resolve' => [
            'not_owner' => '只有樓主和圖譜所有者才能標記為已解決。',
        ],

        'store' => [
            'mapper_note_wrong_user' => '只有圖譜作者或譜面管理團隊/質量保證團隊可以發布備註。',
        ],

        'vote' => [
            'bot' => "不能為機器人建立的討論投票。",
            'limit_exceeded' => '在投更多票之前請稍等一會',
            'owner' => "不能為自己的討論投票。",
            'wrong_beatmapset_state' => '只能對待處理的圖譜討論進行投票。',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '您只能刪除自己的發文。',
            'resolved' => '你不能刪除已解決的討論串。',
            'system_generated' => '自動生成的貼文無法刪除。',
        ],

        'edit' => [
            'not_owner' => '只有作者可以編輯。',
            'resolved' => '你不能編輯已解決討論裡的貼文。',
            'system_generated' => '無法編輯自動回覆。',
        ],

        'store' => [
            'beatmapset_locked' => '這個圖譜被鎖定討論。',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '你不能修改已提名的圖譜資訊。如果你認為有誤，請聯繫 BN 或 NAT 成員。',
        ],
    ],

    'chat' => [
        'blocked' => '無法向封鎖你或被你封鎖的人發送訊息。',
        'friends_only' => '用戶阻止了來自非好友的訊息。',
        'moderated' => '該頻道目前正在被管制中。',
        'no_access' => '你沒有權限訪問該頻道。',
        'restricted' => '你不能在帳戶被禁言、限制或封鎖的時候發送訊息。',
        'silenced' => '你不能在帳戶被禁言、限制或封鎖的時候傳送訊息。',
    ],

    'comment' => [
        'update' => [
            'deleted' => "無法編輯已刪除的回覆。",
        ],
    ],

    'contest' => [
        'voting_over' => '投票已結束，禁止重新投票。',

        'entry' => [
            'limit_reached' => '您提交的參賽文件大小超出限制',
            'over' => '感謝參與！提交已經關閉，投票即將開始。',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '沒有權限編輯該板塊。',
        ],

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
                'play_more' => '在論壇發文之前，請先玩幾場遊戲！如果您在玩遊戲時遇到問題，請在 Help and Support 板塊中發文。',
                'too_many_help_posts' => "您需要再玩久一點才可以發布更多貼文，如果您仍然在遊戲中遇到問題，請聯繫support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '請編輯您的最後一條評論，而不是再次發表。',
                'locked' => '無法回覆被鎖定的主題。',
                'no_forum_access' => '沒有權限，無法進入該板塊。',
                'no_permission' => '沒有權限，無法回覆。',

                'user' => [
                    'require_login' => '回覆前請先登入。',
                    'restricted' => "帳戶處於限制模式，無法回覆。",
                    'silenced' => "帳戶被禁言，無法回覆。",
                ],
            ],

            'store' => [
                'no_forum_access' => '沒有權限，無法進入該板塊。',
                'no_permission' => '沒有權限，無法創建新主題。',
                'forum_closed' => '該討論區已關閉，無法發表新主題。',
            ],

            'vote' => [
                'no_forum_access' => '沒有權限，無法進入該討論區。',
                'over' => '投票已結束！',
                'play_more' => '你需要在論壇上投票之前多玩一些。',
                'voted' => '不允許修改投票。',

                'user' => [
                    'require_login' => '投票前請先登入。',
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
            'store' => [
                'forum_not_allowed' => '此論壇不接受主題覆蓋。',
            ],
        ],

        'view' => [
            'admin_only' => '該討論區僅限管理員查看。',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '個人頁面被鎖定。',
                'not_owner' => '只能編輯自己的個人頁面。',
                'require_supporter_tag' => '需要成為osu!贊助者。',
            ],
        ],
    ],
];
