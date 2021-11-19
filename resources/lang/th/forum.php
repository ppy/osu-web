<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'หัวข้อที่ปักหมุดไว้',
    'slogan' => "มันอันตรายที่จะเล่นคนเดียว",
    'subforums' => 'ฟอรั่มย่อย',
    'title' => 'ฟอรั่ม osu!',

    'covers' => [
        'edit' => 'แก้ไขหน้าปก',

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

    'forums' => [
        'latest_post' => 'โพสต์ล่าสุด',

        'index' => [
            'title' => 'หน้าแรกของบอร์ด',
        ],

        'topics' => [
            'empty' => 'ไม่มีหัวข้อ',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'ทำเครื่องหมายว่าอ่านทั้งหมดแล้ว',
        'forums' => 'ทำเครื่องหมายว่าอ่านทั้งหมดแล้ว',
        'busy' => 'กําลังทำเครื่องหมายว่าอ่านแล้ว...',
    ],

    'post' => [
        'confirm_destroy' => 'ต้องการลบโพสต์จริงหรอ?',
        'confirm_restore' => 'ต้องการกู้คืนโพสต์จริงหรอ?',
        'edited' => 'แก้ไขล่าสุดโดย :user :when ถูกแก้ไขทั้งหมด :count ครั้ง',
        'posted_at' => 'โพสต์เมื่อ :when',
        'posted_by' => 'โพสต์โดย :username',

        'actions' => [
            'destroy' => 'ลบโพสต์',
            'edit' => 'แก้ไขโพสต์',
            'report' => 'รายงานโพสต์',
            'restore' => 'กู้คืนโพสต์',
        ],

        'create' => [
            'title' => [
                'reply' => 'ตอบกลับ',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited โพสต์|:count_delimited โพสต์',
            'topic_starter' => 'ผู้เริ่มกระทู้',
        ],
    ],

    'search' => [
        'go_to_post' => 'ไปยังโพสต์',
        'post_number_input' => 'ป้อนหมายเลขของโพสต์',
        'total_posts' => ':posts_count จำนวนโพสต์ทั้งหมด',
    ],

    'topic' => [
        'confirm_destroy' => 'ต้องการลบโพสต์จริงหรอ?',
        'confirm_restore' => 'ต้องการกู้คืนโพสต์จริงหรอ?',
        'deleted' => 'ลบกระทู้',
        'go_to_latest' => 'ดูโพสต์ล่าสุด',
        'has_replied' => 'คุณได้ตอบกลับการสนทนานี้',
        'in_forum' => 'ใน :forum',
        'latest_post' => ':when โดย :user',
        'latest_reply_by' => 'ตอบกลับล่าสุดโดย :user',
        'new_topic' => 'สร้างกระทู้ใหม่',
        'new_topic_login' => 'เข้าสู่ระบบเพื่อตั้งกระทู้ใหม่',
        'post_reply' => 'โพสต์',
        'reply_box_placeholder' => 'พิมพ์ที่นี่เพื่อตอบกลับ',
        'reply_title_prefix' => 'รี',
        'started_by' => 'โดย :user',
        'started_by_verbose' => 'เริ่มโดย :user',

        'actions' => [
            'destroy' => 'ลบหัวข้อ',
            'restore' => 'กู้คือหัวข้อ',
        ],

        'create' => [
            'close' => 'ปิด',
            'preview' => 'Preview',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'เขียน',
            'submit' => 'โพสต์',

            'necropost' => [
                'default' => 'กระทู้นี้ไม่ได้ถูกใช้งานมาระยะหนึ่ง ให้โพสต์ลงที่นี่หากคุณมีเหตุจำเป็นจริงๆ',

                'new_topic' => [
                    '_' => "กระทู้นี้ไม่ได้ถูกใช้งานมาระยะหนึ่ง ให้โพสต์ลงที่นี่หากคุณมีเหตุจำเป็นจริงๆ กรุณา :create แทน",
                    'create' => 'สร้างกระทู้ใหม่',
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

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'ยกเลิก',
            'post' => 'บันทึก',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'กระทู้ที่ติดตาม',

            'box' => [
                'total' => 'ติดตามกระทู้แล้ว',
                'unread' => 'กระทู้ที่มีการตอบกลับใหม่',
            ],

            'info' => [
                'total' => 'การติดตามของคุณ :total topics.',
                'unread' => 'คุณมี :unread การตอบกลับที่ยังไม่ได้อ่านในกระทู้ที่ติดตาม',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'ยกเลิกการติดตามกระทู้นี้',
                'title' => 'ยกเลิกการติดตาม',
            ],
        ],
    ],

    'topics' => [
        '_' => 'หัวข้อ',

        'actions' => [
            'login_reply' => 'เข้าสู่ระบบเพื่อตอบกลับ',
            'reply' => 'แสดงหน้าต่างตอบกลับ',
            'reply_with_quote' => 'Quote post for reply',
            'search' => 'ค้นหา',
        ],

        'create' => [
            'create_poll' => 'Poll Creation',

            'preview' => 'ตัวอย่างโพสต์',

            'create_poll_button' => [
                'add' => 'Create a poll',
                'remove' => 'Cancel creating a poll',
            ],

            'poll' => [
                'hide_results' => 'ซ่อนผลลัพท์ของโพลล์',
                'hide_results_info' => 'จะแสดงหลังจากโพลล์สิ้นสุดเท่านั้น',
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
            'feature_votes' => 'ลำดับความสำคัญ',
            'replies' => 'replies',
            'views' => 'views',
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
            'to_0_confirm' => 'จะปลดล็อกกระทู้หรือไม่',
            'to_0_done' => 'หัวข้อถูกปลดล็อกแล้ว',
            'to_1' => 'ล็อกหัวข้อ',
            'to_1_confirm' => 'จะล็อกกระทู้หรือไม่',
            'to_1_done' => 'หัวข้อถูกล็อกแล้ว',
        ],

        'moderate_move' => [
            'title' => 'Move to another forum',
        ],

        'moderate_pin' => [
            'to_0' => 'เลิกปักหมุดหัวข้อ',
            'to_0_confirm' => 'จะเลิกปักหมุดหัวข้อหรือไม่',
            'to_0_done' => 'หัวข้อถูกเลิกปักหมุดแล้ว',
            'to_1' => 'ปักหมุดหัวข้อ',
            'to_1_confirm' => 'จะปักหมุดหัวข้อหรือไม่',
            'to_1_done' => 'หัวข้อถูกปักหมุดแล้ว',
            'to_2' => 'ปักหมุดหัวข้อและตั้งให้เป็นประกาศ',
            'to_2_confirm' => 'จะปักหมุดและให้กระทู้นี้เป็นการประกาศหรือไม่',
            'to_2_done' => 'หัวข้อถูกปักหมุดและตั้งให้เป็นประกาศแล้ว',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'แสดงโพสต์ที่ถูกลบ',
            'hide' => 'ซ่อนโพสต์ที่ถูกลบ',
        ],

        'show' => [
            'deleted-posts' => 'Deleted Posts',
            'total_posts' => 'Total Posts',

            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',

                'info' => [
                    '_' => 'นี่คือ :feature_request คำขอคุณสมบัติสามารถลงคะแนนได้โดย :supporters',
                    'feature_request' => 'ร้องข้อคุณสมบัติ',
                    'supporters' => 'ผู้สนับสนุน',
                ],

                'user' => [
                    'count' => '{0} no vote|{1} :count vote|[2,*] :count votes',
                    'current' => 'You have :votes remaining.',
                    'not_enough' => "You don't have any more votes remaining",
                ],
            ],

            'poll' => [
                'edit' => 'แก้ไขโพลล์',
                'edit_warning' => 'ถ้าแก้ไขโพลล์แล้วผลโหวตจะหายนะ',
                'vote' => 'Vote',

                'button' => [
                    'change_vote' => 'เปลี่ยนตัวเลือกโหวต',
                    'edit' => 'แก้ไขโพลล์',
                    'view_results' => 'ไปดูผลโหวต',
                    'vote' => 'โหวต',
                ],

                'detail' => [
                    'end_time' => 'Polling will end at :time',
                    'ended' => 'Polling ended :time',
                    'results_hidden' => 'ผลลัพท์จะถูกแสดงหลังจากโพลล์สิ้นสุดลง',
                    'total' => 'Total votes: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'ไม่ได้บุ๊กมาร์คไว้',
            'to_watching' => 'บุ๊กมาร์ค',
            'to_watching_mail' => 'บุ๊กมาร์คและรับการแจ้งเตือน',
            'tooltip_mail_disable' => 'การแจ้งเตือนถูกเปิดใช้งาน คลิกเพื่อปิดการใช้งาน',
            'tooltip_mail_enable' => 'การแจ้งเตือนถูกปิดใช้งาน คลิกเพื่อเปิดการใช้งาน',
        ],
    ],
];
