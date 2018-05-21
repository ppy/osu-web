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
        'header' => 'แข่งขันแบบหลายคน',
        'team-types' => [
            'head-to-head' => 'ตัว ต่อ ตัว',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'ทีม VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user ออกจากแมตช์',
            'player-joined' => ':user เข้าร่วมแมตช์',
            'player-kicked' => ':user ถูกเตะออกจากการแข่งขันแล้ว',
            'match-created' => ':user ได้สร้างการแข่งขัน',
            'match-disbanded' => 'การแข่งขันถูกยกเลิก',
            'host-changed' => ':user กลายเป็นโฮส',

            'player-left-no-user' => 'ผู้เล่นออกจากการแข่งขัน',
            'player-joined-no-user' => 'ผู้เล่น เข้าร่วมการแข่งขัน',
            'player-kicked-no-user' => 'ผู้เล่นถูกเตะออกจากการแข่งขัน',
            'match-created-no-user' => 'การแข่งขันถูกสร้าง',
            'match-disbanded-no-user' => 'การแข่งขันถูกยกเลิก',
            'host-changed-no-user' => 'โฮสได้มีการเปลี่ยน',
        ],
        'in-progress' => '(การแข่งขันกำลังดำเนินการ)',
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
