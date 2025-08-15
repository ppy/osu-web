<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '已将玩家添加进战队。',
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

    'card' => [
        'members' => ':count_delimited 成员',
    ],

    'create' => [
        'submit' => '创建战队',

        'form' => [
            'name_help' => '你的战队名称。目前不可再修改。',
            'short_name_help' => '最多4个字符。',
            'title' => "来组建战队吧",
        ],

        'intro' => [
            'description' => "与新老朋友一起游戏吧。你目前并未加入任何战队，但你可以在这一页内，访问其他战队的主页并加入，或是直接创建你自己的战队。",
            'title' => '战队！',
        ],
    ],

    'destroy' => [
        'ok' => '已删除战队',
    ],

    'edit' => [
        'ok' => '设置已成功保存。',
        'title' => '战队设置',

        'description' => [
            'label' => '介绍',
            'title' => '战队介绍',
        ],

        'flag' => [
            'label' => '战队旗帜',
            'title' => '设置战队旗帜',
        ],

        'header' => [
            'label' => '战队头像',
            'title' => '设置战队头像',
        ],

        'settings' => [
            'application_help' => '是否允许其他人申请加入战队',
            'default_ruleset_help' => '第一次进入战队界面时默认选择的游戏模式',
            'flag_help' => '最大尺寸 :width×:height',
            'header_help' => '最大尺寸 :width×:height',
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
                'accept_confirm' => '确定将玩家 :user 添加进战队吗？',
                'created_at' => '申请日期：',
                'empty' => '目前没有加入请求。',
                'empty_slots' => '剩余名额',
                'empty_slots_overflow' => ':count_delimited 名玩家超限',
                'reject_confirm' => '确定拒绝玩家 :user 的加入请求吗？',
                'title' => '加入战队申请',
            ],

            'table' => [
                'joined_at' => '加入日期',
                'remove' => '移除',
                'remove_confirm' => '确定将玩家 :user 移出战队吗？',
                'set_leader' => '转让队长',
                'set_leader_confirm' => '确定将队长转让给玩家 :user 吗？',
                'status' => '状态',
                'title' => '当前战队成员',
            ],

            'status' => [
                'status_0' => '不活跃',
                'status_1' => '活跃',
            ],
        ],

        'set_leader' => [
            'success' => '玩家 :user 现在是战队队长。',
        ],
    ],

    'part' => [
        'ok' => '已离开战队 ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '战队聊天',
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
            'about' => '关于我们！',
            'info' => '信息',
            'members' => '成员',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited 栏位可用',
            'leader' => '队长',
            'rank' => '排名',
        ],
    ],

    'store' => [
        'ok' => '已创建战队。',
    ],
];
