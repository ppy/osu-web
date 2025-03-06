<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '将玩家添加进战队。',
        ],
        'destroy' => [
            'ok' => '已取消加入战队请求。',
        ],
        'reject' => [
            'ok' => '已拒绝加入战队请求。',
        ],
        'store' => [
            'ok' => '已请求加入战队。',
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
        'ok' => '已删除战队',
    ],

    'edit' => [
        'ok' => '',
        'title' => '战队设置',

        'description' => [
            'label' => '介绍',
            'title' => '战队介绍',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => '战队头像',
            'title' => '设置战队头像',
        ],

        'settings' => [
            'application_help' => '是否允许其他人申请加入战队',
            'default_ruleset_help' => '第一次进入组队界面时默认选择的游戏模式',
            'flag_help' => '',
            'header_help' => '',
            'title' => '战队设置',

            'application_state' => [
                'state_0' => '关闭',
                'state_1' => '开放',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '设置',
        'leaderboard' => '排行榜',
        'show' => '信息',

        'members' => [
            'index' => '管理战队成员',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '全球排名',
    ],

    'members' => [
        'destroy' => [
            'success' => '已移除战队成员',
        ],

        'index' => [
            'title' => '管理战队成员',

            'applications' => [
                'empty' => '目前没有加入战队请求。',
                'empty_slots' => '剩余名额',
                'title' => '加入战队申请',
                'created_at' => '请求于',
            ],

            'table' => [
                'status' => '状态',
                'joined_at' => '加入日期',
                'remove' => '移除',
                'title' => '当前战队成员',
            ],

            'status' => [
                'status_0' => '不活跃',
                'status_1' => '活跃',
            ],
        ],
    ],

    'part' => [
        'ok' => '已离开战队 ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
            'destroy' => '解散战队',
            'join' => '请求加入',
            'join_cancel' => '取消加入',
            'part' => '离开战队',
        ],

        'info' => [
            'created' => '创立于',
        ],

        'members' => [
            'members' => '战队成员',
            'owner' => '队长',
        ],

        'sections' => [
            'info' => '信息',
            'members' => '成员',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
