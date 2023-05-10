<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'beatmap ที่ถูกลบ',
        'failed' => 'ล้มเหลว',
        'header' => 'แข่งขันแบบหลายคน',
        'in-progress' => '(การแข่งขันกำลังดำเนินการ)',
        'in_progress_spinner_label' => 'การแข่งขันกำลังดำเนินการ',
        'loading-events' => 'กำลังโหลดสิ่งที่เกิดขึ้น...',
        'winner' => ':team ชนะ',
        'winner_by' => '',

        'events' => [
            'player-left' => ':user ออกจากแมตช์',
            'player-joined' => ':user เข้าร่วมแมตช์',
            'player-kicked' => ':user ถูกเตะออกจากการแข่งขัน',
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

        'score' => [
            'stats' => [
                'accuracy' => 'ความแม่นยำ',
                'combo' => 'คอมโบ',
                'score' => 'คะแนน',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'ตัว ต่อ ตัว',
            'tag-coop' => 'แท็ก Co-op',
            'team-vs' => 'ทีม VS',
            'tag-team-vs' => 'แท็กทีม VS',
        ],

        'teams' => [
            'blue' => 'ทีมสีน้ำเงิน',
            'red' => 'ทีมสีแดง',
        ],
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
