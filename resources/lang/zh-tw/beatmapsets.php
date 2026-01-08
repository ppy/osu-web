<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => '該圖譜現在無法下載。',
        'parts-removed' => '因作者或第三方版權擁有者的要求，故該圖譜已經下架。',
        'more-info' => '按這裡查看更多資訊。',
        'rule_violation' => '這個地圖中包含的一些素材，在被評估為不適合在 osu! 中使用後已移除。',
    ],

    'cover' => [
        'deleted' => '已刪除圖譜',
    ],

    'download' => [
        'limit_exceeded' => '欲速則不達。',
        'no_mirrors' => '沒有可用的下載伺服器。',
    ],

    'featured_artist_badge' => [
        'label' => '精選藝術家',
    ],

    'index' => [
        'title' => '圖譜清單',
        'guest_title' => '圖譜',
    ],

    'panel' => [
        'empty' => '沒有圖譜',

        'download' => [
            'all' => '下載',
            'video' => '下載並包含影片',
            'no_video' => '下載並不包含影片',
            'direct' => '在 osu!direct 中查看',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => '見習提名者無法提名多個規則集的圖譜。',
        'full_nomination_required' => '你必須是完整的提名者才能執行遊戲模式的最終提名。',
        'hybrid_requires_modes' => '包含多個遊戲模式的圖譜至少需要選擇一種遊戲模式進行提名。',
        'incorrect_mode' => '您沒有權限為 :mode 模式提名',
        'invalid_limited_nomination' => '這張圖譜有無效的提名而且無法在這個階段被檢驗。',
        'invalid_ruleset' => '這個提名含有無效的遊戲模式。',
        'too_many' => '提名需求已達成。',
        'too_many_non_main_ruleset' => '非主要遊戲模式的提名需求已經被實現了。',

        'dialog' => [
            'confirmation' => '您確定要提名這張圖譜嗎？',
            'different_nominator_warning' => '以其他提名者的身分提名這張圖譜會重設提名順序。',
            'header' => '提名圖譜',
            'hybrid_warning' => '注意: 您只能提名一次，所以請確保您的提名包含所有您想提名的模式。',
            'current_main_ruleset' => '目前遊戲模式為: :ruleset',
            'which_modes' => '您想為哪個模式提名？',
        ],
    ],

    'nsfw_badge' => [
        'label' => '成人內容',
    ],

    'show' => [
        'discussion' => '討論',

        'admin' => [
            'full_size_cover' => '檢視完整封面圖片',
            'page' => '檢視管理頁面',
        ],

        'deleted_banner' => [
            'title' => '此圖譜已被刪除。',
            'message' => '(僅審核者可見)',
        ],

        'details' => [
            'by_artist' => '作者：:artist',
            'favourite' => '收藏這張圖譜',
            'favourite_login' => '登入後才能把這張圖譜加到最愛',
            'logged-out' => '下載圖譜前請先登入！',
            'mapped_by' => '由 :mapper 製作',
            'mapped_by_guest' => '由 :mapper 製作的客串難度',
            'unfavourite' => '取消收藏',
            'updated_timeago' => '最後更新時間 :timeago',

            'download' => [
                '_' => '下載',
                'direct' => '',
                'no-video' => '不含影片',
                'video' => '含影片',
            ],

            'login_required' => [
                'bottom' => '以使用更多的功能',
                'top' => '登入',
            ],
        ],

        'details_date' => [
            'approved' => '於 :timeago 核准',
            'loved' => '於 :timeago 被加入至社群喜愛',
            'qualified' => '於 :timeago 列為合格圖譜',
            'ranked' => '於 :timeago 進榜',
            'submitted' => '於 :timeago 提交',
            'updated' => '上次更新於:timeago',
        ],

        'favourites' => [
            'limit_reached' => '您收藏的圖譜已達上限，請取消收藏一些再試。',
        ],

        'hype' => [
            'action' => '如果你喜歡這張圖譜，請推薦它來幫助它進展至<strong>進榜</strong>狀態。',

            'current' => [
                '_' => '此圖譜目前為 :status。',

                'status' => [
                    'pending' => '等待中',
                    'qualified' => '已合格',
                    'wip' => '製作中',
                ],
            ],

            'disqualify' => [
                '_' => '如果你認為此圖譜有問題，可將之取消提名：:link',
            ],

            'report' => [
                '_' => '如果您發現此圖譜有問題，請在 :link 通知團隊。',
                'button' => '回報問題',
                'link' => '這裡',
            ],
        ],

        'info' => [
            'description' => '詳情',
            'genre' => '曲風',
            'language' => '語言',
            'mapper_tags' => '譜師標籤',
            'no_scores' => '資料還在計算中...',
            'nominators' => '提名者',
            'nsfw' => '成人內容',
            'offset' => '線上偏移調整',
            'points-of-failure' => '失敗位置',
            'source' => '來源',
            'storyboard' => '這張圖譜包含 Storyboard',
            'success-rate' => '成功率',
            'user_tags' => '玩家標籤',
            'video' => '此圖譜包含背景影片',
        ],

        'nsfw_warning' => [
            'details' => '這張圖譜含有兒童不宜、具冒犯性、或令人不安的內容。您確定要查看嗎？',
            'title' => '成人內容',

            'buttons' => [
                'disable' => '關閉警告',
                'listing' => '圖譜清單',
                'show' => '顯示',
            ],
        ],

        'scoreboard' => [
            'achieved' => '在 :when 達成',
            'country' => '國內排行榜',
            'error' => '無法載入排行榜',
            'friend' => '好友排名',
            'global' => '全球排名',
            'supporter-link' => '按<a href=":link">這裡</a>來查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成為贊助者才能查看國內與好友排名！',
            'team' => '隊伍排名',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '準確率',
                'combo' => '最大連擊',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'pin' => '置頂',
                'player' => '玩家',
                'pp' => '',
                'rank' => '排行榜',
                'score' => '得分',
                'score_total' => '總分',
                'time' => '時間',
            ],

            'no_scores' => [
                'country' => '您的所在地玩家尚未上傳成績！',
                'friend' => '您的好友尚未上傳成績！',
                'global' => '沒有任何玩家上傳過成績，來挑戰嗎？',
                'loading' => '正在載入分數...',
                'team' => '您的隊員尚未在此圖譜上傳任何分數！',
                'unranked' => 'Unranked 譜面',
            ],
            'score' => [
                'first' => '領先者',
                'own' => '您的最佳成績',
            ],
            'supporter_link' => [
                '_' => '按:here查看您能得到的精彩功能！',
                'here' => '這裡',
            ],
        ],

        'stats' => [
            'cs' => '圓圈大小',
            'cs-mania' => '鍵位數量',
            'drain' => '扣血速度',
            'accuracy' => '準確率',
            'ar' => '縮圈速度',
            'stars' => '難度星級',
            'total_length' => '長度',
            'bpm' => 'BPM',
            'count_circles' => '圓圈總數',
            'count_sliders' => '滑條總數',
            'offset' => '線上偏移調整：:offset',
            'user-rating' => '玩家評價',
            'rating-spread' => '評分狀況',
            'nominations' => '提名',
            'playcount' => '遊玩次數',
            'favourites' => '',
            'no_favourites' => '',
        ],

        'status' => [
            'ranked' => '已進榜',
            'approved' => '已核准',
            'loved' => '社群喜愛',
            'qualified' => '已合格',
            'wip' => '製作中',
            'pending' => '待處理',
            'graveyard' => '閒置',
        ],
    ],

    'spotlight_badge' => [
        'label' => '聚光燈',
    ],
];
