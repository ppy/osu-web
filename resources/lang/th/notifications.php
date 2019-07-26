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

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'การสนทนาเกี่ยวกับ Beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" ได้ถูกปิดการใช้งานการสนทนา',
                'beatmapset_discussion_lock_compact' => '',
                'beatmapset_discussion_post_new' => ':username ได้เขียนข้อความใหม่ใน ":title" การสนทนาของ beatmap',
                'beatmapset_discussion_post_new_compact' => '',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" ได้ถูกเปิดการใช้งานในการสนทนาแล้ว',
                'beatmapset_discussion_unlock_compact' => '',
            ],

            'beatmapset_state' => [
                '_' => 'สถานะของ beatmap ถูกเปลี่ยน',
                'beatmapset_disqualify' => 'Beatmap ":title" ได้ถูกตัดสิทธิ์โดย :username',
                'beatmapset_disqualify_compact' => '',
                'beatmapset_love' => 'Beatmap ":title" ได้ถูกเลื่อนขั้นให้เป็นที่ชื่นชอบโดย :username',
                'beatmapset_love_compact' => '',
                'beatmapset_nominate' => 'Beatmap ":title" ได้ถูกเสนอชื่อโดย :username',
                'beatmapset_nominate_compact' => '',
                'beatmapset_qualify' => 'Beatmap ":title" ได้มีการเสนอชื่อมากเพียงพอที่จะขึ้นการจัดอันดับแล้ว',
                'beatmapset_qualify_compact' => '',
                'beatmapset_rank' => '',
                'beatmapset_rank_compact' => '',
                'beatmapset_reset_nominations' => 'ปัญหานี้โพสต์โดย :username รีเซ็ทการเสนอชื่อของ beatmap ":title" ',
                'beatmapset_reset_nominations_compact' => '',
            ],

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'channel' => [
            '_' => '',

            'channel' => [
                '_' => '',
                'pm' => [
                    'channel_message' => '',
                    'channel_message_compact' => '',
                    'channel_message_group' => '',
                ],
            ],
        ],

        'build' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'news_post' => [
            '_' => '',

            'comment' => [
                '_' => '',

                'comment_new' => '',
                'comment_new_compact' => '',
            ],
        ],

        'forum_topic' => [
            '_' => 'หัวข้อในฟอรัม',

            'forum_topic_reply' => [
                '_' => 'ตอบกลับในฟอรั่มใหม่',
                'forum_topic_reply' => ':username ได้ตอบกลับในฟอรั่ม ":title"',
                'forum_topic_reply_compact' => '',
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
            '_' => '',

            'user_achievement_unlock' => [
                '_' => '',
                'user_achievement_unlock' => '',
            ],
        ],
    ],
];
