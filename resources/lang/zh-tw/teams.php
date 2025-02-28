<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => '設定儲存成功',
        'title' => '隊伍設定',

        'description' => [
            'label' => '描述',
            'title' => '隊伍描述',
        ],

        'header' => [
            'label' => '標題圖片',
            'title' => '設定標題圖片',
        ],

        'logo' => [
            'label' => '隊伍旗幟',
            'title' => '設定隊伍旗幟',
        ],

        'settings' => [
            'application' => '隊伍申請',
            'application_help' => '是否開放他人申請加入隊伍？',
            'default_ruleset' => '預設遊戲模式',
            'default_ruleset_help' => '第一次進入組隊介面時預設選擇的遊戲模式',
            'title' => '隊伍設定',
            'url' => 'URL',

            'application_state' => [
                'state_0' => '關閉',
                'state_1' => '開放',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => '隊伍成員已移除',
        ],

        'index' => [
            'title' => '管理成員',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => '狀態',
                'joined_at' => '加入日期',
                'remove' => '移除',
                'title' => '目前的成員',
            ],

            'status' => [
                'status_0' => '不活躍',
                'status_1' => '活躍',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => '成立於',
            'website' => '個人網站',
        ],

        'members' => [
            'members' => '隊伍成員',
            'owner' => '隊長',
        ],

        'sections' => [
            'info' => '資訊',
            'members' => '成員',
        ],
    ],
];
