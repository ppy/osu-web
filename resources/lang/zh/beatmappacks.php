<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => '围绕某个相同主题打包好的曲包',
        'nav_title' => '列表',
        'title' => '曲包',

        'blurb' => [
            'important' => '下载前必读',
            'instruction' => [
                '_' => "安装步骤：下载好曲包之后，直接将压缩包解压到 osu! 的 Songs 文件夹下。
                    所有的谱面此时都是 .zip 或 .osz 文件，osu! 会在下一次启动时自动载入这些谱面，
                    :scary 自己解压这些谱面。
                    否则这些谱面可能错误地显示并无法正常游玩。",
                'scary' => '不要',
            ],
            'note' => [
                '_' => '强烈建议 :scary，因为旧谱面的质量可能不如现在。',
                'scary' => '下载最新的曲包',
            ],
        ],
    ],

    'show' => [
        'download' => '下载',
        'item' => [
            'cleared' => '玩过',
            'not_cleared' => '未玩过',
        ],
        'no_diff_reduction' => [
            '_' => '若要解锁成就，则不能使用:link游玩谱面。',
            'link' => '降低难度的mod',
        ],
    ],

    'mode' => [
        'artist' => '艺术家/专辑',
        'chart' => '月赛',
        'standard' => '常规',
        'theme' => '主题',
    ],

    'require_login' => [
        '_' => '需要 :link 才能下载',
        'link_text' => '登录',
    ],
];
