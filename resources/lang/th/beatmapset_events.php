<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'อนุมัติ',
        'beatmap_owner_change' => 'เจ้าของระดับความยาก:beatmapเปลี่ยนเป็น:new_user',
        'discussion_delete' => 'ผู้ดูแลลบการสนทนา :discussion',
        'discussion_lock' => 'การสนทนาสำหรับบีทแมพนี้ถูกปิดใช้งาน (:text)',
        'discussion_post_delete' => 'ผู้ดูแลลบโพสต์จากการสนทนา:discussion',
        'discussion_post_restore' => 'ผู้ดูแลกู้คืนโพสต์จากการสนทนา :discussion',
        'discussion_restore' => 'ผู้ดูแลกู้คืนการสนทนา :discussion',
        'discussion_unlock' => 'การสนทนาสำหรับบีทแมพนี้ถูกเปิดใช้งาน',
        'disqualify' => 'ถูกตัดสิทธิ์โดย :user ด้วยเหตุผล :discussion (:text)',
        'disqualify_legacy' => 'ถูกตัดสิทธิ์โดย :user: ด้วยเหตุผล :text',
        'genre_edit' => 'แก้ไขหมวดจาก :old เป็น :new',
        'issue_reopen' => 'ข้อผิดพลาดถูกแก้ไข การสนทนา :discussion ถูกเปิดอีกครั้ง',
        'issue_resolve' => 'ข้อผิดพลาด :discussion ถูกทำเครื่องหมายว่าแก้ไขแล้ว',
        'kudosu_allow' => 'ถูกห้ามการให้ Kudosu แก่การสนทนา :discussion ถูกลบแล้ว',
        'kudosu_deny' => 'การสนทนา :discussion ถูกห้ามการให้ kudosu',
        'kudosu_gain' => 'การสนทนา :discussion ของ :user ได้รับโหวตมากพอที่จะได้ kudosu',
        'kudosu_lost' => 'การสนทนา :discussion ของ :user สูญเสียผลโหวตและ kudosu ที่ได้รับถูกเอาออกแล้ว',
        'kudosu_recalculate' => 'การสนทนา :discussion ถูกทำให้ kudosu โดนคำนวณใหม่',
        'language_edit' => 'แก้ไขภาษาจาก :old เป็น :new',
        'love' => 'รักแล้วโดย :user',
        'nominate' => 'ถูกเสนอชื่อโดย :user',
        'nominate_modes' => 'เสนอชื่อโดย :user (:modes)',
        'nomination_reset' => 'ปัญหาใหม่ :discussion (:text) ทำให้เกิดการรีเซทการเสนอชื่อ',
        'nomination_reset_received' => 'การ nominate โดย :user ถูกรีเซ็ตโดย :source_user (:text)',
        'nomination_reset_received_profile' => 'การ nominate ถูกรีเซ็ตโดย :user (:text)',
        'qualify' => 'บีทแมพนี้ได้รับจำนวนการเสนอชื่อครบแล้ว และได้ถูก Qualified',
        'rank' => 'จัดอันดับ',
        'remove_from_loved' => 'ถูกนำออกจาก Loved โดย :user (:text)',

        'nsfw_toggle' => [
            'to_0' => 'นำเครื่องหมายเนื้อหาล่อแหลมออก',
            'to_1' => 'ตั้งไว้ว่าเป็นเนื้อหาล่อแหลม',
        ],
    ],

    'index' => [
        'title' => 'กิจกรรมของ Beatmapset',

        'form' => [
            'period' => 'ระยะเวลา',
            'types' => 'ประเภท',
        ],
    ],

    'item' => [
        'content' => 'เนื้อหา',
        'discussion_deleted' => '[ถูกลบแล้ว]',
        'type' => 'ประเภท',
    ],

    'type' => [
        'approve' => 'การอนุมัติ',
        'beatmap_owner_change' => 'เปลี่ยนเจ้าของระดับความยาก',
        'discussion_delete' => 'การลบบทสนทนา',
        'discussion_post_delete' => 'การลบการตอบกลับในบทสนทนา',
        'discussion_post_restore' => 'การกู้คืนการตอบกลับในบทสนทนา',
        'discussion_restore' => 'การกู้คืนบทสนทนา',
        'disqualify' => 'การตัดสิทธิ์',
        'genre_edit' => 'แก้ไขหมวด',
        'issue_reopen' => 'กำลังเปิดใช้งานการสนทนาอีกครั้ง',
        'issue_resolve' => 'กำลังแก้ไขการสนทนา',
        'kudosu_allow' => 'อนุญาต Kudosu',
        'kudosu_deny' => 'ปฏิเสธ Kudosu',
        'kudosu_gain' => 'ได้รับ Kudosu',
        'kudosu_lost' => 'เสีย Kudosu',
        'kudosu_recalculate' => 'การคำนวณ Kudosu',
        'language_edit' => 'แก้ไขภาษา',
        'love' => 'รักเลย',
        'nominate' => 'การเสนอชื่อ',
        'nomination_reset' => 'กำลังตั้งค่าการเสนอชื่อใหม่',
        'nomination_reset_received' => 'ได้รับการรีเซ็ต nomination แล้ว',
        'nsfw_toggle' => 'เครื่องหมายเนื้อหาล่อแหลม',
        'qualify' => 'คุณสมบัติ',
        'rank' => 'อันดับ',
        'remove_from_loved' => 'ถูกนำออกจาก Loved',
    ],
];
