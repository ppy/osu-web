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
            'is_hype' => 'ไม่สามารถยกเลิกการ hype',
            'has_reply' => 'ไม่สามารถลบการสนทนาที่มีข้อความตอบกลับ',
        ],
        'nominate' => [
            'exhausted' => 'คุณถึงขีดจำกัดของการเสนอชื่อแล้วสำหรับวันนี้แล้ว โปรดลองอีกครั้งในวันพรุ่งนี้',
            'incorrect_state' => 'เกิดข้อผิดพลาดในการดำเนินการ ลองรีเฟรชหน้านี้ดู',
            'owner' => "ไม่สามารถเสนอชื่อบีทแมพของตัวเองได้",
        ],
        'resolve' => [
            'not_owner' => 'เฉพาะผู้เริ่มกระทู้ และเจ้าของ Beatmap สามารถทำเครื่องหมายว่าการสนทนาถูกแก้ไขแล้ว',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'เจ้าของบีนแมพหรือ nominator/สมาชิกในกลุ่ม QAT เท่านั้นที่สามารถโพสบันทึกย่อของนักทำบีทแมพได้',
        ],

        'vote' => [
            'limit_exceeded' => 'กรุณารอสักครู่ก่อนโหวตเพิ่ม',
            'owner' => "ไม่สามารถโหวตการสนทนาของตัวเองได้",
            'wrong_beatmapset_state' => 'สามารถโหวตในการสนทนาของ Beatmap ที่อยู่ในสถานะอยู่ระหว่างดำเนินการเท่านั้น',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'โพสต์ที่ถูกสร้างขึ้นเองไม่สามารถถูกแก้ไขได้',
            'not_owner' => 'เฉพาะคนโพสต์เท่านั้นที่สามารถแก้ไขโพสต์',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'การเข้าถึง Channel ที่ร้องขอนั้นไม่ถูกอนุญาติ',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'ต้องการการอนุญาติในการเข้าถึง Channel นี้',
                    'moderated' => 'Channel นี้อยู่ในระหว่างการควบคุม',
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
                'only_last_post' => 'สามารถลบได้แค่โพสต์ล่าสุดเท่านั้น',
                'locked' => 'ไม่สามารถลบโพสต์หัวเรื่องที่ถูกล็อกได้',
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
                'not_owner' => 'เฉพาะคนโพสต์เท่านั้นที่สามารถลบโพสต์',
            ],

            'edit' => [
                'deleted' => 'ไม่สามารถแก้ไขโพสต์ที่ถูกลบ',
                'locked' => 'โพสต์นี้ถูกล็อคจากการแก้ไข',
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
                'not_owner' => 'เฉพาะคนโพสต์เท่านั้นที่สามารถแก้ไขโพสต์',
                'topic_locked' => 'ไม่สามารถแก้ไขโพสต์ในกระทู้ที่ถูกล้อค',
            ],

            'store' => [
                'play_more' => 'โปรดลองเล่นเกมก่อนที่จะโพสต์ในฟอรั่ม หากคุณมีปัญหากับการเล่น กรุณาโพสต์ฟอรั่มความช่วยเหลือและสนับสนุน',
                'too_many_help_posts' => "คุณต้องเล่นเกมเพิ่มก่อนที่คุณสามารถจะโพสต์อีกในฟอรั่ม หากคุณมีปัญหาในการเล่นเกม อีเมล์ support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'กรุณาแก้ไขโพสของคุณล่าสุดแทนที่จะลงรายการบัญชีอีกครั้ง',
                'locked' => 'ไม่สามารถตอบกลับในกระทู้ที่ถูกล้อค',
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
                'no_permission' => 'ไม่ได้รับอนุญาตให้ตอบกลับ',

                'user' => [
                    'require_login' => 'กรุณาเข้าสู่ระบบเพื่อตอบกลับ',
                    'restricted' => "ไม่สามารถตอบกลับได้ในขณะที่ถูกจำกัด",
                    'silenced' => "ไม่สามารถตอบกลับได้ในขณะที่ถูกเงียบ",
                ],
            ],

            'store' => [
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
                'no_permission' => 'ไม่มีสิทธิ์ในการสร้างกระทู้ใหม่',
                'forum_closed' => 'ฟอรั่มถูกปิด และไม่สามารถโพสต์ในนี้ได้',
            ],

            'vote' => [
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
                'over' => 'การโหวตได้จบลงแล้วและไม่สามารถโหวตได้อีก',
                'voted' => 'ไม่อนุญาตืให้เปลี่ยนผลโหวต',

                'user' => [
                    'require_login' => 'กรุณาเข้าสู่ระบบเพื่อทำการโหวต',
                    'restricted' => "ไม่สามารถโหวตได้ในขณะที่ถูกจำกัด",
                    'silenced' => "ไม่สามารถโหลตได้ในขณะที่ถูกเงียบ",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'ต้องการการอนุญาติในการเข้าถึงฟอรั่มนี้',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'หน้าปกที่ระบุไม่ถูกต้อง',
                'not_owner' => 'มีแค่เจ้าของเท่านั้นที่สามารถแก้ไขหน้าปก',
            ],
        ],

        'view' => [
            'admin_only' => 'มีแค่ผู้ดูแลระบบเท่านั้นที่สามารถดูฟอรั่มนี้',
        ],
    ],

    'require_login' => 'กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป',

    'unauthorized' => 'ปฏิเสธการเข้าใช้.',

    'silenced' => "ไม่สามารถทำสิ่งนั้นได้ในขณะที่ถูกเงียบ",

    'restricted' => "ไม่สามารถทำสิ่งนั้นได้ในขณะที่ถูกจำกัด",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Userpage ถูกล้อค',
                'not_owner' => 'สามารถแก้ไขได้แค่ Userpage ของตนเอง',
                'require_supporter_tag' => 'จำเป็นต้องมี Supporter Tag',
            ],
        ],
    ],
];
