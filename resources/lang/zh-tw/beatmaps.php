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
            'error' => '儲存失敗',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '投票更新失敗',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '給予 kudosu',
        'delete' => '刪除',
        'deleted' => '被 :editor 於 :delete_time 刪除。',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '編輯',
        'edited' => '最後由 :editor 編輯於 :update_time 。',
        'kudosu_denied' => 'kudosu 被收回',
        'message_placeholder_deleted_beatmap' => '該難度已被刪除，無法繼續討論',
        'message_type_select' => '選擇回覆類型',
        'reply_notice' => '按下 Enter 以回覆',
        'reply_placeholder' => '在此處輸入您的回覆',
        'require-login' => '回覆前請先登入。',
        'resolved' => '已解決',
        'restore' => '已修復',
        'title' => '討論區',

        'collapse' => [
            'all-collapse' => '收回全部',
            'all-expand' => '展開全部',
        ],

        'empty' => [
            'empty' => '還沒有討論！',
            'hidden' => '沒有符合過濾條件的討論。',
        ],

        'message_hint' => [
            'in_general' => '這篇貼文將發佈到圖譜討論區中。如需要檢查此圖譜某個特定部分，請在開頭加入時間戳 (例如: 00:12:345)。',
            'in_timeline' => '每篇貼文僅加入一個時間戳，如需要檢查多個時間戳，請將時間戳分別發佈至不同貼文，並寫下發表意見。',
        ],

        'message_placeholder' => [
            'general' => '在此處輸入以發佈至整體 (:version)',
            'generalAll' => '在此處輸入以發佈至整體 (所有難度)',
            'timeline' => '在此處輸入以發佈至時間線 (:version)',
        ],

        'message_type' => [
            'disqualify' => '取消提名',
            'hype' => '推薦！',
            'mapper_note' => '備註',
            'nomination_reset' => '重置提名',
            'praise' => '讚',
            'problem' => '問題',
            'suggestion' => '建議',
        ],

        'mode' => [
            'events' => '歷史',
            'general' => '整體:scope',
            'timeline' => '時間線',
            'scopes' => [
                'general' => '目前難度',
                'generalAll' => '所有難度',
            ],
        ],

        'new' => [
            'timestamp' => '時間戳',
            'timestamp_missing' => '在編輯模式下按 Ctrl+C 並至您輸入的對話框中按 Ctrl+V 以加入時間戳！',
            'title' => '新的討論',
        ],

        'show' => [
            'title' => '由 :mapper 製作的 :title',
        ],

        'sort' => [
            '_' => '排序：',
            'created_at' => '建立時間',
            'timeline' => '時間軸',
            'updated_at' => '最後更新時間',
        ],

        'stats' => [
            'deleted' => '已刪除',
            'mapper_notes' => '備註',
            'mine' => '我的',
            'pending' => '未解決',
            'praises' => '表揚',
            'resolved' => '已解決',
            'total' => '全部',
        ],

        'status-messages' => [
            'approved' => '這張圖譜於 :date 被批准!',
            'graveyard' => "這張圖譜自 :date 就未更新了，或許它已經被作者拋棄了 ;w;",
            'loved' => '這張圖譜於 :date 被 Loved !',
            'ranked' => '這張圖譜於 :date 被進榜了!',
            'wip' => '注意：這張圖譜被作者標記為 WIP（半成品）',
        ],

    ],

    'hype' => [
        'button' => '推薦圖譜！',
        'button_done' => '已經推薦！',
        'confirm' => "你確定嗎？這將會使用你剩下的 :n 次推薦次數並且無法撤銷。",
        'explanation' => '推薦這張圖譜讓它更容易被提名然後 ranked ！',
        'explanation_guest' => '登入並推薦這張圖譜讓它更容易被提名然後 ranked ！',
        'new_time' => "你將在 :new_time 後獲得新的推薦次數。",
        'remaining' => '你還可以推薦 :remaining 次。',
        'required_text' => '推薦進度： :current/:required',
        'section_title' => '推薦進度',
        'title' => '推薦',
    ],

    'feedback' => [
        'button' => '留下建議',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Disqualified 的理由？',
        'disqualified_at' => '於 :time_ago 被 Disqualified（:reason）。',
        'disqualified_no_reason' => '沒有任何原因',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '操作發生錯誤，請重新載入頁面。',
        'love' => '',
        'love_confirm' => '',
        'nominate' => '提名',
        'nominate_confirm' => '確定要提名這張圖譜？',
        'nominated_by' => '被 :users 提名',
        'qualified' => '如果沒有問題，預計將於 :date 被 Ranked 。',
        'qualified_soon' => '如果沒有問題，預計不久將被 Ranked 。',
        'required_text' => '提名數: :current/:required',
        'reset_message_deleted' => '已刪除',
        'title' => '提名狀態',
        'unresolved_issues' => '仍然有需解決的問題 。',

        'reset_at' => [
            'nomination_reset' => '提名於 :time_ago 被新問題 :discussion 重置。',
            'disqualify' => ':time_ago  :user 因新问题 :discussion (:message) 而被 DQ.',
        ],

        'reset_confirm' => [
            'nomination_reset' => '你確定嗎？提出新的問題會重置提名。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '輸入關鍵字...',
            'login_required' => '登入以搜尋。',
            'options' => '更多搜尋選項',
            'supporter_filter' => '',
            'not-found' => '沒有結果',
            'not-found-quote' => '姆....，什麼也沒有。',
            'filters' => [
                'general' => '一般',
                'mode' => '模式',
                'status' => '',
                'genre' => '曲風',
                'language' => '語言',
                'extra' => '其他資訊',
                'rank' => '已 Rank',
                'played' => '玩過',
            ],
            'sorting' => [
                'title' => '標題',
                'artist' => '作曲者',
                'difficulty' => '困難度',
                'updated' => '更新時間',
                'ranked' => '排名',
                'rating' => '評分',
                'plays' => '遊玩次數',
                'relevance' => '相關性',
                'nominations' => '提名狀態',
            ],
            'supporter_filter_quote' => [
                '_' => '按 :filters 篩選需先成為 :link',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'recommended' => '推薦難度',
        'converts' => '包括转谱',
    ],
    'mode' => [
        'any' => '所有',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => '所有',
        'ranked-approved' => '進榜/批准',
        'approved' => '批准',
        'qualified' => '提名',
        'loved' => 'Loved',
        'faves' => '我的最愛',
        'pending' => '',
        'graveyard' => '拋棄',
        'my-maps' => '我的圖譜',
    ],
    'genre' => [
        'any' => '所有',
        'unspecified' => '未指定',
        'video-game' => '電子遊戲',
        'anime' => '動漫',
        'rock' => '搖滾',
        'pop' => '流行樂',
        'other' => '其他',
        'novelty' => '新奇',
        'hip-hop' => '嘻哈',
        'electronic' => '電音',
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
        'TD' => '觸控螢幕',
    ],
    'language' => [
        'any' => '所有',
        'english' => '英語',
        'chinese' => '漢語',
        'french' => '法語',
        'german' => '德語',
        'italian' => '意大利語',
        'japanese' => '日語',
        'korean' => '韓語',
        'spanish' => '西班牙語',
        'swedish' => '瑞典語',
        'instrumental' => '樂器演奏',
        'other' => '其他',
    ],
    'played' => [
        'any' => '所有',
        'played' => '玩過',
        'unplayed' => '未曾玩過',
    ],
    'extra' => [
        'video' => '有影像',
        'storyboard' => '有 Storyboard',
    ],
    'rank' => [
        'any' => '所有',
        'XH' => '白銀 SS',
        'X' => 'SS',
        'SH' => '白銀 S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
