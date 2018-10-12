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
    'deleted' => '[ผู้ใช้ที่ถูกลบ]',

    'beatmapset_activities' => [
        'title' => ":user's ประวัติการมอด",

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
        'banner_text' => '',
        'blocked_count' => '',
        'hide_profile' => '',
        'not_blocked' => '',
        'show_profile' => '',
        'too_many' => '',
        'button' => [
            'block' => '',
            'unblock' => '',
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
            'small' => '',
        ],

        'here' => 'ที่นี่', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'โพสต์ทั้งหมดของ:username',
    ],

    'signup' => [
        '_' => 'สมัครสมาชิก',
    ],
    'anonymous' => [
        'login_link' => 'คลิกเพื่อลงชื่อเข้าใช้',
        'login_text' => 'ลงชื่อเข้าใช้',
        'username' => 'ผู้เยี่ยมชม',
        'error' => 'คุณจะต้องเข้าสู่ระบบเพื่อจะกระทำสิ่งนี้',
    ],
    'logout_confirm' => 'คุณแน่ใจหรือว่าต้องการออกจากระบบ? :(',
    'report' => [
        'button_text' => '',
        'comments' => '',
        'placeholder' => '',
        'reason' => '',
        'thanks' => '',
        'title' => '',

        'actions' => [
            'send' => '',
            'cancel' => '',
        ],

        'options' => [
            'cheating' => '',
            'insults' => '',
            'spam' => '',
            'unwanted_content' => '',
            'nonsense' => '',
            'other' => '',
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
                    'restriction_info' => "อัพโหลดพร้อมแล้ว สำหรับ <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!ผู้สนับสนุน</a> เท่านั้น",
                    'size_info' => 'รูปภาพหน้าปกควรจะมีขนาด 2000x700',
                    'too_large' => 'ไฟล์มีขนาดใหญ่เกินไป',
                    'unsupported_format' => 'ไม่รองรับไฟล์นามสกุลนี้',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'เกมโหมดหลัก',
                'set' => 'ตั้ง :mode เป็นเกมโหมดหลักของโปรไฟล์',
            ],
        ],

        'extra' => [
            'followers' => ':count ผู้ติดตาม',
            'unranked' => 'ยังไม่มีการเล่น',

            'achievements' => [
                'title' => 'รางวัลความสำเร็จ',
                'achieved-on' => 'สำเร็จเมื่อวันที่ :date',
            ],
            'beatmaps' => [
                'none' => 'ยังไม่มี... อะ.',
                'title' => 'บีทแมพ',

                'favourite' => [
                    'title' => 'บีทแมพที่ชื่นชอบ (:count)',
                ],
                'graveyard' => [
                    'title' => 'สุสานบีทแมพ (:count)',
                ],
                'loved' => [
                    'title' => '',
                ],
                'ranked_and_approved' => [
                    'title' => 'แรงค์บีทแมพ & บีทแมพที่ได้รับการยอมรับ (:count)',
                ],
                'unranked' => [
                    'title' => 'บีทแมพที่กำลังทำ (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'ไม่มี performance ที่บันทึกไว้. :(',
                'title' => 'ประวัติ',

                'monthly_playcounts' => [
                    'title' => 'ประวัติการเล่น',
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
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Available',
                'available_info' => "Kudosu สามารถแลกเปลี่ยนเป็นดาว kudosu ได้, ซึ่งจะช่วยให้ บีทแมพของคุณได้รับการสนใจมากขึ้น. นี่คือตัวเลข kudosu ของคุณที่ยังไม่ได้แลกเปลี่ยน",
                'recent_entries' => 'ประวัติ Kudosu ล่าสุด',
                'title' => 'Kudosu!',
                'total' => 'Kudosu ที่ได้รับ',
                'total_info' => 'ขึ้นอยู่กับจำนวนผู้ใช้ที่ได้รับการดูแล บีทแมพ. 
ดู <a href="'.osu_url('user.kudosu').'">this page</a> สำหรับข้อมูลเพิ่มเติม',

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
            ],
            'me' => [
                'title' => 'ฉัน!',
            ],
            'medals' => [
                'empty' => "ผู้ใช้คนนี้ยังไม่มีอะไรเลย. ;_;",
                'title' => 'เหรียญตรา',
            ],
            'recent_activity' => [
                'title' => 'ล่า​สุด',
            ],
            'top_ranks' => [
                'empty' => 'ยังไม่มี performance ที่เจ๋งๆบันทึกไว้เลย . :(',
                'not_ranked' => 'บีทแมพแรงค์เท่านั้นที่ให้พีพี',
                'pp' => ':amountpp',
                'title' => 'อันดับ',
                'weighted_pp' => 'weighted: :pp (:percentage)',

                'best' => [
                    'title' => 'Performance ที่ดีที่สุด',
                ],
                'first' => [
                    'title' => 'First Place Ranks',
                ],
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
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'post_count' => [
            '_' => 'การมีส่วนร่วม :link',
            'count' => ':count ฟอรัมโพสต์|:count โฟรัมโพสต์',
        ],
        'rank' => [
            'country' => 'อันดับประเทศของ :mode',
            'global' => 'อันดับทั่วโลกของ :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'ความแม่นยำเฉลี่ย',
            'level' => 'เลเวล :level',
            'maximum_combo' => 'คอมโบสูงสุด',
            'play_count' => 'จำนวนครั้งที่เล่น',
            'play_time' => 'เวลาการเล่นทั้งหมด',
            'ranked_score' => 'คะแนนแรงค์',
            'replays_watched_by_others' => 'ดูรีเพลย์โดยผู้อื่น',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'คะแนนรวมทั้งหมด',
        ],
    ],
    'status' => [
        'online' => 'ออนไลน์',
        'offline' => 'ออฟไลน์',
    ],
    'store' => [
        'saved' => 'ผู้ใช้ถูกสร้างขึ้น',
    ],
    'verify' => [
        'title' => 'ยืนยันตัวตนบัญชี',
    ],
];
