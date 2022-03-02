<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[ผู้ใช้ที่ถูกลบ]',

    'beatmapset_activities' => [
        'title' => ":user's ประวัติการมอด",
        'title_compact' => 'การวิจารณ์บีทแมพ',

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

    'disabled' => [
        'title' => 'โอ๊ะโอ บัญชีของคุณถูกระงับ',
        'warning' => "ถ้าคุณทำผิดกฎ เราจะบอกว่ามีระยะเวลาเว้นช่วง (Cool-down) หนึ่งเดือน ซึ่งระหว่างนี้เราจะไม่รับคำขอยกโทษ และหลังจากผ่านไปแล้วหนึ่งเดือน คุณค่อยติดต่อเรากลับมา (ถ้าจำเป็น) อีกอย่างคือถ้าสร้างบัญชีเพิ่มอีก (หลังจากอันเก่าโดนระงับ) ก็<strong>จะโดนอีกหนึ่งเดือน</strong> และจะบอกว่า<strong>ยิ่งสร้างบัญชีเพิ่ม ยิ่งทำผิดกฎมากขึ้น</strong> ขอร้องล่ะนะ",

        'if_mistake' => [
            '_' => 'หากคิดว่าเป็นความผิดพลาด สามารถติดต่อเรา (ผ่าน :email หรือกดปุ่ม "?" ที่ด้านล่างขวาของหน้านี้) เราขอบอกว่าทุกอย่างที่เราทำไปค่อนข้างมั่นใจและแน่นอนมาก เพราะทุกอย่างมาจากข้อมูลที่ชัดเจน และขอเตือนว่าเรามีสิทธิ์จะปฏิเสธคำขอของคุณหากเรารู้สึกว่าคุณไม่สุจริต',
            'email' => 'อีเมล',
        ],

        'reasons' => [
            'compromised' => 'บัญชีของคุณถือว่าถูกบุกรุก อาจถูกปิดใช้งานชั่วคราวในขณะที่มีการยืนยันตัวตน',
            'opening' => 'การที่บัญชีของคุณถูกระงับนั้นมาจากหลายสาเหตุด้วยกัน:',

            'tos' => [
                '_' => 'คุณทำผิด :community_rules อย่างน้อยหนึ่งข้อ หรือ :tos',
                'community_rules' => 'กฎชุมชน',
                'tos' => 'เงื่อนไขการใช้บริการ',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'สมาชิกตามโหมดเกม',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "บัญชีของคุณไม่ได้ใช้งานมานาน",
        ],
    ],

    'login' => [
        '_' => 'ลงชื่อเข้าใช้',
        'button' => 'ลงชื่อเข้าใช้',
        'button_posting' => 'กำลังลงชื่อเข้าใช้…',
        'email_login_disabled' => '
ขณะนี้การลงชื่อเข้าใช้ด้วยอีเมลถูกปิดใช้งาน กรุณาใช้ชื่อผู้ใช้แทน',
        'failed' => 'เข้าสู่ระบบไม่ถูกต้อง',
        'forgot' => 'ลืมรหัสผ่าน?',
        'info' => 'กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ',
        'invalid_captcha' => 'เข้าสู่ระบบล้มเหลวมากเกินไป กรุณาทำ captcha และลองอีกครั้ง (ลองรีเฟรชหน้าเว็บถ้ามองไม่เห็น captcha)',
        'locked_ip' => 'ที่อยู่ IP ของคุณถูกล็อก โปรดรอสักครู่',
        'password' => 'รหัสผ่าน',
        'register' => "ไม่มีแอคเคาท์ osu! หรอ? สร้างเลยสิ",
        'remember' => 'จดจำคอมพิวเตอร์นี้',
        'title' => 'กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป',
        'username' => 'ชื่อผู้ใช้',

        'beta' => [
            'main' => 'การเข้าใช้แบบเบต้าจำกัดเฉพาะผู้ใช้ที่มีสิทธิพิเศษเท่านั้น',
            'small' => '(osu!supporters จะได้เข้าเร็วๆนี้)',
        ],
    ],

    'posts' => [
        'title' => 'โพสต์ทั้งหมดของ:username',
    ],

    'anonymous' => [
        'login_link' => 'คลิกเพื่อลงชื่อเข้าใช้',
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
            'multiple_accounts' => 'การใช้หลายบัญชี',
            'insults' => 'ดูหมิ่น เหยียดหยามตนเอง / ผู้อื่น',
            'spam' => 'สแปม',
            'unwanted_content' => 'ส่งลิงก์ที่มีเนื้อหาที่ไม่เหมาะสม',
            'nonsense' => 'เรื่องไร้สาระ',
            'other' => 'อื่นๆ (ระบุ)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'บัญชีผู้ใช้ของคุณได้ถูกจำกัดการใช้งาน!',
        'message' => 'เมื่อถูกจำกัดการใช้งาน, คุณจะไม่สามารถโต้ตอบกับผู้เล่นคนอื่น ๆ ได้ และคะแนนของคุณจะเห็นได้แค่คุณเท่านั้น นี่น่าจะเป็นผลของกระบวนการอัตโนมัติและจะถูกปลดภายใน 24 ชั่วโมง ถ้าคุณประสงค์จะอุทธรณ์การจำกัดการใช้งานแอคเคาท์ของคุณ โปรดติดต่อที่<a href="mailto:accounts@ppy.sh">ความช่วยเหลือผู้เล่น</a>.',
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
        'missingtext' => 'พิมพ์ผิดหรือเปล่า? (ไม่ก็ผู้ใช้โดนแบน)',
        'origin_country' => 'มาจาก :country',
        'previous_usernames' => 'เคยมีชื่อว่า',
        'plays_with' => 'เล่นด้วย :devices',
        'title' => "โปรไฟล์ของ :username",

        'comments_count' => [
            '_' => 'โพสต์ :link',
            'count' => ':count_delimited ความคิดเห็น|:count_delimited ความคิดเห็น',
        ],
        'edit' => [
            'cover' => [
                'button' => 'เปลี่ยนรูปภาพปก',
                'defaults_info' => 'จะมีตัวเลือกรูปภาพปกเพิ่มมากขึ้นในอนาคต',
                'upload' => [
                    'broken_file' => 'ประมวลผลรูปภาพล้มเหลว โปรดตรวจสอบรูปภาพและลองใหม่อีกครั้ง',
                    'button' => 'อัพโหลดรูปภาพ',
                    'dropzone' => 'วางที่นี่เพื่ออัพโหลด',
                    'dropzone_info' => 'นอกจากนี้คุณยังสามารถวางรูปภาพเพื่ออัปโหลด',
                    'size_info' => 'รูปภาพหน้าปกควรจะมีขนาด 2400x620',
                    'too_large' => 'ไฟล์มีขนาดใหญ่เกินไป',
                    'unsupported_format' => 'ไม่รองรับไฟล์นามสกุลนี้',

                    'restriction_info' => [
                        '_' => 'อัพโหลดได้สำหรับ :link เท่านั้น',
                        'link' => 'ผู้สนับสนุน osu!',
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
                'title' => 'บีทแมพ',

                'favourite' => [
                    'title' => 'บีทแมพที่ชื่นชอบ',
                ],
                'graveyard' => [
                    'title' => 'สุสานบีทแมพ',
                ],
                'loved' => [
                    'title' => 'บีทแมพที่ Loved',
                ],
                'pending' => [
                    'title' => 'บีทแมพที่กำลังทำ',
                ],
                'ranked' => [
                    'title' => 'บีทแมพที่จัดอันดับแล้ว',
                ],
            ],
            'discussions' => [
                'title' => 'การสนทนา',
                'title_longer' => 'บทสนทนาที่ผ่านมา',
                'show_more' => 'ดูการสนทนาเพิ่มเติม',
            ],
            'events' => [
                'title' => 'อีเว้นท์',
                'title_longer' => 'อีเว้นท์ล่าสุด',
                'show_more' => 'ดูอีเว้นท์อื่นๆ เพิ่มเติม',
            ],
            'historical' => [
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
                    '_' => 'ขึ้นอยู่กับการดูแลบีทแมพของเจ้าของบีทแมพ ดูรายละเอียดเพิ่มเติมที่นี่ :link',
                    'link' => 'หน้านี้',
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
            'playlists' => [
                'title' => '',
            ],
            'posts' => [
                'title' => 'โพสต์',
                'title_longer' => 'โพสต์ล่าสุด',
                'show_more' => 'ดูโพสต์อื่นๆ เพิ่มเติม',
            ],
            'recent_activity' => [
                'title' => 'ล่า​สุด',
            ],
            'realtime' => [
                'title' => '',
            ],
            'top_ranks' => [
                'download_replay' => 'ดาวน์โหลดรีเพลย์',
                'not_ranked' => 'บีทแมพแรงค์เท่านั้นที่ให้ pp',
                'pp_weight' => 'weighted :percentage',
                'view_details' => 'ดูรายละเอียดเพิ่มเติม',
                'title' => 'อันดับ',

                'best' => [
                    'title' => 'Performance ที่ดีที่สุด',
                ],
                'first' => [
                    'title' => 'First Place Ranks',
                ],
                'pin' => [
                    'to_0' => '',
                    'to_0_done' => '',
                    'to_1' => '',
                    'to_1_done' => '',
                ],
                'pinned' => [
                    'title' => '',
                ],
            ],
            'votes' => [
                'given' => 'จำนวน Votes ที่ได้ให้ (เมื่อสามเดือนที่แล้ว)',
                'received' => 'ผลโหวตที่ได้รับ (เมื่อสามเดือนที่แล้ว)',
                'title' => 'โหวต',
                'title_longer' => 'โหวตล่าสุด',
                'vote_count' => ':count_delimited โหวต|:count_delimited โหวตทั้งหมด',
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
            'discord' => '',
            'interests' => 'สิ่งที่สนใจ',
            'location' => 'ตำแหน่งปัจจุบัน',
            'occupation' => 'อาชีพ',
            'twitter' => '',
            'website' => 'เว็บไซต์',
        ],
        'not_found' => [
            'reason_1' => 'ผู้ใช้นั้นอาจเปลี่ยนชื่อ',
            'reason_2' => 'ชื่อผู้ใช้อาจไม่สามารถเข้าถึงได้ชั่วคราวเนื่องจากปัญหาเกี่ยวกับความปลอดภัยหรือ abuse',
            'reason_3' => 'คุณอาจสะกดผิด!',
            'reason_header' => 'สิ่งนี้เกิดจากเหตุผลบางข้อ:',
            'title' => 'ไม่พบผู้ใช้นี้',
        ],
        'page' => [
            'button' => 'แก้ไขโปรไฟล์',
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',

            'restriction_info' => [
                '_' => 'คุณจำเป็นจะต้อง :link เพื่อที่จะปลดล็อกสิ่งนี้',
                'link' => 'osu!ผู้สนับสนุน',
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
            'graveyard_beatmapset_count' => 'สุสานบีทแมพ',
            'loved_beatmapset_count' => 'บีทแมพที่ Loved',
            'pending_beatmapset_count' => 'บีทเเมพที่กำลังทำ',
            'ranked_beatmapset_count' => 'บีทแมพที่จัดอันดับแล้ว',
        ],
    ],

    'silenced_banner' => [
        'title' => 'คุณกำลังถูกใบ้อยู่',
        'message' => 'การกระทำบางอย่างอาจใช้ไม่ได้',
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
        'brick' => 'มุมมองแบบกลุ่มก้อน',
        'card' => 'มุมมองแบบการ์ด',
        'list' => 'มุมมองแบบรายการ',
    ],
];
