<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => '該圖譜現在無法下載。',
        'parts-removed' => '因作者或第三方版權擁有者的要求，故該圖譜已經下架。',
        'more-info' => '點擊這裡查看更多資訊。',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'index' => [
        'title' => '圖譜列表',
        'guest_title' => '圖譜',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => '下載',
            'video' => '下載並包含影片',
            'no_video' => '下載並不包含影片',
            'direct' => '在osu!direct中查看',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => '討論',

        'details' => [
            'favourite' => '收藏這張圖譜',
            'logged-out' => '下載圖譜前請先登入！',
            'mapped_by' => '由 :mapper 製作',
            'unfavourite' => '取消收藏',
            'updated_timeago' => '最後更新時間 :timeago',

            'download' => [
                '_' => '下載',
                'direct' => '',
                'no-video' => '不含影像',
                'video' => '含影像',
            ],

            'login_required' => [
                'bottom' => '以使用更多的功能',
                'top' => '登入',
            ],
        ],

        'details_date' => [
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'ranked' => '於:timeago進榜',
            'submitted' => '於:timeago提交',
            'updated' => '上次更新於:timeago',
        ],

        'favourites' => [
            'limit_reached' => '您收藏的圖譜已達上限，請取消一張再試。',
        ],

        'hype' => [
            'action' => '推薦這個圖譜如果你喜歡玩它來幫助它進度至 <strong>進榜</strong> 狀態。',

            'current' => [
                '_' => '此地圖目前是 :status 的。',

                'status' => [
                    'pending' => '待處理',
                    'qualified' => '已提名',
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
            'no_scores' => '資料還在計算中。。。',
            'nsfw' => '',
            'points-of-failure' => '失敗位置',
            'source' => '來源',
            'success-rate' => '成功率',
            'tags' => '標籤',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => '',
            ],
        ],

        'scoreboard' => [
            'achieved' => '在 :when 達成',
            'country' => '國內排行榜',
            'friend' => '好友排行榜',
            'global' => '世界排行榜',
            'supporter-link' => '點擊 <a href=":link">這裡</a> 來查看你可以得到的精彩功能！',
            'supporter-only' => '你需要成為贊助者才能查看國內與好友排名！',
            'title' => '排行榜',

            'headers' => [
                'accuracy' => '準確率',
                'combo' => '最大連擊',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => '玩家',
                'pp' => '',
                'rank' => '排行榜',
                'score_total' => '總分',
                'score' => '得分',
                'time' => '時間',
            ],

            'no_scores' => [
                'country' => '您的所在地玩家尚未上傳成績！',
                'friend' => '您的好友尚未上傳成績！',
                'global' => '沒有任何玩家上傳過成績，來挑戰嗎？',
                'loading' => '加載分數中...',
                'unranked' => '未進榜圖譜',
            ],
            'score' => [
                'first' => '領先者',
                'own' => '您的最佳成績',
            ],
        ],

        'stats' => [
            'cs' => '縮圈大小',
            'cs-mania' => '鍵位數量',
            'drain' => '扣血速度',
            'accuracy' => '準確率',
            'ar' => '縮圈速度',
            'stars' => '難度星級',
            'total_length' => '長度',
            'bpm' => 'BPM',
            'count_circles' => '圓圈總數',
            'count_sliders' => '滑條總數',
            'user-rating' => '玩家評價',
            'rating-spread' => '評分情況',
            'nominations' => '提名',
            'playcount' => '遊玩次数',
        ],

        'status' => [
            'ranked' => '已進榜',
            'approved' => '已核準',
            'loved' => 'Loved',
            'qualified' => '已提名',
            'wip' => '製作中',
            'pending' => '待處理',
            'graveyard' => '拋棄',
        ],
    ],
];
