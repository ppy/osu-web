<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'non_preserved' => '该成绩已被标记为删除，不久后它将消失。',
        'title' => ':username 在 :title [:version] 上的成绩',

        'beatmap' => [
            'by' => '- :artist',
        ],

        'player' => [
            'by' => '玩家',
            'submitted_on' => '达成时间',

            'rank' => [
                'country' => '地区排名',
                'global' => '全球排名',
            ],
        ],
    ],

    'status' => [
        'non_best' => '只有个人最好成绩才能获取到表现分（PP）',
        'no_pp' => '该分数没有表现分（PP）',
        'processing' => '该成绩仍在计算中，即将显示',
        'no_rank' => '该成绩未获得排名（谱面未上架或成绩已标记为删除）',
    ],
];
