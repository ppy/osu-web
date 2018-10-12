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
    'pinned_topics' => 'หัวข้อที่ปักหมุดไว้',
    'slogan' => "เล่นคนเดียวมันอันตราย",
    'subforums' => 'ฟอรั่มย่อย',
    'title' => '',

    'covers' => [
        'create' => [
            '_' => 'ตั้งภาพหน้าปก',
            'button' => 'อัพโหลดรูปภาพ',
            'info' => 'ภาพหน้าปกควรมีขนาด :dimensions. คุณยังสามารถลากวางรูปที่นี่ได้เพื่ออัพโหลด',
        ],

        'destroy' => [
            '_' => 'นำภาพหน้าปกออก',
            'confirm' => 'คุณแน่ใจหรือไม่ว่าจะนำภาพหน้าปกออก',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] มีการตอบกลับใหม่ใน ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'ไม่มีหัวข้อ',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'ลบโพสต์จริงๆ หรือ',
        'confirm_restore' => 'Really restore post?',
        'edited' => 'Last edited by :user on :when, edited :count times in total.',
        'posted_at' => 'posted :when',

        'actions' => [
            'destroy' => 'Delete post',
            'restore' => 'Restore post',
            'edit' => 'Edit post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Go to post',
        'post_number_input' => 'enter post number',
        'total_posts' => ':posts_count posts total',
    ],

    'topic' => [
        'deleted' => 'หัวข้อที่ถูกลบ',
        'go_to_latest' => 'view latest post',
        'latest_post' => ':when by :user',
        'latest_reply_by' => 'latest reply by :user',
        'new_topic' => 'Post new topic',
        'new_topic_login' => 'เข้าสู่ระบบเพื่อโพสต์หัวเรื่องใหม่',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'พิมพ์ที่นี่เพื่อตอบกลับ',
        'reply_title_prefix' => '',
        'started_by' => 'โดย :user',
        'started_by_verbose' => '',

        'create' => [
            'preview' => 'Preview',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'เขียน',
            'submit' => 'โพสต์',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
                ],
            ],

            'placeholder' => [
                'body' => 'พิมพ์เนื้อหาโพสต์ที่นี่',
                'title' => 'คลิกที่นี่เพื่อตั้งหัวข้อ',
            ],
        ],

        'jump' => [
            'enter' => 'click to enter specific post number',
            'first' => 'ไปที่โพสต์แรก',
            'last' => 'ไปที่โพสต์ล่าสุด',
            'next' => 'skip next 10 posts',
            'previous' => 'go back 10 posts',
        ],

        'post_edit' => [
            'cancel' => 'ยกเลิก',
            'post' => 'บันทึก',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Topic Subscriptions',
            'title_compact' => 'subscriptions',
            'title_main' => 'Topic <strong>Subscriptions</strong>',

            'box' => [
                'total' => 'Topics subscribed',
                'unread' => 'Topics with new replies',
            ],

            'info' => [
                'total' => 'You subscribed to :total topics.',
                'unread' => 'You have :unread unread replies to subscribed topics.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Unsubscribe from topic?',
                'title' => 'Unsubscribe',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Topics',

        'actions' => [
            'login_reply' => '',
            'reply' => 'Show reply box',
            'reply_with_quote' => 'Quote post for reply',
            'search' => 'Search',
        ],

        'create' => [
            'create_poll' => 'Poll Creation',

            'create_poll_button' => [
                'add' => 'Create a poll',
                'remove' => 'Cancel creating a poll',
            ],

            'poll' => [
                'length' => 'Run poll for',
                'length_days_suffix' => 'days',
                'length_info' => 'Leave blank for a never ending poll',
                'max_options' => 'Options per user',
                'max_options_info' => 'This is the number of options each user may select when voting.',
                'options' => 'Options',
                'options_info' => 'Place each options on a new line. You may enter up to 10 options.',
                'title' => 'Question',
                'vote_change' => 'Allow re-voting.',
                'vote_change_info' => 'If enabled, users are able to change their vote.',
            ],
        ],

        'edit_title' => [
            'start' => 'Edit title',
        ],

        'index' => [
            'views' => 'views',
            'replies' => 'replies',
        ],

        'issue_tag_added' => [
            'to_0' => 'ลบ"แท็ก"ที่เพิ่ม',
            'to_0_done' => 'ลบแท็ก "เพิ่มแล้ว" แล้ว',
            'to_1' => 'เพิ่มแท็ก',
            'to_1_done' => 'เพิ่มแท็ก "เพิ่มแล้ว" แล้ว',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'ลบแท็ก "กำหนดแล้ว"',
            'to_0_done' => 'ลบแท็ก "กำหนดแล้ว" แล้ว',
            'to_1' => 'เพิ่มแท็ก "กำหนดแล้ว"',
            'to_1_done' => 'เพิ่มแท็ก "กำหนดแล้ว" แล้ว',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'ลบแท็ก "ยืนยันแล้ว"',
            'to_0_done' => 'ลบแท็ก "ยืนยันแล้ว" แล้ว',
            'to_1' => 'เพิ่มแท็ก "ยืนยันแล้ว"',
            'to_1_done' => 'เพิ่มแท็ก "ยืนยันแล้ว" แล้ว',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'ลบแท็ก "ซ้ำ"',
            'to_0_done' => 'ลบแท็ก "ซ้ำ" แล้ว',
            'to_1' => 'เพิ่มแท็ก "ซ้ำ"',
            'to_1_done' => 'เพิ่มแท็ก "ซ้ำ" แล้ว',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'ลบแท็ก "โมฆะ"',
            'to_0_done' => 'ลบแท็ก "โมฆะ" แล้ว',
            'to_1' => 'เพิ่มแท็ก "โมฆะ"',
            'to_1_done' => 'เพิ่มแท็ก "โมฆะ" แล้ว',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'ลบแท็ก "แก้แล้ว"',
            'to_0_done' => 'ลบแท็ก "แก้แล้ว" แล้ว',
            'to_1' => 'เพิ่มแท็ก "แก้แล้ว"',
            'to_1_done' => 'เพิ่มแท็ก "แก้แล้ว" แล้ว',
        ],

        'lock' => [
            'is_locked' => 'This topic is locked and can not be replied to',
            'to_0' => 'ปลดล็อกหัวข้อ',
            'to_0_done' => 'หัวข้อถูกปลดล็อกแล้ว',
            'to_1' => 'ล็อกหัวข้อ',
            'to_1_done' => 'หัวข้อถูกล็อกแล้ว',
        ],

        'moderate_move' => [
            'title' => 'Move to another forum',
        ],

        'moderate_pin' => [
            'to_0' => 'เลิกปักหมุดหัวข้อ',
            'to_0_done' => 'หัวข้อถูกเลิกปักหมุดแล้ว',
            'to_1' => 'ปักหมุดหัวข้อ',
            'to_1_done' => 'หัวข้อถูกปักหมุดแล้ว',
            'to_2' => 'ปักหมุดหัวข้อและตั้งให้เป็นประกาศ',
            'to_2_done' => 'หัวข้อถูกปักหมุดและตั้งให้เป็นประกาศแล้ว',
        ],

        'show' => [
            'deleted-posts' => 'Deleted Posts',
            'total_posts' => 'Total Posts',

            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',

                'user' => [
                    'count' => '{0} no vote|{1} :count vote|[2,*] :count votes',
                    'current' => 'You have :votes remaining.',
                    'not_enough' => "You don't have any more votes remaining",
                ],
            ],

            'poll' => [
                'vote' => 'Vote',

                'detail' => [
                    'end_time' => 'Polling will end at :time',
                    'ended' => 'Polling ended :time',
                    'total' => 'Total votes: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'ไม่ได้บุ๊กมาร์คไว้',
            'to_watching' => 'บุ๊กมาร์ค',
            'to_watching_mail' => 'บุ๊กมาร์คและรับการแจ้งเตือน',
            'mail_disable' => 'ปิดการแจ้งเตือน',
        ],
    ],
];
