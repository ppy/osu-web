<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[ผู้ใช้ที่ถูกลบ]',

    'beatmapset_activities' => [
        'title' => "ประวัติการมอดของ :user",
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
            'title_most' => 'ถูกโหวตสูงสุดโดย (สามเดือนที่ผ่านมา)',
        ],

        'votes_made' => [
            'title_most' => 'ผลโหวตสูงสุด (สามเดือนที่ผ่านมา)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'คุณได้บล็อกผู้ใช้รายนี้แล้ว',
        'comment_text' => 'ความคิดเห็นนี้ถูกซ่อนไว้',
        'blocked_count' => 'ผู้ใช้งานที่ถูกบล็อก (:count)',
        'hide_profile' => 'ซ่อนโปรไฟล์',
        'hide_comment' => 'ซ่อน',
        'forum_post_text' => 'โพสต์นี้ถูกซ่อนไว้',
        'not_blocked' => 'ผู้ใช้นี้ไม่ได้ถูกบล็อก',
        'show_profile' => 'แสดงโปรไฟล์',
        'show_comment' => 'แสดง',
        'too_many' => 'จำนวนการบล็อกถึงขีดจำกัดแล้ว',
        'button' => [
            'block' => 'บล็อก',
            'unblock' => 'ยกเลิกการบล็อก',
        ],
    ],

    'card' => [
        'gift_supporter' => 'ให้แท็กผู้สนับสนุนเป็นของขวัญ',
        'loading' => 'กำลังโหลด....',
        'send_message' => 'ส่งข้อความ',
    ],

    'create' => [
        'form' => [
            'password' => 'รหัสผ่าน',
            'password_confirmation' => 'ยืนยันรหัสผ่าน',
            'submit' => 'สร้างบัญชี',
            'user_email' => 'อีเมล',
            'user_email_confirmation' => 'ยืนยันอีเมล',
            'username' => 'ชื่อผู้ใช้',

            'tos_notice' => [
                '_' => 'โดยการสร้างบัญชีคุณได้ยอมรับ :link',
                'link' => 'เงื่อนไขการให้บริการ',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'โอ๊ะโอ ดูเหมือนว่าบัญชีของคุณถูกระงับ',
        'warning' => "ในกรณีที่คุณทำผิดกฎ เราจะมีระยะเวลาเว้นช่วงหนึ่งเดือนที่จะไม่รับคำขอยกโทษ ต้องหลังจากช่วงนี้ไปเท่านั้น คุณถึงจะสามารถติดต่อเรากลับมาได้ตามที่คุณคิดว่าจำเป็น ขอเตือนว่าถ้าสร้างบัญชีเพิ่มหลังจากที่บัญชีเก่าถูกระงับไป <strong>คุณจะโดนเพิ่มระยะเว้นช่วงอีกหนึ่งเดือน</strong> และ<strong>ยิ่งสร้างบัญชีเพิ่ม คุณก็ยิ่งทำผิดกฎมากขึ้น</strong> เราไม่ขอแนะนำให้ทำมันต่อไป",

        'if_mistake' => [
            '_' => 'หากคุณคิดว่านี่เป็นความผิดพลาด คุณสามารถติดต่อเราได้ (ผ่าน :email หรือกดปุ่ม "?" ที่ด้านล่างขวาของหน้านี้) เราขอบอกว่าทุกอย่างที่เราทำไปค่อนข้างจะมั่นใจ เพราะมันมาจากข้อมูลที่ชัดเจน และขอเตือนว่าเรามีสิทธิ์จะปฏิเสธคำขอของคุณหากเรารู้สึกว่าคุณไม่สุจริตจริง',
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
            'inactive' => "บัญชีของคุณไม่ได้ใช้งานมานาน",
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
            'small' => '(ผู้สนับสนุนจะได้เข้าใช้งานในเร็ว ๆ นี้)',
        ],
    ],

    'ogp' => [
        'modding_description' => 'บีทแมป: :counts',
        'modding_description_empty' => 'ผู้ใช้ยังไม่มีบีทแมปใดๆ...',

        'description' => [
            '_' => 'อันดับ (:ruleset): :global | :country',
            'country' => ':rank ทั้งประเทศ',
            'global' => ':rank ทั่วโลก',
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
            'send' => 'ส่งรายงาน',
            'cancel' => 'ยกเลิก',
        ],

        'dmca' => [
            'message_1' => [
                '_' => '',
                'policy' => '',
            ],
            'message_2' => '',
        ],

        'options' => [
            'cheating' => 'เล่นผิดกติกา / โกง',
            'copyright_infringement' => '',
            'inappropriate_chat' => '',
            'insults' => 'ดูหมิ่น เหยียดหยามตนเอง / ผู้อื่น',
            'multiple_accounts' => 'การใช้หลายบัญชี',
            'nonsense' => 'นอกเรื่อง',
            'other' => 'อื่นๆ (พิมพ์ด้านล่าง)',
            'spam' => 'สแปม',
            'unwanted_content' => 'ส่งลิงก์ที่มีเนื้อหาที่ไม่เหมาะสม',
        ],
    ],
    'restricted_banner' => [
        'title' => 'บัญชีผู้ใช้ของคุณได้ถูกจำกัดการใช้งาน!',
        'message' => 'ในขณะที่คุณถูกจำกัดการใช้งาน คุณจะไม่สามารถโต้ตอบกับผู้เล่นคนอื่น ๆ ได้ และคะแนนของคุณจะถูกมองเห็นได้เฉพาะคุณเท่านั้น นี่มักจะเป็นผลของกระบวนการอัตโนมัติและมักจะถูกปลดภายใน 24 ชั่วโมง :link',
        'message_link' => 'ตรวจสอบหน้านี้เพื่อเรียนรู้เพิ่มเติม',
    ],
    'show' => [
        'age' => ':age ปี',
        'change_avatar' => 'เปลี่ยนรูปของคุณ',
        'first_members' => 'อยู่ตั้งแต่โอสุเริ่มต้น',
        'is_developer' => 'osu!ผู้พัฒนา',
        'is_supporter' => 'ผู้สนับสนุน osu!',
        'joined_at' => 'เข้าร่วมเมื่อ :date',
        'lastvisit' => 'ออนไลน์ล่าสุด :date',
        'lastvisit_online' => 'ออนไลน์ในขณะนี้',
        'missingtext' => 'พิมพ์ผิดหรือเปล่า? (ไม่ก็ผู้ใช้โดนแบน)',
        'origin_country' => 'มาจาก :country',
        'previous_usernames' => 'เคยมีชื่อว่า',
        'plays_with' => 'เล่นด้วย :devices',

        'comments_count' => [
            '_' => 'โพสต์แล้ว :link',
            'count' => ':count_delimited ความคิดเห็น|:count_delimited ความคิดเห็น',
        ],
        'cover' => [
            'to_0' => 'ซ่อนปก',
            'to_1' => 'แสดงปก',
        ],
        'daily_challenge' => [
            'daily' => 'สตรีคประจำวัน',
            'daily_streak_best' => 'สตรีคประจำวันที่ดีที่สุด',
            'daily_streak_current' => 'สตรีคประจำวันปัจจุบัน',
            'playcount' => 'เข้าร่วมทั้งหมด',
            'title' => 'ชาเลนจ์\nประจำวัน',
            'top_10p_placements' => 'ท็อป 10% แรก',
            'top_50p_placements' => 'ท็อป 50% แรก',
            'weekly' => 'สตรีคประจำสัปดาห์',
            'weekly_streak_best' => 'สตรีคประจำสัปดาห์ที่ดีที่สุด',
            'weekly_streak_current' => 'สตรีคประจำสัปดาห์ปัจจุบัน',

            'unit' => [
                'day' => ':value วัน',
                'week' => ':value สัปดาห์',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'เปลี่ยนรูปภาพปก',
                'defaults_info' => 'จะมีตัวเลือกรูปภาพปกเพิ่มมากขึ้นในอนาคต',
                'holdover_remove_confirm' => "ปกที่เลือกไว้ก่อนหน้านี้ไม่สามารถเลือกได้อีกต่อไป คุณไม่สามารถเลือกกลับมาได้หลังจากสลับไปใช้ปกอื่น ดำเนินการต่อ?",
                'title' => 'ปก',

                'upload' => [
                    'broken_file' => 'ประมวลผลรูปภาพล้มเหลว โปรดตรวจสอบรูปภาพและลองใหม่อีกครั้ง',
                    'button' => 'อัพโหลดรูปภาพ',
                    'dropzone' => 'วางที่นี่เพื่ออัพโหลด',
                    'dropzone_info' => 'นอกจากนี้คุณยังสามารถวางรูปภาพเพื่ออัปโหลด',
                    'size_info' => 'รูปภาพหน้าปกควรจะมีขนาด 2400x620',
                    'too_large' => 'ไฟล์มีขนาดใหญ่เกินไป',
                    'unsupported_format' => 'ไม่รองรับไฟล์นามสกุลนี้',

                    'restriction_info' => [
                        '_' => 'อัพโหลดได้เฉพาะ :link เท่านั้น',
                        'link' => 'ผู้สนับสนุน osu!',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'เกมโหมดหลัก',
                'set' => 'ตั้ง :mode เป็นเกมโหมดหลักของโปรไฟล์',
            ],

            'hue' => [
                'reset_no_supporter' => 'รีเซ็ตสีเป็นค่าเริ่มต้นหรือไม่? จะต้องใช้แท็กผู้สนับสนุนเพื่อเปลี่ยนเป็นสีอื่น',
                'title' => 'สี',

                'supporter' => [
                    '_' => 'ธีมสีที่กำหนดเองมีให้เฉพาะสำหรับ :link เท่านั้น',
                    'link' => 'ผู้สนับสนุน osu!',
                ],
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
                'guest' => [
                    'title' => 'แขกผู้ที่มีส่วนร่วมบีทแมพ',
                ],
                'loved' => [
                    'title' => 'บีทแมพที่ Loved',
                ],
                'nominated' => [
                    'title' => 'บีทแมพที่ถูกเสนอชื่อแล้ว',
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
                        'reset' => 'รีเซ็ต Kudosu โดย :giver สำหรับโพสต์ :post',
                        'revoke' => 'ปฏิเสธ Kudosu โดย :giver สำหรับโพสต์ :post',
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
                'title' => 'เพลย์ลิสต์เกมส์',
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
                'title' => 'เกมผู้เล่นหลายคน',
            ],
            'top_ranks' => [
                'download_replay' => 'ดาวน์โหลดรีเพลย์',
                'not_ranked' => 'เฉพาะบีทแมพที่จัดอันดับแล้วเท่านั้นที่จะให้ pp',
                'pp_weight' => 'น้ำหนัก :percentage',
                'view_details' => 'ดูรายละเอียดเพิ่มเติม',
                'title' => 'อันดับ',

                'best' => [
                    'title' => 'ประสิทธิภาพที่ดีที่สุด',
                ],
                'first' => [
                    'title' => 'อันดับที่หนึ่ง',
                ],
                'pin' => [
                    'to_0' => 'เลิกปักหมุด',
                    'to_0_done' => 'คะแนนที่ไม่ได้ปักหมุด',
                    'to_1' => 'ปักหมุด',
                    'to_1_done' => 'คะแนนที่ปักหมุดไว้',
                ],
                'pinned' => [
                    'title' => 'คะแนนที่ปักหมุดไว้',
                ],
            ],
            'votes' => [
                'given' => 'ผลโหวตที่ให้ (เมื่อสามเดือนที่แล้ว)',
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
                    'length_indefinite' => 'ไม่มีกำหนด',
                    'description' => 'คำอธิบาย',
                    'actor' => 'โดย :username',

                    'actions' => [
                        'restriction' => 'แบน',
                        'silence' => 'ถูกใบ้',
                        'tournament_ban' => 'แบนการแข่งขัน',
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
            'reason_1' => 'พวกเขาอาจเปลี่ยนชื่อผู้ใช้',
            'reason_2' => 'ชื่อผู้ใช้อาจไม่สามารถเข้าถึงได้ชั่วคราวเนื่องจากปัญหาเกี่ยวกับความปลอดภัยหรือ abuse',
            'reason_3' => 'คุณอาจสะกดผิด!',
            'reason_header' => 'มีสาเหตุบางประการที่เป็นไปได้สำหรับสิ่งนี้:',
            'title' => 'ไม่พบชื่อผู้ใช้! ;_;',
        ],
        'page' => [
            'button' => 'แก้ไขโปรไฟล์',
            'description' => '<strong>ฉัน!</strong> เป็นพื้นที่ส่วนบุคคลที่สามารถปรับแต่งได้ในหน้าโปรไฟล์ของคุณ',
            'edit_big' => 'แก้ไขฉันสิ!',
            'placeholder' => 'พิมพ์เนื้อหาของหน้าที่นี่',

            'restriction_info' => [
                '_' => 'คุณจำเป็นจะต้อง :link เพื่อที่จะปลดล็อกสิ่งนี้',
                'link' => 'ผู้สนับสนุน osu!',
            ],
        ],
        'post_count' => [
            '_' => 'การมีส่วนร่วม :link',
            'count' => ':count_delimited ฟอรัมโพสต์|:count_delimited ฟอรัมโพสต์',
        ],
        'rank' => [
            'country' => 'อันดับประเทศของ :mode',
            'country_simple' => 'อันดับในประเทศ',
            'global' => 'อันดับทั่วโลกของ :mode',
            'global_simple' => 'อันดับทั่วโลก',
            'highest' => 'อันดับสูงสุด: :rank เมื่อ :date',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'ความแม่นยำเฉลี่ย',
            'hits_per_play' => '',
            'level' => 'เลเวล :level',
            'level_progress' => 'ความคืบหน้าในการอัพเลเวล',
            'maximum_combo' => 'คอมโบสูงสุด',
            'medals' => 'เหรียญตรา',
            'play_count' => 'จำนวนครั้งที่เล่น',
            'play_time' => 'เวลาการเล่นทั้งหมด',
            'ranked_score' => 'คะแนนแรงค์',
            'replays_watched_by_others' => 'ดูรีเพลย์โดยผู้อื่น',
            'score_ranks' => 'อันดับคะแนน',
            'total_hits' => 'Hit รวม',
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
        'from_client' => 'โปรดลงทะเบียนผ่านในเกมแทน!',
        'from_web' => 'กรุณาลงทะเบียนโดยใช้เว็บไซต์ osu! ',
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
