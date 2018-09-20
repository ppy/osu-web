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
        'beatmap-deleted' => '삭제된 비트맵',
        'difference' => '(점수 차: :difference)',
        'failed' => '실패',
        'header' => '멀티플레이 게임',
        'in-progress' => '(게임이 진행중입니다.)',
        'in_progress_spinner_label' => '게임이 진행중입니다',
        'loading-events' => '기록 불러오는 중...',
        'winner' => ':team 승리',

        'events' => [
            'player-left' => ':user님이 게임을 떠났습니다.',
            'player-joined' => ':user님이 게임에 참가했습니다.',
            'player-kicked' => ':user님이 게임에서 추방되었습니다.',
            'match-created' => ':user님이 게임을 개설하였습니다.',
            'match-disbanded' => '게임이 해체되었습니다.',
            'host-changed' => ':user님이 방장이 되었습니다.',

            'player-left-no-user' => '플레이어가 게임을 떠났습니다.',
            'player-joined-no-user' => '플레이어가 게임에 참가했습니다.',
            'player-kicked-no-user' => '플레이어가 게임에서 추방되었습니다.',
            'match-created-no-user' => '게임이 개설되었습니다.',
            'match-disbanded-no-user' => '게임이 해체되었습니다.',
            'host-changed-no-user' => '방장이 변경되었습니다.',
        ],

        'score' => [
            'stats' => [
                'accuracy' => '정확도',
                'combo' => '콤보',
                'score' => '점수',
            ],
        ],

        'team-types' => [
            'head-to-head' => '개인전',
            'tag-coop' => '태그 협동전',
            'team-vs' => '팀 대전',
            'tag-team-vs' => '팀 태그 대전',
        ],

        'teams' => [
            'blue' => 'Blue 팀',
            'red' => 'Red 팀',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => '최고 점수',
            'accuracy' => '최고 정확도',
            'combo' => '최다 콤보',
            'scorev2' => 'Score V2',
        ],
    ],
];
