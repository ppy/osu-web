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
    'deleted' => '[已刪除的使用者]',

    'beatmapset_activities' => [
        'title' => ":user 的摸圖紀錄",

        'discussions' => [
            'title_recent' => '最近討論的主題',
        ],

        'events' => [
            'title_recent' => '近期活動',
        ],

        'posts' => [
            'title_recent' => '最新貼文',
        ],

        'votes_received' => [
            'title_most' => '得讚最多（近三個月）',
        ],

        'votes_made' => [
            'title_most' => '讚數最多（最近三個月）',
        ],
    ],

    'blocks' => [
        'banner_text' => '您已經封鎖這位使用者。',
        'blocked_count' => '被封鎖的使用者 (:count)',
        'hide_profile' => '隱藏用戶資料',
        'not_blocked' => '這位使用者未被封鎖。',
        'show_profile' => '顯示用戶資料',
        'too_many' => '已達到封鎖上限。',
        'button' => [
            'block' => '封鎖',
            'unblock' => '解除封鎖',
        ],
    ],

    'card' => [
        'loading' => '載入中...',
        'send_message' => '傳送訊息',
    ],

    'login' => [
        '_' => '登入',
        'locked_ip' => '您的 IP 位址已被鎖定。請稍候幾分鐘。',
        'username' => '使用者名稱',
        'password' => '密碼',
        'button' => '登入',
        'button_posting' => '登入中...',
        'remember' => '記住我這台裝置',
        'title' => '登入以繼續',
        'failed' => '登入失敗',
        'register' => "沒有 osu! 帳號嗎？現在就註冊一個吧！",
        'forgot' => '忘記密碼？',
        'beta' => [
            'main' => 'Beta 版僅限於特定使用者存取',
            'small' => '',
        ],

        'here' => '這裡', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username 的貼文',
    ],

    'signup' => [
        '_' => '註冊',
    ],
    'anonymous' => [
        'login_link' => '點擊登入',
        'login_text' => '登入',
        'username' => '訪客',
        'error' => '請先登入',
    ],
    'logout_confirm' => '確定要登出嗎？o(TヘTo)',
    'report' => [
        'button_text' => '檢舉',
        'comments' => '補充評論',
        'placeholder' => '',
        'reason' => '原因',
        'thanks' => '感謝您的舉報！',
        'title' => '檢舉 :username?',

        'actions' => [
            'send' => '傳送檢舉',
            'cancel' => '取消',
        ],

        'options' => [
            'cheating' => '違規 / 作弊',
            'insults' => '侮辱我 / 其他人',
            'spam' => '',
            'unwanted_content' => '',
            'nonsense' => '',
            'other' => '',
        ],
    ],
    'restricted_banner' => [
        'title' => '您的帳號已受到限制!',
        'message' => '當您的帳號受到系統自動限制時，您將無法與其他玩家互動，且您的遊戲分數僅供自己查閱。系統將在24小時內解除限制。如果您需要申訴？請<a href="mailto:accounts@ppy.sh">聯繫支援服務</a>.',
    ],
    'show' => [
        'age' => ':age 歲',
        'change_avatar' => '變更您的頭像！',
        'first_members' => '元老玩家',
        'is_developer' => 'osu! 開發者',
        'is_supporter' => 'osu! 贊助者',
        'joined_at' => '註冊時間：:date',
        'lastvisit' => '最後登入於：:date',
        'missingtext' => '未找到的使用者！（或者該使用者已經被封鎖）',
        'origin_country' => '來自 :country',
        'page_description' => 'osu! - 您想知道關於 :username 的資訊!',
        'previous_usernames' => '前一個的使用者名稱',
        'plays_with' => '慣用 :devices',
        'title' => ":username 的個人簡介",

        'edit' => [
            'cover' => [
                'button' => '變更個人簡介封面',
                'defaults_info' => '未來將提供更多的封面選項',
                'upload' => [
                    'broken_file' => '上傳失敗。請檢查上傳的圖片並重試.',
                    'button' => '上傳圖片',
                    'dropzone' => '拖動到此處以上傳',
                    'dropzone_info' => '您也可以將圖片拉到此處上傳',
                    'restriction_info' => "自定義皮膚只有 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!贊助者</a> 可用",
                    'size_info' => '圖片尺寸應為2000x500',
                    'too_large' => '上傳的圖片檔案過大.',
                    'unsupported_format' => '不支援的檔案格式.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '預設遊戲模式',
                'set' => '設定 :mode 為個人簡介預設的遊戲模式',
            ],
        ],

        'extra' => [
            'followers' => '關注者：:count',
            'unranked' => '近期沒有遊玩記錄',

            'achievements' => [
                'title' => '成就',
                'achieved-on' => '達成於 :date',
            ],
            'beatmaps' => [
                'none' => '暫時沒有...',
                'title' => '圖譜',

                'favourite' => [
                    'title' => '收藏的譜面 (:count)',
                ],
                'graveyard' => [
                    'title' => '墳場裡的譜面 (:count)',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked 和 Approved 的譜面 (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => '尚無遊戲分數。:(',
                'title' => '歷史記錄',

                'monthly_playcounts' => [
                    'title' => '遊玩紀錄',
                ],
                'most_played' => [
                    'count' => '遊玩次數',
                    'title' => '玩過次數最多的圖譜',
                ],
                'recent_plays' => [
                    'accuracy' => '準確率：:percentage',
                    'title' => '最近24小時遊玩',
                ],
                'replays_watched_counts' => [
                    'title' => '重播觀看的歷史記錄',
                ],
            ],
            'kudosu' => [
                'available' => '可使用的 kudosu',
                'available_info' => "kudosu 點數可以兌換成 kudosu 星星點數，該點數可以讓您的圖譜更引人注目。這是您尚未兌換的 kudosu 點數。",
                'recent_entries' => '近期 Kudosu 記錄',
                'title' => 'Kudosu!',
                'total' => '總共獲得 kudosu',
                'total_info' => '根據使用者對於製作圖譜的貢獻度。請參閱 <a href="'.osu_url('user.kudosu').'">> 本頁</a> 以瞭解更多資訊。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "該使用者尚未收到任何 kudosu ！",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '此貼文 :post 總共獲得 :amount 點 kudosu',
                        ],

                        'deny_kudosu' => [
                            'reset' => '此貼文 :post 總共被拒絕 :amount 點 kudosu',
                        ],

                        'delete' => [
                            'reset' => '此貼文 :post 因被移除總共失去 :amount 點 kudosu',
                        ],

                        'restore' => [
                            'give' => '此貼文 :post 因被還原總共獲得 :amount 點 kudosu',
                        ],

                        'vote' => [
                            'give' => '此貼文 :post 因取得足夠票數總共獲得 :amount 點 kudosu',
                            'reset' => '此貼文 :post 因得票數不足總共失去 :amount 點 kudosu',
                        ],

                        'recalculate' => [
                            'give' => '此貼文 :post 因得票數重新計算總共獲得 :amount 點 kudosu',
                            'reset' => '此貼文 :post 因得票數重新計算總共失去 :amount 點 kudosu',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '此貼文 :post 由 :giver 給予 :amount 點 kudosu',
                        'reset' => '此貼文 :post 的 kudosu 點數由 :giver 重新設定 ',
                        'revoke' => '此貼文 :post 已被 :giver 移除 kudosu 點數',
                    ],
                ],
            ],
            'me' => [
                'title' => '個人簡介',
            ],
            'medals' => [
                'empty' => "該使用者尚未獲得成就。;_;",
                'title' => '成就',
            ],
            'recent_activity' => [
                'title' => '最近活動',
            ],
            'top_ranks' => [
                'empty' => '尚未有好成績。 :(',
                'not_ranked' => '僅被列入排名的圖譜才能獲得 pp。',
                'pp' => ':amountpp',
                'title' => '排名',
                'weighted_pp' => '權重：:pp (:percentage)',

                'best' => [
                    'title' => '最佳成績',
                ],
                'first' => [
                    'title' => '第一名',
                ],
            ],
            'account_standing' => [
                'title' => '帳號狀態',
                'bad_standing' => "<strong>:username</strong> 的帳號存在不良紀錄 :(",
                'remaining_silence' => '<strong>:username</strong> 的禁言將在 :duration 解除',

                'recent_infringements' => [
                    'title' => '最近違規',
                    'date' => '時間',
                    'action' => '處理',
                    'length' => '時長',
                    'length_permanent' => '永久',
                    'description' => '詳情',
                    'actor' => '裁决者： :username',

                    'actions' => [
                        'restriction' => '封鎖',
                        'silence' => '禁言',
                        'note' => '備註',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => '興趣愛好',
            'lastfm' => 'Last.fm',
            'location' => '所在地',
            'occupation' => '職業',
            'skype' => 'Skype',
            'twitter' => '推特',
            'website' => '個人網站',
        ],
        'not_found' => [
            'reason_1' => '他可能已經更換了使用者名稱。',
            'reason_2' => '該帳號因安全或濫用問題故暫不開放。',
            'reason_3' => '您可能輸入錯誤！',
            'reason_header' => '可能是由以下幾個原因：',
            'title' => '找不到使用者',
        ],
        'page' => [
            'description' => '<strong>個人介紹</strong> 在您的個人簡介網頁可以自行修改。',
            'edit_big' => '編輯',
            'placeholder' => '在這裡編輯',
            'restriction_info' => "您必須是 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!贊助者</a> 以解鎖此功能.",
        ],
        'post_count' => [
            '_' => '發表 :link',
            'count' => ':count 篇貼文',
        ],
        'rank' => [
            'country' => ':mode 模式的國內排名',
            'global' => ':mode 模式的全球排名',
        ],
        'stats' => [
            'hit_accuracy' => '準確率',
            'level' => '等級 :level',
            'maximum_combo' => '最大連擊',
            'play_count' => '遊玩次數',
            'play_time' => '總遊玩時間',
            'ranked_score' => 'Ranked 圖譜總分',
            'replays_watched_by_others' => '重播觀看的次數',
            'score_ranks' => '得分等級',
            'total_hits' => '總命中次數',
            'total_score' => '總分',
        ],
    ],
    'status' => [
        'online' => '線上',
        'offline' => '離線',
    ],
    'store' => [
        'saved' => '帳號已註冊',
    ],
    'verify' => [
        'title' => '帳號驗證',
    ],
];
