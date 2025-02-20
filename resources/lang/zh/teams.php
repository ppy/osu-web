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
        'saved' => '设置保存成功',
        'title' => '队伍设置',

        'description' => [
            'label' => '介绍',
            'title' => '队伍介绍',
        ],

        'header' => [
            'label' => '头图',
            'title' => '设置头图',
        ],

        'logo' => [
            'label' => '队伍旗帜',
            'title' => '设置队伍旗帜',
        ],

        'settings' => [
            'application' => '队伍申请',
            'application_help' => '是否允许其他人申请加入队伍',
            'default_ruleset' => '默认游戏模式',
            'default_ruleset_help' => '第一次进入组队界面时默认选择的游戏模式',
            'title' => '队伍设置',
            'url' => 'URL',

            'application_state' => [
                'state_0' => '关闭',
                'state_1' => '开放',
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
            'success' => '已移除队员',
        ],

        'index' => [
            'title' => '管理队员',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => '状态',
                'joined_at' => '加入日期',
                'remove' => '移除',
                'title' => '当前队员',
            ],

            'status' => [
                'status_0' => '不活跃',
                'status_1' => '活跃',
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
            'created' => '创立于',
            'website' => '网站',
        ],

        'members' => [
            'members' => '队伍成员',
            'owner' => '队长',
        ],

        'sections' => [
            'info' => '信息',
            'members' => '成员',
        ],
    ],
];
