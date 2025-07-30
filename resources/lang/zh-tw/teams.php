<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '已將使用者加入團隊。',
        ],
        'destroy' => [
            'ok' => '已取消加入請求。',
        ],
        'reject' => [
            'ok' => '已拒絕加入請求。',
        ],
        'store' => [
            'ok' => '已請求加入團隊。',
        ],
    ],

    'card' => [
        'members' => ':count_delimited 位玩家|:count_delimited 位玩家',
    ],

    'create' => [
        'submit' => '建立隊伍',

        'form' => [
            'name_help' => '你的隊伍名稱。名稱為永久的。',
            'short_name_help' => '最多4個字元。',
            'title' => "讓我們設立一個新的隊伍",
        ],

        'intro' => [
            'description' => "與新舊朋友一齊玩。你目前不在隊伍中。你可以到訪好友的隊伍頁面加入，或在這裏建立自己的隊伍。",
            'title' => '隊伍！',
        ],
    ],

    'destroy' => [
        'ok' => '團隊已移除。',
    ],

    'edit' => [
        'ok' => '設定儲存成功。',
        'title' => '隊伍設定',

        'description' => [
            'label' => '敘述',
            'title' => '隊伍敘述',
        ],

        'flag' => [
            'label' => '隊伍旗幟',
            'title' => '設定隊伍旗幟',
        ],

        'header' => [
            'label' => '標題圖片',
            'title' => '設定標題圖片',
        ],

        'settings' => [
            'application_help' => '是否開放他人申請加入隊伍',
            'default_ruleset_help' => '第一次進入組隊介面時預設選擇的遊戲模式',
            'flag_help' => '最大尺寸為 :width×:height',
            'header_help' => '最大尺寸為 :width×:height',
            'title' => '隊伍設定',

            'application_state' => [
                'state_0' => '關閉',
                'state_1' => '開放',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '設定',
        'leaderboard' => '排行榜',
        'show' => '資訊',

        'members' => [
            'index' => '管理成員',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '全球排名',
    ],

    'members' => [
        'destroy' => [
            'success' => '隊伍成員已移除',
        ],

        'index' => [
            'title' => '管理成員',

            'applications' => [
                'accept_confirm' => '是否將玩家 :user 加入團隊？',
                'created_at' => '申請於',
                'empty' => '目前沒有加入請求。',
                'empty_slots' => '剩餘名額',
                'empty_slots_overflow' => ':count_delimited 位玩家超過上限',
                'reject_confirm' => '是否拒絕玩家 :user 的加入請求？',
                'title' => '加入請求',
            ],

            'table' => [
                'joined_at' => '加入日期',
                'remove' => '移除',
                'remove_confirm' => '是否將 :user 移出團隊？',
                'set_leader' => '轉讓隊長',
                'set_leader_confirm' => '是否轉讓隊長給玩家 :user？',
                'status' => '狀態',
                'title' => '目前的成員',
            ],

            'status' => [
                'status_0' => '不活躍',
                'status_1' => '活躍中',
            ],
        ],

        'set_leader' => [
            'success' => '玩家 :user 現在是隊長。',
        ],
    ],

    'part' => [
        'ok' => '離開了隊伍 ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '隊伍聊天',
            'destroy' => '解散隊伍',
            'join' => '請求加入',
            'join_cancel' => '取消加入',
            'part' => '離開隊伍',
        ],

        'info' => [
            'created' => '成立於',
        ],

        'members' => [
            'members' => '隊伍成員',
            'owner' => '隊伍領導人',
        ],

        'sections' => [
            'about' => '關於我們！',
            'info' => '資訊',
            'members' => '成員',
        ],

        'statistics' => [
            'empty_slots' => '',
            'leader' => '隊長',
            'rank' => '排名',
        ],
    ],

    'store' => [
        'ok' => '已建立團隊。',
    ],
];
