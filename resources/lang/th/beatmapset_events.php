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
    'event' => [
        'approve' => 'อนุมัติ',
        'discussion_delete' => 'ผู้ดูแลลบการสนทนา :discussion',
        'discussion_post_delete' => 'ผู้ดูแลลบโพสต์จากการสนทนา: discussion',
        'discussion_post_restore' => 'ผู้ดูแลกู้คืนโพสต์จากการสนทนา :discussion',
        'discussion_restore' => 'ผู้ดูแลกู้คืนการสนทนา :discussion',
        'disqualify' => 'ถูกตัดสิทธิ์โดย :user ด้วยเหตุผล :discussion (:text)',
        'disqualify_legacy' => 'ถูกตัดสิทธิ์โดย :user: ด้วยเหตุผล :text',
        'issue_reopen' => 'ข้อผิดพลาดถูกแก้ไข การสนทนาถูกเปิดอีกครั้ง',
        'issue_resolve' => 'ข้อผิดพลาด :discussion ถูกทำเครื่องหมายว่าแก้ไขแล้ว',
        'kudosu_allow' => 'ถูกห้ามการให้ค่าชื่อเสียงแก่การสนทนา :discussion ถูกลบแล้ว',
        'kudosu_deny' => 'การสนทนา :discussion ถูกห้ามการให้ค่าชื่อเสียง',
        'kudosu_gain' => 'การสนทนา :discussion ได้รับโหวตมากพอเพื่อค่าชื่อเสียง',
        'kudosu_lost' => 'การสนทนา :discussion สูญเสียผลโหวตและค่าชื่อเสียงที่ได้รับถูกเอาออกแล้ว',
        'kudosu_recalculate' => 'การสนทนา :discussion ถูกทำให้ค่าชื่อเสียงโดนคำนวณใหม่',
        'love' => 'รักแล้วโดย :user',
        'nominate' => 'ถูกเสนอชื่อโดย :user',
        'nomination_reset' => 'ปัญหาใหม่ :discussion (:text) ทำให้เกิดการรีเซทการเสนอชื่อ',
        'qualify' => 'Beatmap นี้ได้ถึงจำนวนที่เสนอชื่อเข้าชิง และได้รับคุณภาพ',
        'rank' => 'จัดอันดับ',
    ],

    'index' => [
        'title' => 'กิจกรรมของ Beatmapset',
    ],

    'item' => [
        'content' => 'เนื้อหา',
        'discussion_deleted' => '[ถูกลบแล้ว]',
        'type' => 'ประเภท',
    ],
];
