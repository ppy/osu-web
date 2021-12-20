<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'show' => [
        'title' => ':username 在 :title [:version] 上的成绩',

        'beatmap' => [
            'by' => '曲师：:artist',
        ],

        'player' => [
            'by' => '玩家',
            'submitted_on' => '达成时间',

            'rank' => [
                'country' => '国内/区内排名',
                'global' => '全球排名',
            ],
        ],
    ],

    'status' => [
        'non_best' => '只有个人最好成绩才能获取到 pp',
        'processing' => '此分数仍在计算中，即将显示',
    ],
];
