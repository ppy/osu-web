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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'ไม่สามารถยกเลิก hype',
            'has_reply' => 'ไม่สามารถลบการสนทนาที่มีข้อความตอบกลับ',
        ],
        'nominate' => [
            'exhausted' => 'คุณถึงขีดจำกัดของการ nomination สำหรับวันนี้ โปรดลองอีกครั้งพรุ่งนี้',
        ],
        'resolve' => [
            'not_owner' => 'เฉพาะผู้เริ่ม thread และเจ้าของ beatmap สามารถ resolve การสนทนา',
        ],

        'vote' => [
            'limit_exceeded' => 'กรุณารอสักครู่ก่อนโหวตเพิ่ม',
            'owner' => "Can not vote own discussion!",
            'wrong_beatmapset_state' => 'สามารถโหวตในการสนทนาของ beatmaps ที่อยู่ในสถานะ pending เท่านั้น',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatically generated post can not be edited.',
            'not_owner' => 'Only the poster can edit post.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Access to requested channel is not permitted.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Access to target channel is required.',
                    'moderated' => 'Channel is currently moderated.',
                    'not_lazer' => 'คุณสามารถพูดแค่ใน #lazer ในขณะนี้',
                ],

                'not_allowed' => 'ไม่สามารถส่งข้อความขณะถูกแบน/จำกัด/เงียบ',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'คุณไม่สามารถเปลี่ยนการโหวตหลังจากระยะเวลาลงคะแนนเสียงสำหรับการประกวดนี้ได้สิ้นสุดลง',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Only last post can be deleted.',
                'locked' => 'Can not delete post of a locked topic.',
                'no_forum_access' => 'Access to requested forum is required.',
                'not_owner' => 'Only poster can delete the post.',
            ],

            'edit' => [
                'deleted' => 'Can not edit deleted post.',
                'locked' => 'The post is locked from editing.',
                'no_forum_access' => 'Access to requested forum is required.',
                'not_owner' => 'Only poster can edit the post.',
                'topic_locked' => 'Can not edit post of a locked topic.',
            ],

            'store' => [
                'play_more' => 'โปรดลองเล่นเกมก่อนที่จะโพสต์ในฟอรั่ม หากคุณมีปัญหากับการเล่น กรุณาโพสต์ฟอรั่มความช่วยเหลือและสนับสนุน',
                'too_many_help_posts' => "คุณต้องเล่นเกมเพิ่มก่อนที่คุณสามารถจะโพสต์อีกในฟอรั่ม หากคุณมีปัญหาในการเล่นเกม อีเมล์ support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'You just posted. Wait a bit or edit your last post.',
                'locked' => 'Can not reply to a locked thread.',
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to reply.',

                'user' => [
                    'require_login' => 'Please login to reply.',
                    'restricted' => "Can't reply while restricted.",
                    'silenced' => "Can't reply while silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to create new topic.',
                'forum_closed' => 'Forum is closed and can not be posted to.',
            ],

            'vote' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'over' => 'Polling is over and can not be voted on anymore.',
                'voted' => 'Changing vote is not allowed.',

                'user' => [
                    'require_login' => 'Please login to vote.',
                    'restricted' => "Can't vote while restricted.",
                    'silenced' => "Can't vote while silenced.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Access to requested forum is required.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Invalid cover specified.',
                'not_owner' => 'Only owner can edit cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'Only admin can view this forum.',
        ],
    ],

    'require_login' => 'Please login to proceed.',

    'unauthorized' => 'Access denied.',

    'silenced' => "Can't do that while silenced.",

    'restricted' => "Can't do that while restricted.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'User page is locked.',
                'not_owner' => 'Can only edit own user page.',
                'require_supporter_tag' => 'Supporter tag is required.',
            ],
        ],
    ],
];
