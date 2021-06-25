<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'บีทแมพนี้ยังไม่สามารถดาวน์โหลดได้',
        'parts-removed' => 'บางส่วนของบีทแมพนี้ถูกลบตามคำขอของผู้แต่งหรือผู้ถือสิทธิ์บุคคลสาม',
        'more-info' => 'เช็คที่นี่เพื่อดูรายละเอียดเพิ่มเติม',
        'rule_violation' => 'เนื้อหาบางส่วนในแมพนี้ได้ถูกนำออกเนื่องจากถูกตัดสินว่าไม่เหมาะสมใน osu!',
    ],

    'download' => [
        'limit_exceeded' => 'ช้าลงหน่อย เล่นมากขึ้น',
    ],

    'index' => [
        'title' => 'รายการ Beatmap',
        'guest_title' => 'บีทแมพ',
    ],

    'panel' => [
        'empty' => 'ไม่มีบีทแมพ',

        'download' => [
            'all' => 'ดาวน์โหลด',
            'video' => 'ดาวน์โหลดพร้อมวิดีโอ',
            'no_video' => 'ดาวน์โหลดโดยไม่มีวิดีโอ',
            'direct' => 'เปิดใน osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'เซ็ตบีทแมพที่เป็นแบบไฮบริดจะต้องเลือกโหมดการเล่นอย่างน้อยหนึ่งโหมดที่จะเสนอชื่อให้',
        'incorrect_mode' => 'คุณไม่มีสิทธิในการเสนอชื่อในโหมด :mode',
        'full_bn_required' => 'คุณต้องเป็นผู้เสนอชื่อก่อนที่จะดำเนินการคุณสมบัตินี้ได้',
        'too_many' => 'ความต้องการเสนอชื่อได้สำเร็จแล้ว',

        'dialog' => [
            'confirmation' => 'คุณแน่ใจที่จะเสนอชื่อแมพนี้ใช่ไหม',
            'header' => 'เสนอชื่อบีทแมพ',
            'hybrid_warning' => 'โน้ต: คุณสามารถเสนอชื่อได้เพียงแค่ครั้งเดียว ดังนั้นโปรดตรวจสอบให้แน่ใจว่าคุณเสนอชื่อในเกมโหมดทั้งหมดที่คุณต้องการจะเสนอชื่อ',
            'which_modes' => 'เสนอชื่อให้โหมดไหน',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'ไม่เหมาะสม',
    ],

    'show' => [
        'discussion' => 'การสนทนา',

        'details' => [
            'by_artist' => 'โดย :artist',
            'favourite' => 'กดชื่นชอบ beatmapset นี้',
            'favourite_login' => 'ลงชื่อบีทแมพนี้เป็นรายการโปรด',
            'logged-out' => 'คุณต้องเข้าสู่ระบบก่อนที่จะดาวน์โหลดบีทแมพ',
            'mapped_by' => 'แมพโดย :mapper',
            'unfavourite' => 'เลิก Favourite beatmapset นี้',
            'updated_timeago' => 'อัปเดตล่าสุดเมื่อ :timeago',

            'download' => [
                '_' => 'ดาวน์โหลด',
                'direct' => '',
                'no-video' => 'ไม่มีวิดิโอ',
                'video' => 'พร้อมวิดิโอ',
            ],

            'login_required' => [
                'bottom' => 'เพื่อได้รับคุณสมบัติเพิ่มเติม',
                'top' => 'เข้าสู่ระบบ',
            ],
        ],

        'details_date' => [
            'approved' => 'อนุมัติ :timeago',
            'loved' => 'loved เมื่อ :timeago',
            'qualified' => 'qualified :timeago',
            'ranked' => 'จัดอันดับแล้วเมื่อ :timeago',
            'submitted' => 'ส่งเมื่อ :timeago',
            'updated' => 'อัปเดตครั้งล่าสุดเมื่อ :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'คุณมีบีทแมพที่ชื่นชอบมากเกินไป! กรุณาเอาออกบ้างแล้วลองอีกครั้ง',
        ],

        'hype' => [
            'action' => 'ให้กำลังใจแมพนี้ หากคุณสนุกกับการเล่นและต้องการช่วยเหลือไปยังสถานะ <strong>Ranked</strong>',

            'current' => [
                '_' => 'แมพนี้อยู่ในระหว่าง :status',

                'status' => [
                    'pending' => 'อยู่ระหว่างดำเนินการ',
                    'qualified' => 'qualified',
                    'wip' => 'อยู่ระหว่างดำเนินการ',
                ],
            ],

            'disqualify' => [
                '_' => 'ถ้าคุณพบปัญหากับบีทแมพนี้ ให้คุณยกเลิกสถานะ Qualified ของบีทแมพนี้ไป :link',
            ],

            'report' => [
                '_' => 'ถ้าคุณพบปัญหากับบีทแมพนี้ โปรดรายงานให้เราทราบผ่าน :link',
                'button' => 'รายงานปัญหา',
                'link' => 'ที่นี่',
            ],
        ],

        'info' => [
            'description' => 'คำอธิบาย',
            'genre' => 'ประเภท',
            'language' => 'ภาษา',
            'no_scores' => 'ข้อมูลกำลังถูกคำนวณ...',
            'nsfw' => 'เนื้อหาไม่เหมาะสม',
            'points-of-failure' => 'ความล้มเหลว',
            'source' => 'แหล่งที่มา',
            'storyboard' => 'บีทแมพนี้มี storyboard',
            'success-rate' => 'อัตราการผ่าน',
            'tags' => 'แท็ก',
            'video' => 'บีทแมพนี้มีวิดีโอ',
        ],

        'nsfw_warning' => [
            'details' => 'บีทแมพนี้มีเนื้อหาไม่เหมาะสม, รุนแรง, หรือรบกวนใจ คุณยังจะต้องการดูมันไหม',
            'title' => 'เนื้อหาไม่เหมาะสม',

            'buttons' => [
                'disable' => 'ปิดการแจ้งเตือน',
                'listing' => 'รายชื่อบีทแมพ',
                'show' => 'แสดง',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'ได้รับ :when',
            'country' => 'อันดับประเทศ',
            'friend' => 'อันดับเพื่อน',
            'global' => 'อันดับโลก',
            'supporter-link' => 'คลิก <a href=":link">ที่นี่</a> เพื่อดูสิ่งสวยงามทั้งหมดที่คุณได้รับ!',
            'supporter-only' => 'คุณต้องเป็นผู้สนับสนุนเพื่อเข้าถึงการจัดอันดับเพื่อนและประเทศ!',
            'title' => 'กระดานคะแนน',

            'headers' => [
                'accuracy' => 'ความแม่นยำ',
                'combo' => 'คอมโบสูงสุด',
                'miss' => 'Miss',
                'mods' => 'ม็อด',
                'player' => 'ผู้เล่น',
                'pp' => '',
                'rank' => 'อันดับ',
                'score_total' => 'คะแนนรวม',
                'score' => 'คะแนน',
                'time' => 'เวลา',
            ],

            'no_scores' => [
                'country' => 'ยังไม่มีใครในประเทศของคุณที่ทำคะแนนบนแมพนี้ได้!',
                'friend' => 'ยังไม่มีใครในเพือนของคุณที่ทำคะแนนบนแมพนี้ได้!',
                'global' => 'ยังไม่มีคะแนน บางทีคุณอาจจะลองทำดูนะ',
                'loading' => 'กำลังโหลดคะแนน...',
                'unranked' => 'แมพที่ไม่ได้จัดอันดับ',
            ],
            'score' => [
                'first' => 'นำ',
                'own' => 'คะแนนดีที่สุดของคุณ',
            ],
        ],

        'stats' => [
            'cs' => 'ขนาดวงกลม',
            'cs-mania' => 'จำนวนคีย์',
            'drain' => 'การลด HP',
            'accuracy' => 'ความแม่นยำ',
            'ar' => 'อัตราการเข้าใกล้',
            'stars' => 'ระดับความยาก',
            'total_length' => 'ความยาว',
            'bpm' => 'BPM',
            'count_circles' => 'จำนวนวงกลม',
            'count_sliders' => 'จำนวนสไลเดอร์',
            'user-rating' => 'คะแนน',
            'rating-spread' => 'การกระจายคะแนนโหวต',
            'nominations' => 'การเสนอชื่อ',
            'playcount' => 'จำนวนครั้งที่เล่น',
        ],

        'status' => [
            'ranked' => 'จัดอันดับแล้ว',
            'approved' => 'อนุมัติ',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'อยู่ระหว่างดำเนินการ',
            'graveyard' => 'สุสาน',
        ],
    ],
];
