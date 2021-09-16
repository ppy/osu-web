<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'อัปเดตโหวตล้มเหลว',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'อนุญาตการให้ kudosu',
        'beatmap_information' => 'หน้าบีทแมพ',
        'delete' => 'ลบ',
        'deleted' => 'ถูกลบโดย :editor เมื่อเวลา :delete_time',
        'deny_kudosu' => 'ปฏิเสธการให้ kudosu',
        'edit' => 'แก้ไข',
        'edited' => 'แก้ไขล่าสุดโดย :editor เมื่อเวลา :update_time',
        'guest' => 'ระดับความยากของแขกโดย:user',
        'kudosu_denied' => 'ถูกปฏิเสธการให้ kudosu',
        'message_placeholder_deleted_beatmap' => 'ระดับความยากนี้ถูกลบแล้วจึงไม่ควรถูกสนทนาถึง',
        'message_placeholder_locked' => 'การสนทนาสำหรับบีทแมพนี้ถูกปิดใช้งาน',
        'message_placeholder_silenced' => "ไม่สามารถโพสต์การสนทนาในขณะที่โดนเงียบ",
        'message_type_select' => 'เลือกประเภทความคิดเห็น',
        'reply_notice' => 'กด Enter เพื่อตอบกลับ',
        'reply_placeholder' => 'พิมพ์คำตอบกลับที่นี่',
        'require-login' => 'กรุณาเข้าสู่ระบบเพื่อโพสต์หรือตอบกลับ',
        'resolved' => 'แก้ไขแล้ว',
        'restore' => 'กู้คืน',
        'show_deleted' => 'แสดงรายการที่ถูกลบ',
        'title' => 'การสนทนา',

        'collapse' => [
            'all-collapse' => 'ซ่อนทั้งหมด',
            'all-expand' => 'ขยายทั้งหมด',
        ],

        'empty' => [
            'empty' => 'ยังไม่มีการสนทนา!',
            'hidden' => 'ไม่มีการสนทนาตามที่คุณเลือก',
        ],

        'lock' => [
            'button' => [
                'lock' => 'ล็อกการสนทนา',
                'unlock' => 'ปลดล็อกการสนทนา',
            ],

            'prompt' => [
                'lock' => 'เหตุผลสำหรับการล็อก',
                'unlock' => 'คุณแน่ใจที่จะปลดล็อกหรือไม่?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'โพสต์นี้จะไปที่การสนทนาทั่วไป ถ้าอยากวิจารณ์บีทแมพนี้ เริ่มต้นข้อความของคุณด้วยช่วงเวลา (เช่น 00:12:345)',
            'in_timeline' => 'ในการวิจารณ์หลายช่วงเวลา โพสต์หลายๆครั้ง (หนึ่งโพสต์ต่อหนึ่งช่วงเวลา)',
        ],

        'message_placeholder' => [
            'general' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีทั่วไป (:version)',
            'generalAll' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีทั่วไป (ทุกระดับความยาก)',
            'review' => 'เขียนที่นี่เพื่อเพิ่มบทวิจารณ์',
            'timeline' => 'พิมพ์ตรงนี้เพื่อลงรายการบัญชีไปยังไทม์ไลน์ (:version)',
        ],

        'message_type' => [
            'disqualify' => 'ตัดสิทธิ์',
            'hype' => 'Hype!',
            'mapper_note' => 'หมายเหตุ',
            'nomination_reset' => 'รีเซทการเสนอชื่อ',
            'praise' => 'ชื่นชม',
            'problem' => 'ข้อผิดพลาด',
            'review' => 'บทวิจารณ์',
            'suggestion' => 'ข้อเสนอแนะ',
        ],

        'mode' => [
            'events' => 'ประวัติ',
            'general' => 'ทั่วไป :scope',
            'reviews' => 'บทวิจารณ์',
            'timeline' => 'เส้นเวลา',
            'scopes' => [
                'general' => 'ระดับความยากนี้',
                'generalAll' => 'ทุกระดับความยาก',
            ],
        ],

        'new' => [
            'pin' => 'ปักหมุด',
            'timestamp' => 'ช่วงเวลา',
            'timestamp_missing' => 'กด ctrl-c ในหน้าแก้ไขแมพและกดวางในข้อความของคุณเพื่อเพิ่มช่วงเวลา!',
            'title' => 'การสนทนาใหม่',
            'unpin' => 'ยกเลิกการปักหมุด',
        ],

        'review' => [
            'new' => 'บทวิจารณ์ใหม่',
            'embed' => [
                'delete' => 'ลบ',
                'missing' => '[ข้อความถูกลบ]',
                'unlink' => 'เลิกการเชื่อมโยง',
                'unsaved' => 'ยังไม่ได้บันทึก',
                'timestamp' => [
                    'all-diff' => 'โพสต์ในหมวด "ทุกระดับความยาก" จะไม่สามารถใส่ประทับเวลาได้',
                    'diff' => 'ถ้า :type เริ่มต้นด้วยการประทับเวลา สิ่งเหล่านั้นจะถูกแสดงภายใต้ไทม์ไลน์',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'แทรกย่อหน้า',
                'praise' => 'ชื่นชม',
                'problem' => 'เพิ่มปัญหา',
                'suggestion' => 'เพิ่มคำแนะนำ',
            ],
        ],

        'show' => [
            'title' => ':title แมพโดย :mapper',
        ],

        'sort' => [
            'created_at' => 'เวลาที่สร้าง',
            'timeline' => 'ไทม์ไลน์',
            'updated_at' => 'อัปเดตล่าสุด',
        ],

        'stats' => [
            'deleted' => 'ถูกลบไปแล้ว',
            'mapper_notes' => 'หมายเหตุ',
            'mine' => 'ของเรา',
            'pending' => 'อยู่ระหว่างดำเนินการ',
            'praises' => 'ชื่นชม',
            'resolved' => 'แก้ไขแล้ว',
            'total' => 'ทั้งหมด',
        ],

        'status-messages' => [
            'approved' => 'Beatmap นี้ถูกอนุมัติในวันที่ :date',
            'graveyard' => "บีทแมพนี้ไม่ถูกอัปเดตตั้งแต่ :date และน่าจะถูกละทิ้งโดยผู้ทำแมพไปแล้ว",
            'loved' => 'บีทแมพนี้ถูก Loved ในวันที่ :date',
            'ranked' => 'บีทแมพนี้ถูกจัดอันดับในวันที่ :date',
            'wip' => 'บีทแมพนี้ถูกทำเครื่องหมายไว้ว่าอยู่ในระหว่างการทำ',
        ],

        'votes' => [
            'none' => [
                'down' => 'ยังไม่มีคนไม่เห็นด้วย',
                'up' => 'ยังไม่มีคนเห็นด้วย',
            ],
            'latest' => [
                'down' => 'ความคิดเห็นที่ไม่เห็นด้วยล่าสุด',
                'up' => 'ความคิดเห็นที่เห็นด้วยล่าสุด',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Hype ไปแล้ว!',
        'confirm' => "แน่ใจหรอ นี่จะใช้หนึ่งใน :n Hype ที่เหลือของคุณและไม่สามารถแก้ไขได้",
        'explanation' => 'Hype บีทแมพนี้เพื่อทำให้ง่ายขึ้นต่อการเสนอชื่อและจัดอันดับ',
        'explanation_guest' => 'ลงชื่อเข้าใช้และ Hype บีทแมพนี้เพื่อทำให้ง่ายขึ้นต่อการเสนอชื่อและจัดอันดับ',
        'new_time' => "คุณจะได้ Hype ใหม่ใน :new_time",
        'remaining' => 'คุณมี Hype เหลือ :remaining อัน',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'ฝากคำติชม',
    ],

    'nominations' => [
        'delete' => 'ลบ',
        'delete_own_confirm' => 'คุณแน่ใจใช่ไหม? บีทแมพจะถูกลบและคุณจะถูกนำกลับไปยังหน้าโปรไฟล์ของคุณ',
        'delete_other_confirm' => 'คุณแน่ใจใช่ไหม? บีทแมพจะถูกลบและคุณจะถูกนำกลับไปยังหน้าโปรไฟล์ของผู้เล่น',
        'disqualification_prompt' => 'เหตุผลในการตัดสิทธิ์?',
        'disqualified_at' => 'ถูกตัดสิทธิ์เมื่อ :time_ago เพราะ (:reason)',
        'disqualified_no_reason' => 'ไม่มีเหตุผลที่ระบุไว้',
        'disqualify' => 'ตัดสิทธิ์',
        'incorrect_state' => 'เกิดข้อผิดพลาดในการดำเนินการ ลองรีเฟรชหน้าเพจนี้ดู',
        'love' => 'Love',
        'love_choose' => '',
        'love_confirm' => 'ชอบบีทแมพนี้หรือ?',
        'nominate' => 'เสนอชื่อ',
        'nominate_confirm' => 'เสนอชื่อบีทแมพนี้?',
        'nominated_by' => 'เสนอชื่อโดย :users',
        'not_enough_hype' => "ไม่มี Hype เพียงพอ",
        'remove_from_loved' => 'ถูกนำออกจาก Loved',
        'remove_from_loved_prompt' => 'เหตุผลในการถูกออกจาก Loved',
        'required_text' => 'การเสนอชื่อ: :current/:required',
        'reset_message_deleted' => 'ถูกลบไปแล้ว',
        'title' => 'ข้อมูลการเสนอชื่อ',
        'unresolved_issues' => 'ยังมีปัญหาที่ต้องแก้ไขให้เสร็จก่อน',

        'rank_estimate' => [
            '_' => 'แมพนี้จะถูก ranked  ใน :date ถ้าไม่พบเจอปัญหาเพิ่มเติม แมพนี้อยู่ที่ #:position ใน :queue',
            'queue' => 'คิวการ rank',
            'soon' => 'เร็ว ๆ นี้',
        ],

        'reset_at' => [
            'nomination_reset' => 'การเสนอชื่อถูกรีเซ็ตเมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
            'disqualify' => 'ถูกตัดสิทธิ์เมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'คุณแน่ใจหรือ? ในการโพสต์ปัญหาใหม่จะรีเซ็ตการเสนอชื่อ',
            'disqualify' => 'คุณแน่ใจใช่หรือไม่? ที่จะลบบีทแมพออกและรีเซ็ตความคืบหน้า',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'พิมพ์คำสำคัญ...',
            'login_required' => 'ลงชื่อเข้าใช้เพื่อค้นหา',
            'options' => 'ตัวเลือกการค้นหาเพิ่มเติม',
            'supporter_filter' => 'กรองโดย :filters ต้องมี osu!supporter tag ทำงานอยู่',
            'not-found' => 'ไม่มีผลการค้นหา',
            'not-found-quote' => '... ไม่อ่ะ ไม่เจออะไรเลย',
            'filters' => [
                'extra' => 'เพิ่มเติม',
                'general' => 'ทั่วไป',
                'genre' => 'ประเภท',
                'language' => 'ภาษา',
                'mode' => 'โหมด',
                'nsfw' => 'เนื้อหาล่อแหลม',
                'played' => 'เคยเล่นแล้ว',
                'rank' => 'แรงค์ที่ได้รับ',
                'status' => 'หมวดหมู่',
            ],
            'sorting' => [
                'title' => 'ชื่อ',
                'artist' => 'ศิลปิน',
                'difficulty' => 'ระดับความยาก',
                'favourites' => 'รายการโปรด',
                'updated' => 'อัปเดตแล้ว',
                'ranked' => 'จัดอันดับแล้ว',
                'rating' => 'เรตติ้ง',
                'plays' => 'จำนวนการเล่น',
                'relevance' => 'ความเกี่ยวข้อง',
                'nominations' => 'การเสนอชื่อ',
            ],
            'supporter_filter_quote' => [
                '_' => 'กรองโดย :filters ต้องมี :link ทำงานอยู่',
                'link_text' => 'แท็กสนับสนุน',
            ],
        ],
    ],
    'general' => [
        'converts' => 'รวมแมพคอนเวิรต์ด้วย',
        'featured_artists' => '',
        'follows' => 'ติดตามผู้ทำแมพ',
        'recommended' => 'ระดับความยากที่แนะนำ',
    ],
    'mode' => [
        'all' => 'ทั้งหมด',
        'any' => 'ไม่เจาะจง',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'ไม่เจาะจง',
        'approved' => 'อนุมัติ',
        'favourites' => 'รายการโปรด',
        'graveyard' => 'สุสาน',
        'leaderboard' => 'สถิติการจัดลำดับ',
        'loved' => 'Loved',
        'mine' => 'แมพของฉัน',
        'pending' => 'รอดำเนินการ & WIP',
        'qualified' => 'Qualified',
        'ranked' => 'จัดอันดับแล้ว',
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
        'metal' => 'เมทัล',
        'classical' => 'คลาสสิก',
        'folk' => 'โฟล์ค',
        'jazz' => 'แจ๊ส',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
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
        'russian' => 'ภาษารัสเซีย',
        'polish' => 'ภาษาโปแลนด์',
        'instrumental' => 'เครื่องดนตรี',
        'other' => 'อื่นๆ',
        'unspecified' => 'ไม่ระบุภาษา',
    ],

    'nsfw' => [
        'exclude' => 'ซ่อน',
        'include' => 'แสดง',
    ],

    'played' => [
        'any' => 'ไม่เจาะจง',
        'played' => 'เคยเล่นแล้ว',
        'unplayed' => 'ยังไม่เคยเล่น',
    ],
    'extra' => [
        'video' => 'มีวิดีโอ',
        'storyboard' => 'มี Storyboard',
    ],
    'rank' => [
        'any' => 'ไม่เจาะจง',
        'XH' => 'Silver SS',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'จำนวนการเล่น: :count',
        'favourites' => 'จำนวนการชื่นชอบ: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'ทั้งหมด',
        ],
    ],
];
