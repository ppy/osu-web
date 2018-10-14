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
    'discussion-posts' => [
        'store' => [
            'error' => 'บันทึกโพสต์ล้มเหลว',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'อัพเดทโหวตล้มเหลว',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'อนุญาติการให้ค่าชื่อเสียง',
        'delete' => 'ลบ',
        'deleted' => 'ถูกลบโดย :editor เมื่อเวลา :delete_time',
        'deny_kudosu' => 'ปฏิเสธการให้ค่าชื่อเสียง',
        'edit' => 'แก้ไข',
        'edited' => 'แก้ไขล่าสุดโดย :editor เมื่อเวลา :update_time',
        'kudosu_denied' => 'ถูกปฏิเสธการให้ค่าชื่อเสียง',
        'message_placeholder_deleted_beatmap' => 'ระดับความยากนี้ถูกลบแล้วจึงไม่ควรถูกสนทนาถึง',
        'message_type_select' => 'เลือกประเภทคอมเม้นต์',
        'reply_notice' => 'กด Enter เพื่อตอบกลับ',
        'reply_placeholder' => 'พิมพ์คำตอบกลับที่นี่',
        'require-login' => 'กรุณาเข้าสู่ระบบเพื่อโพสต์หรือตอบกลับ',
        'resolved' => 'แก้ไขแล้ว',
        'restore' => 'กู้คืน',
        'title' => 'การสนทนา',

        'collapse' => [
            'all-collapse' => 'ซ่อนทั้งหมด',
            'all-expand' => 'ขยายทั้งหมด',
        ],

        'empty' => [
            'empty' => 'ยังไม่มีการสนทนา!',
            'hidden' => 'ไม่มีการสนทนาตามที่คุณเลือก',
        ],

        'message_hint' => [
            'in_general' => 'โพสต์นี้จะไปที่การสนทนาทั่วไป ถ้าอยาก Mod Beatmap นี้ เริ่มต้นข้อความของคุณด้วยช่วงเวลา (เช่น 00:12:345)',
            'in_timeline' => 'ในการ Mod หลายช่วงเวลา โพสต์หลายๆครั้ง (หนึ่งโพสต์ต่อหนึ่งช่วงเวลา)',
        ],

        'message_placeholder' => [
            'general' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีทั่วไป (:version)',
            'generalAll' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีทั่วไป (ทุกระดับความยาก)',
            'timeline' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีไปยังไทม์ไลน์ (:version)',
        ],

        'message_type' => [
            'disqualify' => 'ตัดสิทธิ์',
            'hype' => 'Hype!',
            'mapper_note' => 'หมายเหตุ',
            'nomination_reset' => 'รีเซทการเสนอชื่อ',
            'praise' => 'ชื่นชม',
            'problem' => 'ข้อผิดพลาด',
            'suggestion' => 'ข้อเสนอแนะ',
        ],

        'mode' => [
            'events' => 'ประวัติ',
            'general' => 'ทั่วไป :scope',
            'timeline' => 'เส้นเวลา',
            'scopes' => [
                'general' => 'ระดับความยากนี้',
                'generalAll' => 'ทุกระดับความยาก',
            ],
        ],

        'new' => [
            'timestamp' => 'ช่วงเวลา',
            'timestamp_missing' => 'กด ctrl-c ในหน้าแก้ไขแมพและกดวางในข้อความของคุณเพื่อเพิ่มช่วงเวลา!',
            'title' => 'การสนทนาใหม่',
        ],

        'show' => [
            'title' => ':title lสร้างโดย :mapper',
        ],

        'sort' => [
            '_' => 'เรียงตาม:',
            'created_at' => 'เวลาที่สร้าง',
            'timeline' => 'ไทม์ไลน์',
            'updated_at' => 'อัพเดทล่าสุด',
        ],

        'stats' => [
            'deleted' => 'ถูกลบไปแล้ว',
            'mapper_notes' => 'หมายเหตุ',
            'mine' => 'ของเรา',
            'pending' => 'ดำเนินการ',
            'praises' => 'ชื่นชม',
            'resolved' => 'แก้ไขแล้ว',
            'total' => 'ทั้งหมด',
        ],

        'status-messages' => [
            'approved' => 'Beatmap นี้ถูกอนุมัติในวันที่ :date',
            'graveyard' => "Beatmap นี้ไม่ถูกอัพเดทตั้งแต่ :date และน่าจะถูกละทิ้งโดยผู้ทำแมพไปแล้ว",
            'loved' => 'Beatmap นี้ถูก Loved ในวันที่ :date',
            'ranked' => 'Beatmap นี้ถูกจัดอันดับในวันที่ :date',
            'wip' => 'Beatmap นี้ถูกทำเครื่องหมายไว้ว่าอยู่ในระหว่างการทำ',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Hype ไปแล้ว!',
        'confirm' => "แน่ใจหรอ นี่จะใช้หนึ่งใน Hype ที่เหลือของคุณและไม่สามารถแก้ไขได้",
        'explanation' => 'Hype Beatmap นี้เพื่อทำให้ง่ายขึ้นต่อการเสนอชื่อและจัดอันดับ',
        'explanation_guest' => 'ลงชื่อเข้าใช้และ Hype Beatmap นี้เพื่อทำให้ง่ายขึ้นต่อการเสนอชื่อและจัดอันดับ',
        'new_time' => "คุณจะได้ Hype ใหม่ในวันที่ :new_time",
        'remaining' => 'คุณมี Hype เหลือ :remaining อัน',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'ฝากคำติชม',
    ],

    'nominations' => [
        'disqualification_prompt' => 'เหตุผลในการตัดสิทธิ์?',
        'disqualified_at' => 'ถูกตัดสิทธิ์เมื่อ :time_ago เพราะ (:reason)',
        'disqualified_no_reason' => 'ไม่มีเหตุผลที่ระบุไว้',
        'disqualify' => 'ตัดสิทธิ์',
        'incorrect_state' => 'เกิดข้อผิดพลาดในการดำเนินการ ลองรีเฟรชหน้าเพจนี้ดู',
        'love' => 'รัก',
        'love_confirm' => 'ชอบบีทแมพนี้หรือ',
        'nominate' => 'เสนอชื่อ',
        'nominate_confirm' => 'เสนอชื่อ Beatmap นี้?',
        'nominated_by' => 'เสนอชื่อโดย :users',
        'qualified' => 'คาดการณ์ว่าจะถูกจัดอันดับในเร็วๆนี้ ถ้าไม่พบปัญหาใดๆ',
        'qualified_soon' => 'คาดการณ์ว่าจะถูกจัดอันดับในเร็วๆนี้ ถ้าไม่พบปัญหาใดๆ',
        'required_text' => 'การเสนอชื่อ: :current/:required',
        'reset_message_deleted' => 'ถูกลบไปแล้ว',
        'title' => 'ข้อมูลการเสนอชื่อ',
        'unresolved_issues' => 'ยังมีปัญหาที่ต้องแก้ไขให้เสร็จก่อน',

        'reset_at' => [
            'nomination_reset' => 'การเสนอชื่อถูกรีเซ็ตเมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
            'disqualify' => 'ถูกตัดสิทธิ์เมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'คุณแน่ใจหรือ? ในการโพสต์ปัญหาใหม่จะรีเซ็ตการเสนอชื่อ',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'พิมพ์คำสำคัญ...',
            'login_required' => 'ลงชื่อเข้าใช้เพื่อค้นหา',
            'options' => 'ค้นหาเพิ่มเติม',
            'supporter_filter' => 'กรองโดย :filters ต้องมี osu!supporter tag ทำงานอยู่',
            'not-found' => 'ไม่มีผลการค้นหา',
            'not-found-quote' => '... ไม่อ่ะ ไม่เจออะไรเลย',
            'filters' => [
                'general' => 'ทั่วไป',
                'mode' => 'โหมด',
                'status' => 'หมวดหมู่',
                'genre' => 'ประเภท',
                'language' => 'ภาษา',
                'extra' => 'เพิ่มเติม',
                'rank' => 'แร้งค์ที่ได้รับ',
                'played' => 'เคยเล่นแล้ว',
            ],
            'sorting' => [
                'title' => 'ชื่อ',
                'artist' => 'ศิลปิน',
                'difficulty' => 'ระดับความยาก',
                'updated' => 'เพิ่งอัพเดต',
                'ranked' => 'จัดอันดับแล้ว',
                'rating' => 'คะแนน',
                'plays' => 'จำนวนการเล่น',
                'relevance' => 'ความเกี่ยวข้อง',
                'nominations' => 'เสนอชื่อเข้าชิง',
            ],
            'supporter_filter_quote' => [
                '_' => 'กรองโดย :filters ต้องมี :link ทำงานอยู่',
                'link_text' => 'osu!supporter tag (ผู้สนับสนุนเกม)',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'ระดับความยากที่แนะนำ',
        'converts' => 'รวมแมพคอนเวิรต์ด้วย',
    ],
    'mode' => [
        'any' => 'ไม่เจาะจง',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'ไม่เจาะจง',
        'ranked-approved' => 'จัดอันดับและอนุมัติ',
        'approved' => 'อนุมัติ',
        'qualified' => 'ผ่านเกณฑ์',
        'loved' => 'Loved',
        'faves' => 'รายการโปรด',
        'pending' => '',
        'graveyard' => 'สุสาน',
        'my-maps' => 'แมพของฉัน',
    ],
    'genre' => [
        'any' => 'ไม่เจาะจง',
        'unspecified' => 'ไม่ระบุ',
        'video-game' => 'วิดีโอเกม',
        'anime' => 'อนิเมะ',
        'rock' => 'ร็อค',
        'pop' => 'ป๊อป',
        'other' => 'อื่นๆ',
        'novelty' => 'นวนิยาย',
        'hip-hop' => 'ฮิปฮอป',
        'electronic' => 'อิเล็กทรอนิกส์',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => '',
    ],
    'language' => [
        'any' => 'Any',
        'english' => 'อังกฤษ',
        'chinese' => 'จีน',
        'french' => 'ฝรั่งเศส',
        'german' => 'เยอรมัน',
        'italian' => 'อิตาลี',
        'japanese' => 'ญี่ปุ่น',
        'korean' => 'เกาหลี',
        'spanish' => 'สเปน',
        'swedish' => 'สวีเดน',
        'instrumental' => 'เครื่องดนตรี',
        'other' => 'อื่นๆ',
    ],
    'played' => [
        'any' => 'ไม่เจาะจง',
        'played' => 'เคยเล่นแล้ว',
        'unplayed' => 'ยังไม่เคยเล่น',
    ],
    'extra' => [
        'video' => 'มีวิดีโอ',
        'storyboard' => 'มีกระดานเรื่องราว',
    ],
    'rank' => [
        'any' => 'ไม่เจาะจง',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
