<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'match' => [
        'beatmap-deleted' => '删除谱面',
        'difference' => '，领先 :difference 分',
        'failed' => '失败',
        'header' => '多人游戏',
        'in-progress' => '游戏中...',
        'in_progress_spinner_label' => '游戏进行中',
        'loading-events' => '加载事件...',
        'winner' => ':team 胜利',

        'events' => [
            'player-left' => ':user 离开了房间',
            'player-joined' => ':user 加入了房间',
            'player-kicked' => ':user 被踢出房间',
            'match-created' => ':user 创建了一个房间',
            'match-disbanded' => '房间关闭',
            'host-changed' => ':user 成为房主',

            'player-left-no-user' => '有玩家离开了房间',
            'player-joined-no-user' => '有玩家加入了房间',
            'player-kicked-no-user' => '有玩家被踢出房间',
            'match-created-no-user' => '房间被创建',
            'match-disbanded-no-user' => '房间被关闭',
            'host-changed-no-user' => '房主已经变更',
        ],

        'score' => [
            'stats' => [
                'accuracy' => '准确率',
                'combo' => '连击',
                'score' => '得分',
            ],
        ],

        'team-types' => [
            'head-to-head' => '个人',
            'tag-coop' => '接力',
            'team-vs' => '组队',
            'tag-team-vs' => '组队接力',
        ],

        'teams' => [
            'blue' => '蓝队',
            'red' => '红队',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => '最高分',
            'accuracy' => '最高准确率',
            'combo' => '最高连击',
            'scorev2' => 'Score V2',
        ],
    ],
];
