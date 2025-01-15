<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '不如馬上玩點 osu! 吧？',
    'require_login' => '登入以繼續。',
    'require_verification' => '驗證以繼續。',
    'restricted' => "帳號處於限制模式，無法進行該操作。",
    'silenced' => "帳號被禁言，無法進行該操作。",
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
            'not_owner' => '只有樓主和圖譜擁有者才能標記為已解決。',
        ],

        'store' => [
            'mapper_note_wrong_user' => '只有圖譜製作者或圖譜管理團隊/品質保證團隊可以發布備註。',
        ],

        'vote' => [
            'bot' => "不能為機器人建立的討論投票。",
            'limit_exceeded' => '請稍候片刻再進行投票',
            'owner' => "不能為自己的討論投票。",
            'wrong_beatmapset_state' => '只能對待處理的圖譜討論進行投票。',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '您只能刪除自己的貼文。',
            'resolved' => '你不能刪除已解決的討論串。',
            'system_generated' => '自動生成的貼文無法刪除。',
        ],

        'edit' => [
            'not_owner' => '只有發文者可以編輯。',
            'resolved' => '你不能編輯已解決討論裡的貼文。',
            'system_generated' => '無法編輯自動回覆。',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '這個圖譜被鎖定討論。',

        'metadata' => [
            'nominated' => '你不能修改已提名的圖譜資訊。如果你認為有誤，請聯絡 BN 或 NAT 成員。',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => '您必須先在一個圖譜取得分數才能新增標籤。',
        ],
    ],

    'chat' => [
        'blocked' => '無法向封鎖你或被你封鎖的人傳送訊息。',
        'friends_only' => '這個使用者未開放陌生訊息',
        'moderated' => '這個頻道目前受到管制。',
        'no_access' => '你沒有權限存取該頻道。',
        'no_announce' => '你沒有權限發布公告。',
        'receive_friends_only' => '由於您只接受好友訊息，故使用者可能無法回應。',
        'restricted' => '您不能在被禁言、限制或封鎖期間傳送訊息。',
        'silenced' => '您不能在被禁言、限制或封鎖期間傳送訊息。',
    ],

    'comment' => [
        'store' => [
            'disabled' => '留言已停用',
        ],
        'update' => [
            'deleted' => "無法編輯已刪除的回覆。",
        ],
    ],

    'contest' => [
        'judging_not_active' => '本次競賽尚未進入評分階段。',
        'voting_over' => '投票已結束，禁止重新投票。',

        'entry' => [
            'limit_reached' => '您已達到此競賽的參賽上限',
            'over' => '感謝參與！提交已經關閉，投票即將開始。',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => '沒有權限編輯這個論壇。',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => '只有最後一篇貼文可以刪除。',
                'locked' => '無法刪除已鎖定主題的貼文。',
                'no_forum_access' => '沒有權限進入該論壇。',
                'not_owner' => '只有發文者可以刪除貼文。',
            ],

            'edit' => [
                'deleted' => '無法編輯已刪除的貼文。',
                'locked' => '這篇貼文已鎖定，無法編輯。',
                'no_forum_access' => '需要有存取該論壇的權限。',
                'not_owner' => '只有發文者可以編輯貼文。',
                'topic_locked' => '無法編輯已鎖定主題的貼文。',
            ],

            'store' => [
                'play_more' => '在論壇發文前，請先嘗試遊玩遊戲！如果您在遊玩過程中遇到問題，請在「說明與支援」論壇發文。',
                'too_many_help_posts' => "您需要再玩久一點才可以發布更多貼文，如果您仍然在遊戲中遇到問題，請聯絡 support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '請編輯您的最後一則貼文，而不是再次發布。',
                'locked' => '無法回覆被鎖定的主題。',
                'no_forum_access' => '沒有權限，無法進入該論壇。',
                'no_permission' => '沒有權限，無法回覆。',

                'user' => [
                    'require_login' => '回覆前請先登入。',
                    'restricted' => "帳號處於限制模式，無法回覆。",
                    'silenced' => "帳號被禁言，無法回覆。",
                ],
            ],

            'store' => [
                'no_forum_access' => '沒有權限，無法進入該論壇。',
                'no_permission' => '沒有權限，無法建立新主題。',
                'forum_closed' => '該討論區已關閉，無法發布新主題。',
            ],

            'vote' => [
                'no_forum_access' => '沒有權限，無法進入該論壇。',
                'over' => '投票已結束！',
                'play_more' => '你需要多玩一點才可以在論壇上投票。',
                'voted' => '不允許修改投票。',

                'user' => [
                    'require_login' => '投票前請先登入。',
                    'restricted' => "帳號處於限制模式，無法投票。",
                    'silenced' => "帳號被禁言，無法投票。",
                ],
            ],

            'watch' => [
                'no_forum_access' => '沒有權限，無法進入該論壇。',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => '指定的封面不可用。',
                'not_owner' => '只有樓主可以編輯封面。',
            ],
            'store' => [
                'forum_not_allowed' => '這個論壇不接受主題覆蓋。',
            ],
        ],

        'view' => [
            'admin_only' => '這個討論區僅限管理員查看。',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => '只有房間主人才能關閉。',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "無法置頂這類分數。",
            'failed' => "無法置頂未過關的成績。",
            'not_owner' => '只有擁有者才可置頂成績。',
            'too_many' => '置頂過多成績。',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => '個人頁面被鎖定。',
                'not_owner' => '只能編輯自己的個人頁面。',
                'require_supporter_tag' => '需要成為 osu! 贊助者。',
            ],
        ],
        'update_email' => [
            'locked' => '電子郵件地址已鎖定',
        ],
    ],
];
