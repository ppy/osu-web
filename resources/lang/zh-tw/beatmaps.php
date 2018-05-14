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
            'error' => '保存失敗',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '更新投票失敗',
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
        'message_placeholder' => '在此處輸入您的內容',
        'message_placeholder_deleted_beatmap' => '該難度已被刪除，無法繼續討論',
        'message_type_select' => '選擇回覆類型',
        'reply_notice' => '按下回車以提交',
        'reply_placeholder' => '在此處輸入您的回覆',
        'require-login' => '登錄以繼續',
        'resolved' => '已解決',
        'restore' => '已修復',
        'title' => '討論',

        'collapse' => [
            'all-collapse' => '全部摺疊',
            'all-expand' => '全部展開',
        ],

        'empty' => [
            'empty' => '還沒有討論！',
            'hidden' => '沒有符合過濾條件的討論。',
        ],

        'message_hint' => [
            'in_general' => '這個信息將提交到整個譜面討論中。如果需要單獨針對某處，請在開頭使用時間戳 (例如: 00:12:345)。',
            'in_timeline' => '需要 Mod 多處，請在每一個時間戳後寫下意見並發表。',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '推薦！',
            'mapper_note' => '備註',
            'nomination_reset' => '重置提名',
            'praise' => '讚',
            'problem' => '問題',
            'suggestion' => '建議',
        ],

        'mode' => [
            'events' => '歷史',
            'general' => '一般',
            'timeline' => '時間線',
            'scopes' => [
                'general' => '当前难度',
                'generalAll' => '全难度',
            ],
        ],

        'new' => [
            'timestamp' => '時間戳',
            'timestamp_missing' => '在編輯模式下按 Ctrl+C 然後在您的輸入框中粘貼以添加時間戳！',
            'title' => '新的討論',
        ],

        'show' => [
            'title' => '由 :mapper 製作的 :title',
        ],

        'sort' => [
            '_' => '排序：',
            'created_at' => '創建時間',
            'timeline' => '時間軸',
            'updated_at' => '最後更新時間',
        ],

        'stats' => [
            'deleted' => '已刪除',
            'mapper_notes' => '備註',
            'mine' => '我的',
            'pending' => '',
            'praises' => '讚',
            'resolved' => '已解決',
            'total' => '所有',
        ],

        'status-messages' => [
            'approved' => '這張譜面於 :date 被 Approved !',
            'graveyard' => "這張譜面自 :date 就未更新了，或許它已經被作者拋棄了 ;w;",
            'loved' => '這張譜面於 :date 被 Loved !',
            'ranked' => '這張譜面於 :date 被 Ranked !',
            'wip' => '注意：這張譜面被作者標記為 WIP（work-in-progress）',
        ],

    ],

    'hype' => [
        'button' => '推薦譜面！',
        'button_done' => '已經推薦！',
        'confirm' => "你確定嗎？這將會使用你剩下的 :n 次推薦次數並且無法撤銷。",
        'explanation' => '推薦這張譜面讓它更容易被提名然後 ranked ！',
        'explanation_guest' => '登錄並推薦這張譜面讓它更容易被提名然後 ranked ！',
        'new_time' => "你將在 :new_time 後獲得新的推薦次數。",
        'remaining' => '你還可以推薦 :remaining 次。',
        'required_text' => '推薦進度： :current/:required',
        'section_title' => '推薦進度',
        'title' => '推薦',
    ],

    'feedback' => [
        'button' => '留下建议',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Disqualified 的理由？',
        'disqualified_at' => '於 :time_ago 被 Disqualified（:reason）。',
        'disqualified_no_reason' => '沒有指定原因',
        'disqualify' => '',
        'incorrect_state' => '操作出錯了，請刷新頁面。',
        'nominate' => '提名',
        'nominate_confirm' => '提名這張譜面？',
        'nominated_by' => '被 :users 提名',
        'qualified' => '如果沒有問題，預計將於 :date 被 Ranked 。',
        'qualified_soon' => '如果沒有問題，預計不久將被 Ranked 。',
        'required_text' => '提名數: :current/:required',
        'reset_message_deleted' => '已删除',
        'title' => '提名狀態',
        'unresolved_issues' => '仍然有需解決的問題 。',

        'reset_at' => [
            'nomination_reset' => '提名於 :time_ago 被新問題 :discussion 重置。',
            'disqualify' => ':time_ago 被 :user 因为新问题 :discussion (:message) 而 DQ.',
        ],

        'reset_confirm' => [
            'nomination_reset' => '你確定嗎？提出新的問題會重置提名。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '輸入關鍵字...',
            'options' => '更多搜索選項',
            'not-found' => '沒有結果',
            'not-found-quote' => '呃，什麼也沒有...',
            'filters' => [
                'general' => '常规',
                'mode' => '模式',
                'status' => 'Rank 狀態',
                'genre' => '流派',
                'language' => '語言',
                'extra' => '額外',
                'rank' => '已 Rank',
                'played' => '玩过',
            ],
        ],
        'mode' => '模式',
        'status' => 'Rank 狀態',
        'mapped-by' => '作者: :mapper',
        'source' => '來自 :source',
        'load-more' => '加載更多...',
    ],
    'general' => [
        'recommended' => '推荐难度',
        'converts' => '包括转谱',
    ],
    'mode' => [
        'any' => '所有',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '所有',
        'ranked-approved' => '',
        'approved' => '',
        'qualified' => '',
        'loved' => '',
        'faves' => '',
        'pending' => '',
        'graveyard' => '',
        'my-maps' => '我的',
    ],
    'genre' => [
        'any' => '所有',
        'unspecified' => '尚未指定',
        'video-game' => '電子遊戲',
        'anime' => '動漫',
        'rock' => '搖滾',
        'pop' => '流行樂',
        'other' => '其他',
        'novelty' => '新奇',
        'hip-hop' => '嘻哈',
        'electronic' => '電子',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
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
        'instrumental' => '器樂',
        'other' => '其他',
    ],
    'played' => [
        'any' => '任意',
        'played' => '玩过',
        'unplayed' => '没玩过',
    ],
    'extra' => [
        'video' => '有視頻',
        'storyboard' => '有 Storyboard',
    ],
    'rank' => [
        'any' => '任意',
        'XH' => '白銀 SS',
        'X' => '',
        'SH' => '白銀 S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
];
