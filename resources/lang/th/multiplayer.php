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
        'header' => 'Multiplayer Matches',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'ทีม VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user ออกจากแมตช์',
            'player-joined' => ':user เข้าร่วมแมตช์',
            'player-kicked' => ':user has been kicked from the match',
            'match-created' => ':user created the match',
            'match-disbanded' => 'the match was disbanded',
            'host-changed' => ':user became the host',

            'player-left-no-user' => 'a player left the match',
            'player-joined-no-user' => 'a player joined the match',
            'player-kicked-no-user' => 'a player has been kicked from the match',
            'match-created-no-user' => 'the match was created',
            'match-disbanded-no-user' => 'the match was disbanded',
            'host-changed-no-user' => 'the host was changed',
        ],
        'in-progress' => '(match in progress)',
        'score' => [
            'stats' => [
                'accuracy' => 'ความแม่นยำ',
                'combo' => 'คอมโบ',
                'score' => 'คะแนน',
            ],
        ],
        'failed' => 'ล้มเหลว',
        'teams' => [
            'blue' => 'ทีมสีน้ำเงิน',
            'red' => 'ทีมสีแดง',
        ],
        'winner' => ':team ชนะ',
        'difference' => 'โดยคะแนน :difference',
        'loading-events' => 'กำลังโหลดสิ่งที่เกิดขึ้น...',
        'more-events' => 'ดูทั้งหมด...',
        'beatmap-deleted' => 'beatmap ที่ถูกลบ',
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'คะแนนสูงสุด',
            'accuracy' => 'ความแม่นยำสูงสุด',
            'combo' => 'คอมโบสูงสุด',
            'scorev2' => 'คะแนน V2',
        ],
    ],
];
