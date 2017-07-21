<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'header' => '多人游戏',
        'team-types' => [ //TODO 待翻译
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
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
        'in-progress' => '（正在游戏中）',
        'score' => [
            'stats' => [
                'accuracy' => '准确率',
                'combo' => '连击',
                'score' => '得分',
            ],
        ],
        'failed' => '失败',
        'teams' => [
            'blue' => '蓝队',
            'red' => '红队',
        ],
        'winner' => ':team 胜利',
        'difference' => '，高出另一队 :difference 分', //鬼畜翻译方案
        'loading-events' => '加载事件...',
        'more-events' => '查看全部...',
        'beatmap-deleted' => '删除谱面',
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
