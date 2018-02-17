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
        'header' => '多人遊戲',
        'team-types' => [ //TODO 待翻譯
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user 離開了房間',
            'player-joined' => ':user 加入了房間',
            'player-kicked' => ':user 被踢出房間',
            'match-created' => ':user 創建了一個房間',
            'match-disbanded' => '房間關閉',
            'host-changed' => ':user 成爲房主',

            'player-left-no-user' => '有玩家離開了房間',
            'player-joined-no-user' => '有玩家加入了房間',
            'player-kicked-no-user' => '有玩家被踢出房間',
            'match-created-no-user' => '房間被創建',
            'match-disbanded-no-user' => '房間被關閉',
            'host-changed-no-user' => '房主已經變更',
        ],
        'in-progress' => '遊戲中...',
        'score' => [
            'stats' => [
                'accuracy' => '準確率',
                'combo' => '連擊',
                'score' => '得分',
            ],
        ],
        'failed' => '失敗',
        'teams' => [
            'blue' => '藍隊',
            'red' => '紅隊',
        ],
        'winner' => ':team 勝利',
        'difference' => '，領先 :difference 分',
        'loading-events' => '加載事件...',
        'more-events' => '查看全部...',
        'beatmap-deleted' => '刪除譜面',
    ],
    'game' => [
        'scoring-type' => [
            'score' => '最高分',
            'accuracy' => '最高準確率',
            'combo' => '最高連擊',
            'scorev2' => 'Score V2',
        ],
    ],
];
