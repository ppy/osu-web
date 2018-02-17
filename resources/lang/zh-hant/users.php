<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[被刪除的用戶]', //TODO 需要上下文

    'beatmapset_activities' => [
        'discussions' => [
            'title_recent' => '最近打開的討論', //上下文
        ],

        'events' => [
            'title_recent' => '最近事件',
        ],

        'posts' => [
            'title_recent' => '最近帖子',
        ],

        'votes_received' => [
            'title_most' => '得贊最多（最近三個月）',
        ],

        'votes_made' => [
            'title_most' => '贊數最多（最近三個月）',
        ],
    ],

    'login' => [
        '_' => '登錄',
        'locked_ip' => 'IP 已被鎖定，請稍等幾分鐘',
        'username' => '用戶名',
        'password' => '密碼',
        'button' => '登錄',
        'button_posting' => '登錄中...',
        'remember' => '記住此電腦',
        'title' => '登錄以繼續',
        'failed' => '登錄失敗',
        'register' => '沒有 osu! 賬戶？現在就註冊一個！',
        'forgot' => '忘記密碼？',
        'beta' => [ //已棄用(?)
            'main' => 'Beta 僅限於特定用戶訪問',
            'small' => '（捐贈玩家將在不久開放）',
        ],

        'here' => '這裏', // this is substituted in when generating a link above. change it to suit the language. //TODO 需要上下文
    ],
    'signup' => [
        '_' => '註冊',
    ],
    'anonymous' => [
        'login_link' => '點擊登錄',
        'login_text' => '登錄',
        'username' => '遊客',
        'error' => '請先登錄',
    ],
    'logout_confirm' => '確定要退出嗎？o(TヘTo)',
    'restricted_banner' => [
        'title' => '賬戶進入限制模式！',
        'message' => '在被限制時，無法與其他玩家互動，分數只有自己可見。該限制通常由系統自動給予，並將在24小時內解除。需要申訴？請<a href="mailto:accounts@ppy.sh">聯繫支持團隊</a>.',
    ],
    'show' => [
        '404' => '找不到指定的用戶',
        'age' => ':age 歲',
        'current_location' => '位於 :location',
        'first_members' => '元老玩家',
        'is_developer' => 'osu! 開發者',
        'is_supporter' => 'osu! 支持者',
        'joined_at' => '註冊時間：:date',
        'lastvisit' => '上次登錄：:date',
        'missingtext' => '未找到用戶！（或者該用戶已經被 ban）',
        'origin_age' => ':age 歲',
        'origin_country' => '來自 :country',
        'origin_country_age' => ':age，來自 :country',
        'page_description' => 'osu! - 你想知道的關於 :username 的一切!',
        'plays_with' => '慣用 :devices',
        'title' => ':username 的個人資料',
        'change_avatar' => '更換你的頭像！',

        'edit' => [
            'cover' => [
                'button' => '更換個人資料皮膚',
                'defaults_info' => '在將來會有更多皮膚可用',
                'upload' => [
                    'broken_file' => '上傳失敗.請檢查上傳的圖片然後重試.',
                    'button' => '上傳圖片',
                    'dropzone' => '拖拽到此處',
                    'dropzone_info' => '將圖片拖動到這裏也可以上傳',
                    'restriction_info' => "自定義皮膚只有 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!支持者</a> 可用",
                    'size_info' => '圖片尺寸應爲2000x500',
                    'too_large' => '上傳的圖片過大.',
                    'unsupported_format' => '不支持的格式.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '關注者：:count',
            'unranked' => '最近沒有玩過',

            'achievements' => [
                'title' => '成就',
                'achieved-on' => '達成於 :date',
            ],
            'beatmaps' => [
                'none' => '暫時沒有...',
                'title' => '譜面',

                'favourite' => [
                    'title' => '收藏的譜面 (:count)',
                ],
                'graveyard' => [
                    'title' => '墳場裏的譜面 (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked 並且得到讚的譜面 (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => '沒有遊戲記錄。:(',
                'most_played' => [
                    'count' => '遊玩次數',
                    'title' => '玩得最多的譜面',
                ],
                'recent_plays' => [
                    'accuracy' => '準確率：:percentage',
                    'title' => '最近24小時遊玩',
                ],
                'title' => '歷史記錄',
            ],
            'kudosu' => [
                'available' => '可用 kudosu',
                'available_info' => 'kudosu 可以兌換爲 kudosu 星,它可以讓你的譜面更引人注意。這是你還沒有兌換的 kudosu 數。',
                'recent_entries' => '最近 Kudosu 記錄',
                'title' => 'Kudosu!',
                'total' => '總共獲得 kudosu',
                'total_info' => '取決於你對制譜的貢獻如何。查看 <a href="'.osu_url('user.kudosu').'">這個頁面</a> 以得到更多信息。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => '該用戶還沒有收到過 kudosu ！',

                    'beatmap_discussion' => [ //TODO 專有名詞太多,需要幫助
                        'allow_kudosu' => [
                            'give' => '因討論帖 :post 的 kudosu 移除操作的撤銷而獲得 :amount',
                        ],

                        'deny_kudosu' => [
                            'reset' => '在討論帖 :post 中被移除 :amount',
                        ],

                        'delete' => [
                            'reset' => '因討論帖 :post 被刪除而失去 :amount',
                        ],

                        'restore' => [
                            'give' => '因討論帖 :post 被恢復而獲得 :amount',
                        ],

                        'vote' => [
                            'give' => '因在討論帖 :post 中得到了足夠票數而獲得 :amount',
                            'reset' => '因在討論帖 :post 中丟失了票數而失去 :amount',
                        ],

                        'recalculate' => [
                            'give' => '因討論帖 :post 的投票重新計算而獲得 :amount',
                            'reset' => '因討論帖 :post 的投票重新計算而失去 :amount',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '在帖子 :post 中被 :giver 給予 :amount ',
                        'reset' => '在帖子 :post 中被 :giver 重置 kudosu ',
                        'revoke' => '在帖子 :post 中被 :giver 移除 kudosu ',
                    ],
                ],
            ],
            'me' => [
                'title' => '個人介紹',
            ],
            'medals' => [
                'empty' => '該用戶還沒有獲得成就。;_;',
                'title' => '成就',
            ],
            'recent_activity' => [
                'title' => '最近活動',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => '最好成績',
                ],
                'empty' => '還沒有上傳過成績。 :(',
                'first' => [
                    'title' => '第一名',
                ],
                'pp' => ':amountpp',
                'title' => '成績',
                'weighted_pp' => '權重：:pp (:percentage)',
            ],
        ],
        'page' => [
            'description' => '<strong>個人介紹</strong> 是您可以自定義的展示區.',
            'edit_big' => '編輯',
            'placeholder' => '在這裏編輯',
            'restriction_info' => "需要成爲 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!支持者</a> 以解鎖該特性.",
        ],
        'rank' => [
            'country' => ':mode 模式的國內排名',
            'global' => ':mode 模式的全球排名',
        ],
        'stats' => [
            'hit_accuracy' => '準確率',
            'level' => '等級 :level',
            'maximum_combo' => '最大連擊',
            'play_count' => '遊戲次數',
            'play_time' => '遊戲時間',
            'ranked_score' => 'Ranked 譜面總分',
            'replays_watched_by_others' => '回放被觀看次數',
            'score_ranks' => '得分等級',
            'total_hits' => '總命中次數',
            'total_score' => '總分',
        ],
    ],
    'status' => [
        'online' => '在線',
        'offline' => '離線',
    ],
    'store' => [
        'saved' => '賬戶已創建',
    ],
    'verify' => [
        'title' => '賬戶認證',
    ],
];
