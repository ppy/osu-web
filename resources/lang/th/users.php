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
    'deleted' => '[ผู้ใช้ที่ถูกลบ]',

    'beatmapset_activities' => [
        'title' => ":user's ประวัติการมอด",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'การสนทนาล่าสุด',
        ],

        'events' => [
            'title_recent' => 'เหตุการณ์ล่าสุด',
        ],

        'posts' => [
            'title_recent' => 'โพสต์ล่าสุด',
        ],

        'votes_received' => [
            'title_most' => 'ผลโหวตสูงสุด จาก (สามเดือนที่แล้ว)',
        ],

        'votes_made' => [
            'title_most' => 'ผลโหวตสูงสุด (สามเดือนที่แล้ว)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'คุณได้บล็อกผู้ใช้รายนี้แล้ว',
        'blocked_count' => 'บล็อกผู้ใช้งาน (:count)',
        'hide_profile' => 'ซ่อนโปรไฟล์',
        'not_blocked' => 'ผู้ใช้นี้ไม่ได้ถูกบล็อก',
        'show_profile' => 'แสดงโปรไฟล์',
        'too_many' => 'จำนวนการบล็อกถึงขีดจำกัดแล้ว',
        'button' => [
            'block' => 'บล็อก',
            'unblock' => 'ยกเลิกการบล็อค',
        ],
    ],

    'card' => [
        'loading' => 'กำลังโหลด....',
        'send_message' => 'ส่งข้อความ',
    ],

    'login' => [
        '_' => 'ลงชื่อเข้าใช้',
        'locked_ip' => 'ที่อยู่ IP ของคุณถูกล็อก โปรดรอสักครู่',
        'username' => 'ชื่อผู้ใช้',
        'password' => 'รหัสผ่าน',
        'button' => 'ลงชื่อเข้าใช้',
        'button_posting' => 'กำลังลงชื่อเข้าใช้…',
        'remember' => 'จดจำคอมพิวเตอร์นี้',
        'title' => 'กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป',
        'failed' => 'เข้าสู่ระบบไม่ถูกต้อง',
        'register' => "ไม่มีแอคเคาท์ Osu! หรอ? สร้างเลยสิ",
        'forgot' => 'ลืมรหัสผ่าน?',
        'beta' => [
            'main' => 'การเข้าถึงข้อมูลนี้มีข้อจำกัด จำกัดเฉพาะผู้ใช้ที่ได้รับการยกเว้นเท่านั้น',
            'small' => '(กำลังจะได้รับ osu!supporters เร็วๆนี้)',
        ],

        'here' => 'ที่นี่', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'โพสต์ทั้งหมดของ:username',
    ],

    'anonymous' => [
        'login_link' => 'คลิก! เพื่อลงชื่อเข้าใช้',
        'login_text' => 'ลงชื่อเข้าใช้',
        'username' => 'ผู้เยี่ยมชม',
        'error' => 'คุณจะต้องเข้าสู่ระบบเพื่อจะกระทำสิ่งนี้',
    ],
    'logout_confirm' => 'คุณแน่ใจหรือว่าต้องการออกจากระบบ? :(',
    'report' => [
        'button_text' => 'รายงาน',
        'comments' => 'ความคิดเห็นเพิ่มเติม',
        'placeholder' => 'โปรดให้ข้อมูลที่คุณคิดว่าจะมีประโยชน์',
        'reason' => 'เหตุผล',
        'thanks' => 'ขอบคุณสำหรับการรายงาน',
        'title' => 'รายงาน :username?',

        'actions' => [
            'send' => 'ส่งการรายงาน',
            'cancel' => 'ยกเลิก',
        ],

        'options' => [
            'cheating' => 'เล่นผิดกติกา / โกง',
            'insults' => 'ดูหมิ่น เหยียดหยามตนเอง / ผู้อื่น',
            'spam' => 'สแปม',
            'unwanted_content' => 'ส่งลิงก์ที่มีเนื้อหาที่ไม่เหมาะสม',
            'nonsense' => 'เรื่องไร้สาระ',
            'other' => 'อื่นๆ (ระบุ)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'แอคเคาท์ของคุณได้ถูกจำกัดการใช้งาน',
        'message' => 'เมื่อคุณถูกจำกัดการใช้งาน, คุณจะไม่สามารถโต้ตอบกับผู้เล่นคนอื่นๆได้ และ คะแนนของคุณจะถูกให้เห็นแค่คุณเท่านั้น. ทุกอย่างจะทำกระบวนการอัตโนมัติและจะแล้วเสร็จภายใน 24 ชั่วโมง. ถ้าคุณอยากขอลดการจำกัดการใช้งานแอคเคาท์ของคุณ, โปรดติดต่อที่นี่ <a href="mailto:accounts@ppy.sh">contact support</a>.',
    ],
    'show' => [
        'age' => ':age ปี',
        'change_avatar' => 'เปลี่ยนรูปของคุณ',
        'first_members' => 'อยู่ตั้งแต่โอสุเริ่มต้น',
        'is_developer' => 'osu!ผู้พัฒนา',
        'is_supporter' => 'osu!ผู้สนับสนุน',
        'joined_at' => 'เข้าร่วมเมื่อ :date',
        'lastvisit' => 'ออนไลน์ล่าสุด :date',
        'lastvisit_online' => 'ออนไลน์ในขณะนี้',
        'missingtext' => 'คุณอาจจะผิดพลาดนะ! (หรือไม่ก็ผู้ใช้อาจจะถูกแบน)',
        'origin_country' => 'มาจาก :country',
        'page_description' => 'osu! - ทุกสิ่งทุกอย่างที่คุณอยากรู้เกี่ยวกับ :username!',
        'previous_usernames' => 'เคยมีชื่อว่า',
        'plays_with' => 'เล่นด้วย :devices',
        'title' => ":username's โปรไฟล์",

        'edit' => [
            'cover' => [
                'button' => 'เปลี่ยนรูปภาพปก',
                'defaults_info' => 'จะมีตัวเลือกรูปภาพปกเพิ่มมากขึ้นในอนาคต',
                'upload' => [
                    'broken_file' => 'ประมวลผลรูปภาพล้มเหลว. โปรดตรวจสอบรูปภาพและลองใหม่อีกครั้ง.',
                    'button' => 'อัพโหลดรูปภาพ',
                    'dropzone' => 'วางที่นี่เพื่ออัพโหลด',
                    'dropzone_info' => 'นอกจากนี้คุณยังสามารถวางรูปภาพเพื่ออัปโหลด',
                    'size_info' => 'รูปภาพหน้าปกควรจะมีขนาด 2800x620',
                    'too_large' => 'ไฟล์มีขนาดใหญ่เกินไป',
                    'unsupported_format' => 'ไม่รองรับไฟล์นามสกุลนี้',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'เกมโหมดหลัก',
                'set' => 'ตั้ง :mode เป็นเกมโหมดหลักของโปรไฟล์',
            ],
        ],

        'extra' => [
            'none' => 'ไม่มี',
            'unranked' => 'ยังไม่มีการเล่น',

            'achievements' => [
                'achieved-on' => 'สำเร็จเมื่อวันที่ :date',
                'locked' => 'ล็อค',
                'title' => 'รางวัลความสำเร็จ',
            ],
            'beatmaps' => [
                'by_artist' => 'โดย :artist',
                'none' => 'ยังไม่มี... อะ.',
                'title' => 'บีทแมพ',

                'favourite' => [
                    'title' => 'บีทแมพที่ชื่นชอบ',
                ],
                'graveyard' => [
                    'title' => 'สุสานบีทแมพ',
                ],
                'loved' => [
                    'title' => 'Beatmaps ที่ชื่นชอบ',
                ],
                'ranked_and_approved' => [
                    'title' => 'แรงค์บีทแมพ & บีทแมพที่ได้รับการยอมรับ',
                ],
                'unranked' => [
                    'title' => 'บีทแมพที่กำลังทำ',
                ],
            ],
            'discussions' => [
                'title' => 'การสนทนา',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => 'อีเว้นท์',
                'title_longer' => 'อีเว้นท์ล่าสุด',
                'show_more' => 'ดูอีเว้นท์อื่นๆ เพิ่มเติม',
            ],
            'historical' => [
                'empty' => 'ไม่มี performance ที่บันทึกไว้. :(',
                'title' => 'ประวัติ',

                'monthly_playcounts' => [
                    'title' => 'ประวัติการเล่น',
                    'count_label' => 'จำนวนการเล่น',
                ],
                'most_played' => [
                    'count' => 'จำนวนครั้งที่เล่น',
                    'title' => 'บีทแมพที่เล่นมากที่สุด',
                ],
                'recent_plays' => [
                    'accuracy' => 'ความแม่นยำ: :percentage',
                    'title' => 'เล่นล่าสุด (24 ชั่วโมง)',
                ],
                'replays_watched_counts' => [
                    'title' => 'ประวัติการดูรีเพลย์',
                    'count_label' => 'การดูรีเพลย์',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Available',
                'available_info' => "Kudosu สามารถแลกเปลี่ยนเป็นดาว kudosu ได้, ซึ่งจะช่วยให้ บีทแมพของคุณได้รับการสนใจมากขึ้น. นี่คือตัวเลข kudosu ของคุณที่ยังไม่ได้แลกเปลี่ยน",
                'recent_entries' => 'ประวัติ Kudosu ล่าสุด',
                'title' => 'Kudosu!',
                'total' => 'Kudosu ที่ได้รับ',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "ผู้ใช้คนนี้ยังไม่เคยได้รับ kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'ได้รับ :amount kudosu จากการไม่ยกเลิก modding โพสต์ :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'ปฏิเสธ :amount จาก modding โพสต์ :post',
                        ],

                        'delete' => [
                            'reset' => 'สูญหาย :amount จากการลบmoddingโพสต์ :post',
                        ],

                        'restore' => [
                            'give' => 'ได้รับ :amount จากการโพสต์modding :post',
                        ],

                        'vote' => [
                            'give' => 'ได้รับ :amount จากการได้รับคะแนนโหวตในตำแหน่ง modding :post',
                            'reset' => 'สูญหาย :amount จากการสูญเสียคะแนนโหวตในตำแหน่ง modding :post',
                        ],

                        'recalculate' => [
                            'give' => 'ได้รับ :amount จากการโหวตในโพสต์ modding เพื่อขอคำนวณใหม่ใน :post',
                            'reset' => 'เสีย :amount จากการโหวตในโพสต์ modding เพื่อขอคำนวณใหม่ใน :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'ได้รับ :amount จาก :giver ให้ผู้โพสต์ :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => 'ฉัน!',
            ],
            'medals' => [
                'empty' => "ผู้ใช้คนนี้ยังไม่มีอะไรเลย. ;_;",
                'recent' => 'ล่าสุด',
                'title' => 'เหรียญตรา',
            ],
            'posts' => [
                'title' => 'โพสต์',
                'title_longer' => 'โพสต์ล่าสุด',
                'show_more' => 'ดูโพสต์อื่นๆ เพิ่มเติม',
            ],
            'recent_activity' => [
                'title' => 'ล่า​สุด',
            ],
            'top_ranks' => [
                'download_replay' => 'ดาวน์โหลดรีเพลย์',
                'empty' => 'ยังไม่มี performance ที่เจ๋งๆบันทึกไว้เลย . :(',
                'not_ranked' => 'บีทแมพแรงค์เท่านั้นที่ให้พีพี',
                'pp_weight' => 'weighted :percentage',
                'title' => 'อันดับ',

                'best' => [
                    'title' => 'Performance ที่ดีที่สุด',
                ],
                'first' => [
                    'title' => 'First Place Ranks',
                ],
            ],
            'votes' => [
                'given' => 'จำนวน Votes ที่ได้ให้ (เมื่อสามเดือนที่แล้ว)',
                'received' => 'ผลโหวตที่ได้รับ (เมื่อสามเดือนที่แล้ว)',
                'title' => 'โหวต',
                'title_longer' => 'โหวตล่าสุด',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'ชื่อเสียงของบัญชี',
                'bad_standing' => "<strong>:username's</strong> บัญชีนี้ได้กระทำสิ่งที่ไม่ดี :(",
                'remaining_silence' => '<strong>:username</strong> จะสามารถพูดได้อีกครั้ง ใน :duration',

                'recent_infringements' => [
                    'title' => 'การกระทำผิดล่าสุด',
                    'date' => 'วันที่',
                    'action' => 'ดำเนินการ',
                    'length' => 'ระยะเวลา',
                    'length_permanent' => 'ถาวร',
                    'description' => 'คำอธิบาย',
                    'actor' => 'โดย {username}',

                    'actions' => [
                        'restriction' => 'แบน',
                        'silence' => 'ถูกใบ้',
                        'note' => 'หมายเหตุ',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'ผู้เล่น :info',
            'info' => 'ข้อมูล',
        ],

        'info' => [
            'discord' => 'ดิสคอร์ด',
            'interests' => 'สิ่งที่สนใจ',
            'lastfm' => 'Last.fm',
            'location' => 'ตำแหน่งปัจจุบัน',
            'occupation' => 'อาชีพ',
            'skype' => 'Skype',
            'twitter' => 'ทวิตเตอร์',
            'website' => 'เว็บไซต์',
        ],
        'not_found' => [
            'reason_1' => 'ผู้ใช้นั้นอาจเปลี่ยนชื่อ',
            'reason_2' => 'ชื่อผู้ใช้อาจไม่สามารถเข้าถึงได้ชั่วคราวเนื่องจากปัญหาเกี่ยวกับความปลอดภัยหรือ abuse',
            'reason_3' => 'โปรตรวจสอบว่ามีข้อผิดพลาดหรือไม่!',
            'reason_header' => 'ขอเหตุผลสักสองสามข้อ สำหรับสิ่งที่เกิดขึ้น:',
            'title' => 'ไม่พบผู้ใช้นี้',
        ],
        'page' => [
            'button' => 'แก้ไขโปรไฟล์',
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',

            'restriction_info' => [
                '_' => 'คุณจำเป็นจะต้อง :link เพื่อที่จะปลดล็อกสิ่งนี้',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'การมีส่วนร่วม :link',
            'count' => ':count ฟอรัมโพสต์|:count โฟรัมโพสต์',
        ],
        'rank' => [
            'country' => 'อันดับประเทศของ :mode',
            'country_simple' => 'อันดับในประเทศ',
            'global' => 'อันดับทั่วโลกของ :mode',
            'global_simple' => 'อันดับทั่วโลก',
        ],
        'stats' => [
            'hit_accuracy' => 'ความแม่นยำเฉลี่ย',
            'level' => 'เลเวล :level',
            'level_progress' => 'ความคืบหน้าในการอัพเลเวล',
            'maximum_combo' => 'คอมโบสูงสุด',
            'medals' => 'เหรียญตรา',
            'play_count' => 'จำนวนครั้งที่เล่น',
            'play_time' => 'เวลาการเล่นทั้งหมด',
            'ranked_score' => 'คะแนนแรงค์',
            'replays_watched_by_others' => 'ดูรีเพลย์โดยผู้อื่น',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'คะแนนรวมทั้งหมด',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => 'เลิฟแมพ',
            'unranked_beatmapset_count' => 'บีทเเมพที่กำลังทำ',
            'graveyard_beatmapset_count' => 'สุสานบีทแมพ',
        ],
    ],

    'status' => [
        'all' => 'ทั้งหมด',
        'online' => 'ออนไลน์',
        'offline' => 'ออฟไลน์',
    ],
    'store' => [
        'saved' => 'ผู้ใช้ถูกสร้างขึ้น',
    ],
    'verify' => [
        'title' => 'ยืนยันตัวตนบัญชี',
    ],

    'view_mode' => [
        'card' => '',
        'list' => '',
    ],
];
