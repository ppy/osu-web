<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
