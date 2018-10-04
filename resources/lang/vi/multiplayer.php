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
        'beatmap-deleted' => 'beatmap đã bị xóa',
        'difference' => 'với :difference',
        'failed' => 'THẤT BẠI',
        'header' => 'Những trận đấu Multiplayer',
        'in-progress' => '(trận đấu đang diễn ra)',
        'in_progress_spinner_label' => 'trận đấu đang diễn ra',
        'loading-events' => 'Đang tải các sự kiện...',
        'winner' => ':team thắng',

        'events' => [
            'player-left' => ':user đã rời khỏi trận đấu',
            'player-joined' => ':user đã tham gia trận đấu',
            'player-kicked' => ':user đã bị kick khỏi trận đấu',
            'match-created' => ':user đã tạo trận đấu',
            'match-disbanded' => 'trận đấu đã giải tán',
            'host-changed' => ':user đã trở thành chủ trận đấu',

            'player-left-no-user' => 'một người chơi đã rời khỏi trận đấu',
            'player-joined-no-user' => 'một người chơi đã tham gia trận đấu',
            'player-kicked-no-user' => 'một người chơi đã bị kick khỏi trận đấu',
            'match-created-no-user' => 'trận đấu đã được tạo',
            'match-disbanded-no-user' => 'trận đấu đã giải tán',
            'host-changed-no-user' => 'đã thay đổi chủ trận đấu',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Độ chính xác',
                'combo' => 'Combo',
                'score' => 'Điểm',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Đội Xanh',
            'red' => 'Đội Đỏ',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Điểm Cao Nhất',
            'accuracy' => 'Độ Chính Xác Cao Nhất',
            'combo' => 'Combo Cao Nhất',
            'scorev2' => 'Score V2',
        ],
    ],
];
