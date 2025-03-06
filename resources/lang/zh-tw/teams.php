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

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => '團隊已移除',
    ],

    'edit' => [
        'ok' => '',
        'title' => '隊伍設定',

        'description' => [
            'label' => '描述',
            'title' => '隊伍描述',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => '標題圖片',
            'title' => '設定標題圖片',
        ],

        'settings' => [
            'application_help' => '是否開放他人申請加入隊伍',
            'default_ruleset_help' => '第一次進入組隊介面時預設選擇的遊戲模式',
            'flag_help' => '',
            'header_help' => '',
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
                'empty' => '目前沒有加入請求。',
                'empty_slots' => '剩餘名額',
                'title' => '加入請求',
                'created_at' => '申請日期：',
            ],

            'table' => [
                'status' => '狀態',
                'joined_at' => '加入日期',
                'remove' => '移除',
                'title' => '目前的成員',
            ],

            'status' => [
                'status_0' => '不活躍',
                'status_1' => '活躍中',
            ],
        ],
    ],

    'part' => [
        'ok' => '離開了隊伍 ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
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
            'info' => '資訊',
            'members' => '成員',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
