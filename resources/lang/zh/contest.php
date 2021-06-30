<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => '享受游戏以外的竞赛体验。',
        'large' => '社区评选',
    ],

    'index' => [
        'nav_title' => '列表',
    ],

    'voting' => [
        'login_required' => '请登录后再投票.',
        'over' => '这场评选的投票已经结束',
        'show_voted_only' => '显示投票',

        'best_of' => [
            'none_played' => "没有符合此次评选条件的谱面！",
        ],

        'button' => [
            'add' => '投票',
            'remove' => '取消投票',
            'used_up' => '你已经用光了投票次数',
        ],

        'progress' => [
            '_' => '',
        ],
    ],
    'entry' => [
        '_' => '列表',
        'login_required' => '请登录后再参加评选。',
        'silenced_or_restricted' => '账户受限时无法参加评选。',
        'preparation' => '我们正在准备这场评选，请耐心等待！',
        'drop_here' => '将您的参赛文件拖到此处',
        'download' => '下载 .osz',
        'wrong_type' => [
            'art' => '只接受 .jpg 和 .png 格式的文件.',
            'beatmap' => '只接受 .osu 格式的文件.',
            'music' => '只接受 .mp3 格式的文件.',
        ],
        'too_big' => '参赛文件的大小不能超过 :limit.',
    ],
    'beatmaps' => [
        'download' => '下载模板',
    ],
    'vote' => [
        'list' => '票数',
        'count' => ':count 票',
        'points' => ':count 分',
    ],
    'dates' => [
        'ended' => '结束于 :date',
        'ended_no_date' => '已结束',

        'starts' => [
            '_' => '开始于 :date',
            'soon' => '不久之后',
        ],
    ],
    'states' => [
        'entry' => '可参加',
        'voting' => '投票中',
        'results' => '已结束',
    ],
];
