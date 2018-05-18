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
            'error' => 'Failed updating vote',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'allow kudosu',
        'delete' => 'ลบ',
        'deleted' => 'ลบโดย :editor ณ เวลา :delete_time',
        'deny_kudosu' => 'ปฏิเสธ kudosu',
        'edit' => 'แก้ไข',
        'edited' => 'แก้ไขล่าสุด โดย :editor ณ เวลา :update_time',
        'kudosu_denied' => '',
        'message_placeholder' => 'พิมพ์ที่นี่เพื่อโพสต์',
        'message_placeholder_deleted_beatmap' => '',
        'message_type_select' => 'Select Comment Type',
        'reply_notice' => 'Press enter to submit.',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'กรุณาเข้าสู่ระบบเพื่อโพสต์หรือตอบกลับ',
        'resolved' => 'แก้ไขแล้ว',
        'restore' => 'restore',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Collapse all',
            'all-expand' => 'Expand all',
        ],

        'empty' => [
            'empty' => 'No discussions yet!',
            'hidden' => 'No discussion matches selected filter.',
        ],

        'message_hint' => [
            'in_general' => 'This post will go to general beatmapset discussion. To mod this beatmap, start message with timestamp (e.g. 00:12:345).',
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => 'Praise',
            'problem' => 'Problem',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'ระดับความยากนี้',
                'generalAll' => 'ระดับความยากทั้งหมด',
            ],
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'New Discussion',
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'sort' => [
            '_' => 'เรียงตาม:',
            'created_at' => 'เวลาที่สร้าง',
            'timeline' => '',
            'updated_at' => 'อัพเดทล่าสุด',
        ],

        'stats' => [
            'deleted' => 'Deleted',
            'mapper_notes' => '',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => 'All',
        ],

        'status-messages' => [
            'approved' => '',
            'graveyard' => "",
            'loved' => '',
            'ranked' => '',
            'wip' => '',
        ],

    ],

    'hype' => [
        'button' => '',
        'button_done' => '',
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => '',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '',
        'nominate' => 'Nominate',
        'nominate_confirm' => '',
        'nominated_by' => 'เสนอชื่อโดย :users',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified_soon' => 'คาดการณ์ว่าจะได้ Ranked ในเร็วๆนี้ ถ้าไม่พบปัญหา',
        'required_text' => 'การเสนอชื่อ: :current/:required',
        'reset_message_deleted' => 'ถูกลบไปแล้ว',
        'title' => 'Nomination Status',
        'unresolved_issues' => 'ยังมีปัญหาที่ต้องแก้ไขให้เสร็จก่อน',

        'reset_at' => [
            'nomination_reset' => 'การเสนอชื่อถูกรีเซ็ตเมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
            'disqualify' => 'ถูกตัดสิทธิ์เมื่อ :time_ago โดยผู้ใช้ :user ที่มีปัญหาใหม่ :discussion (:message)',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'ในการโพสต์ปัญหาใหม่จะต้องรีเซ็ตการเสนอชื่อจัดอันดับคะแนน คุณแน่ใจหรือ?',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'options' => 'More Search Options',
            'not-found' => 'no results',
            'not-found-quote' => '... nope, nothing found.',
            'filters' => [
                'general' => 'ทั่วไป',
                'mode' => 'Mode',
                'status' => 'Rank Status',
                'genre' => 'Genre',
                'language' => 'Language',
                'extra' => 'extra',
                'rank' => 'Rank Achieved',
                'played' => 'เคยเล่นแล้ว',
            ],
        ],
        'mode' => 'Mode',
        'status' => 'Rank Status',
        'mapped-by' => 'mapped by :mapper',
        'source' => 'from :source',
        'load-more' => 'Load more...',
    ],
    'general' => [
        'recommended' => 'ระดับความยากที่แนะนำ',
        'converts' => 'รวมแมพคอนเวิรต์ด้วย',
    ],
    'mode' => [
        'any' => 'Any',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Any',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'qualified' => 'ผ่านเกณฑ์',
        'loved' => 'Loved',
        'faves' => 'Favourites',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => 'My Maps',
    ],
    'genre' => [
        'any' => 'Any',
        'unspecified' => 'Unspecified',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Other',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
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
        'english' => 'English',
        'chinese' => 'Chinese',
        'french' => 'French',
        'german' => 'German',
        'italian' => 'Italian',
        'japanese' => 'Japanese',
        'korean' => 'Korean',
        'spanish' => 'Spanish',
        'swedish' => 'Swedish',
        'instrumental' => 'Instrumental',
        'other' => 'Other',
    ],
    'played' => [
        'any' => 'ไม่เจาะจง',
        'played' => 'เคยเล่นแล้ว',
        'unplayed' => 'ยังไม่เคยเล่น',
    ],
    'extra' => [
        'video' => 'Has Video',
        'storyboard' => 'Has Storyboard',
    ],
    'rank' => [
        'any' => 'Any',
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
