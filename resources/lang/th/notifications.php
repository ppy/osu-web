<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'อ่านการแจ้งเตือนทั้งหมดแล้ว!',
    'delete' => 'ลบ :type',
    'loading' => 'กำลังโหลดการแจ้งเตือนที่ยังไม่ได้อ่าน...',
    'mark_read' => 'ล้าง :type',
    'none' => 'ไม่มีการแจ้งเตือนใดๆ',
    'see_all' => 'ดูการแจ้งเตือนทั้งหมด',
    'see_channel' => 'ไปที่แชท',
    'verifying' => 'โปรดยืนยันเซสชันเพื่อดูการแจ้งเตือน',

    'action_type' => [
        '_' => 'ทั้งหมด',
        'beatmapset' => 'บีตแม็ป',
        'build' => 'เวอร์ชั่น',
        'channel' => 'แชท',
        'forum_topic' => 'ฟอรั่ม',
        'news_post' => 'ข่าวสาร',
        'user' => 'โปรไฟล์',
    ],

    'filters' => [
        '_' => 'ทั้งหมด',
        'user' => 'โปรไฟล์',
        'beatmapset' => 'บีตแม็ป',
        'forum_topic' => 'บอร์ดข่าวสาร',
        'news_post' => 'ข่าวสาร',
        'build' => 'เวอร์ชั่น',
        'channel' => 'แชท',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'บีตแม็ป',

            'beatmap_owner_change' => [
                '_' => 'ระดับความยากของแขก',
                'beatmap_owner_change' => 'ตอนนี้คุณเป็นเจ้าของระดับความยาก ":beatmap" สําหรับบีตแม็ป ":title"',
                'beatmap_owner_change_compact' => 'ตอนนี้คุณเป็นเจ้าของระดับความยาก ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'การสนทนาบีตแม็ป',
                'beatmapset_discussion_lock' => 'บีตแม็ป ":title" ได้ถูกปิดการใช้งานการสนทนา',
                'beatmapset_discussion_lock_compact' => 'การสนทนาได้ถูกล็อกไว้',
                'beatmapset_discussion_post_new' => ':username ได้เขียนข้อความใหม่ใน ":title" การสนทนาของ beatmap',
                'beatmapset_discussion_post_new_empty' => 'โพสใหม่ บน :title โดย :username',
                'beatmapset_discussion_post_new_compact' => 'โพสต์ใหม่โดย :username',
                'beatmapset_discussion_post_new_compact_empty' => 'โพสใหม่โดย :username',
                'beatmapset_discussion_review_new' => 'บทวิจารณ์ใหม่บน ":title" โดย :username มีปัญหาอยู่ :problems ปัญหา, คำแนะนำอยู่ :suggestions คำแนะนำ, คำชม :praises คำชม  ',
                'beatmapset_discussion_review_new_compact' => 'บทวิจารณ์โดย :username มีปัญหาอยู่ :problems ปัญหา, คำแนะนำอยู่ :suggestions คำแนะนำ, คำชม :praises คำชม  ',
                'beatmapset_discussion_unlock' => 'บีตแม็ป ":title" ได้ถูกเปิดการใช้งานในการสนทนาแล้ว',
                'beatmapset_discussion_unlock_compact' => 'การสนทนาได้ถูกปลดล๊อค',
            ],

            'beatmapset_problem' => [
                '_' => 'ปัญหาของบีตแม็ปที่ผ่านการรับรอง',
                'beatmapset_discussion_qualified_problem' => 'รายงานโดย :username บน :title :content',
                'beatmapset_discussion_qualified_problem_empty' => 'รายงานโดย :username บน :title ',
                'beatmapset_discussion_qualified_problem_compact' => 'รายงานโดย :username บน :content ',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'รายงานโดย :username',
            ],

            'beatmapset_state' => [
                '_' => 'สถานะของบีตแม็ปถูกเปลี่ยน',
                'beatmapset_disqualify' => '":title" ถูกตัดสิทธิ์',
                'beatmapset_disqualify_compact' => 'บีตแม็ปถูกตัดสิทธิ์',
                'beatmapset_love' => '":title" ได้รับการเลื่อนระดับเป็นชื่นชอบ',
                'beatmapset_love_compact' => 'บีตแม็ปได้รับการเลื่อนตำแหน่งเป็นรักเลย',
                'beatmapset_nominate' => '":title" ได้รับการเสนอชื่อ',
                'beatmapset_nominate_compact' => 'บีตแม็ปได้รับการเสนอชื่อเข้าชิง',
                'beatmapset_qualify' => '":title" ได้รับการเสนอชื่อเพียงพอที่จะเข้าคิวจัดอันดับ',
                'beatmapset_qualify_compact' => 'บีตแม็ปเข้าสู่คิวการจัดอันดับ',
                'beatmapset_rank' => '":title" ได้รับการจัดอันดับ',
                'beatmapset_rank_compact' => 'บีตแม็ปได้รับการจัดอันดับ',
                'beatmapset_remove_from_loved' => '":title" ได้ถูกนำออกจากรักเลย',
                'beatmapset_remove_from_loved_compact' => 'บีตแม็ปได้ถูกนำออกจากชื่นชอบ',
                'beatmapset_reset_nominations' => 'การเสนอชื่อ ":title" ถูกรีเซ็ต',
                'beatmapset_reset_nominations_compact' => 'การเสนอชื่อถูกรีเซ็ท',
            ],

            'comment' => [
                '_' => 'ความคิดเห็นใหม่',

                'comment_new' => ':username ได้แสดงความคิดเห็น ":content" บน ":title"',
                'comment_new_compact' => ':username ได้แสดงความคิดเห็น ":content"',
                'comment_reply' => ':username ได้ตอบกลับ ":content" บน ":title"',
                'comment_reply_compact' => ':username ได้ตอบกลับ ":content"',
            ],
        ],

        'channel' => [
            '_' => 'ห้องสนทนา',

            'announcement' => [
                '_' => 'ประกาศใหม่',

                'announce' => [
                    'channel_announcement' => ':username พูดถึง ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'ประกาศจาก :username',
                ],
            ],

            'channel' => [
                '_' => 'ข้อความใหม่',

                'pm' => [
                    'channel_message' => ':username พูดถึง ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'จาก :username',
                ],
            ],
        ],

        'build' => [
            '_' => 'บันทึกการเปลี่ยนแปลง',

            'comment' => [
                '_' => 'ความคิดเห็นใหม่',

                'comment_new' => ':username ได้แสดงความคิดเห็น ":content" บน ":title"',
                'comment_new_compact' => ':username ได้แสดงความคิดเห็น ":content"',
                'comment_reply' => ':username ได้ตอบกลับ ":content" บน ":title"',
                'comment_reply_compact' => ':username ได้ตอบกลับ ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'ข่าวสาร',

            'comment' => [
                '_' => 'ความคิดเห็นใหม่',

                'comment_new' => ':username ได้แสดงความคิดเห็น ":content" บน ":title"',
                'comment_new_compact' => ':username ได้แสดงความคิดเห็น ":content"',
                'comment_reply' => ':username ได้ตอบกลับ ":content" บน ":title"',
                'comment_reply_compact' => ':username ได้ตอบกลับ ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'หัวข้อในฟอรัม',

            'forum_topic_reply' => [
                '_' => 'ตอบกลับในฟอรั่มใหม่',
                'forum_topic_reply' => ':username ได้ตอบกลับในฟอรั่ม ":title"',
                'forum_topic_reply_compact' => ':username ตอบกลับ',
            ],
        ],

        'legacy_pm' => [
            '_' => 'ฟอรั่ม PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited ข้อความที่ยังไม่ได้อ่าน |:count_delimited ข้อความทั้งหมดที่ยังไม่ได้อ่าน',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'บีตแม็ปใหม่',

                'user_beatmapset_new' => 'บีตแม็ปใหม่ ":title" โดย :username',
                'user_beatmapset_new_compact' => 'บีตแม็ปใหม่ ":title"',
                'user_beatmapset_new_group' => 'บีตแม็ปใหม่โดย :username',

                'user_beatmapset_revive' => 'บีตแม็ป ":title" ถูกกู้คืนแล้วโดย :username',
                'user_beatmapset_revive_compact' => 'บีตแม็ป ":title" ถูกกู้คืนแล้ว',
            ],
        ],

        'user_achievement' => [
            '_' => 'เหรียญตรา',

            'user_achievement_unlock' => [
                '_' => 'เหรียญตราใหม่',
                'user_achievement_unlock' => 'ปลดล๊อค ":title"!',
                'user_achievement_unlock_compact' => 'ปลดล๊อค ":title"!',
                'user_achievement_unlock_group' => 'ปลดล็อกเหรียญตรา',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'ตอนนี้คุณเป็นแขกของบีตแม็ป ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'การพูดคุยใน ":title:" ได้ถูกล็อก',
                'beatmapset_discussion_post_new' => 'การพูดคุยใน ":title:" มีอัปเดตใหม่',
                'beatmapset_discussion_unlock' => 'การพูดคุยใน ":title:" ได้ถูกปลดล็อก',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'ปัญหาใหม่ได้ถูกแจ้งใน ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" ได้ถูกยกเลิกสถานะผ่านการรับรอง',
                'beatmapset_love' => '":title" ได้ถูกเปลี่ยนเป็นชื่นชอบ',
                'beatmapset_nominate' => '":title" ได้ถูกเสนอชื่อ',
                'beatmapset_qualify' => '":title" ได้รับการเสนอชื่อเพียงพอที่จะเข้าคิวจัดอันดับ',
                'beatmapset_rank' => '":title" ได้ถูกจัดอันดับแล้ว',
                'beatmapset_remove_from_loved' => '":title" ได้ถูกนำออกจากชื่นชอบ',
                'beatmapset_reset_nominations' => 'การเสนอชื่อของ ":title" ได้ถูกรีเซ็ทแล้ว',
            ],

            'comment' => [
                'comment_new' => 'บีตแม็ป ":title" มีความคิดเห็นใหม่',
            ],
        ],

        'channel' => [
            'announcement' => [
                'announce' => 'มีประกาศใหม่ใน ":name"',
            ],

            'channel' => [
                'pm' => 'คุณได้รับข้อความจาก :username',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'บันทึกการเปลี่ยนแปลง ":title" มีความคิดเห็นใหม่',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'ข่าว ":title" มีความคิดเห็นใหม่',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'มีการตอบกลับใหม่ใน ":title"',
            ],
        ],

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username ได้ปลดล็อกเหรียญตรา ":title"!',
                'user_achievement_unlock_self' => 'คุณได้ปลดล็อกเหรียญตรา ":title"!',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username ได้สร้างบีตแม็ปใหม่',
                'user_beatmapset_revive' => ':username ได้กู้คืนบีตแม็ปแล้ว',
            ],
        ],
    ],
];
