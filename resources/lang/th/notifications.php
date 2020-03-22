<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'all_read' => 'อ่านการแจ้งเตือนทั้งหมดแล้ว!',
    'mark_all_read' => 'ลบทั้ง​หมด',
    'none' => '',
    'see_all' => '',

    'filters' => [
        '_' => '',
        'user' => '',
        'beatmapset' => '',
        'forum_topic' => '',
        'news_post' => '',
        'build' => '',
        'channel' => '',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'พูดคุยบีตแมป',
                'beatmapset_discussion_lock' => 'Beatmap ":title" ได้ถูกปิดการใช้งานการสนทนา',
                'beatmapset_discussion_lock_compact' => 'การสนทนาได้ถูกล็อกไว้',
                'beatmapset_discussion_post_new' => ':username ได้เขียนข้อความใหม่ใน ":title" การสนทนาของ beatmap',
                'beatmapset_discussion_post_new_empty' => '',
                'beatmapset_discussion_post_new_compact' => 'โพสต์ใหม่โดย :username',
                'beatmapset_discussion_post_new_compact_empty' => '',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" ได้ถูกเปิดการใช้งานในการสนทนาแล้ว',
                'beatmapset_discussion_unlock_compact' => 'การสนทนาได้ถูกปลดล๊อค',
            ],

            'beatmapset_problem' => [
                '_' => '',
                'beatmapset_discussion_qualified_problem' => '',
                'beatmapset_discussion_qualified_problem_empty' => '',
                'beatmapset_discussion_qualified_problem_compact' => '',
                'beatmapset_discussion_qualified_problem_compact_empty' => '',
            ],

            'beatmapset_state' => [
                '_' => 'สถานะของบีตแมปถูกเปลี่ยน',
                'beatmapset_disqualify' => 'Beatmap ":title" ได้ถูกตัดสิทธิ์โดย :username',
                'beatmapset_disqualify_compact' => 'Beatmap ถูกตัดสิทธ์',
                'beatmapset_love' => 'Beatmap ":title" ได้ถูกเลื่อนขั้นให้เป็นที่ชื่นชอบโดย :username',
                'beatmapset_love_compact' => 'Beatmap โปรโมทเป็น Loved',
                'beatmapset_nominate' => 'Beatmap ":title" ได้ถูกเสนอชื่อโดย :username',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => 'Beatmap ":title" ได้มีการเสนอชื่อมากเพียงพอที่จะขึ้นการจัดอันดับแล้ว',
                'beatmapset_qualify_compact' => 'Beatmap ได้ถูกเข้าคิวมาจัดอันดับ',
                'beatmapset_rank' => '":title" ได้ถูกแรงค์แล้ว',
                'beatmapset_rank_compact' => 'Beatmap ได้รับการจัดอันดับ',
                'beatmapset_reset_nominations' => 'ปัญหานี้โพสต์โดย :username รีเซ็ทการเสนอชื่อของ beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => 'ความคิดเห็นใหม่',

                'comment_new' => ':username ได้แสดงความคิดเห็น ":content" บน ":title"',
                'comment_new_compact' => ':username ได้แสดงความคิดเห็น ":content"',
            ],
        ],

        'channel' => [
            '_' => 'ห้องสนทนา',

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
            ],
        ],

        'news_post' => [
            '_' => 'ข่าวสาร',

            'comment' => [
                '_' => 'ความคิดเห็นใหม่',

                'comment_new' => ':username ได้แสดงความคิดเห็น ":content" บน ":title"',
                'comment_new_compact' => ':username ได้แสดงความคิดเห็น ":content"',
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

        'user_achievement' => [
            '_' => 'เหรียญตรา',

            'user_achievement_unlock' => [
                '_' => 'เหรียญตราใหม่',
                'user_achievement_unlock' => 'ปลดล๊อค ":title"!',
                'user_achievement_unlock_compact' => '',
            ],
        ],
    ],
];
