<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'このビートマップは現在ダウンロード不可能です。',
        'parts-removed' => '権利者の申し立てによりこのビートマップは部分的に削除されています。',
        'more-info' => '詳細はこちらです。',
    ],

    'index' => [
        'title' => 'ビートマップリスト',
        'guest_title' => 'ビートマップ',
    ],

    'panel' => [
        'download' => [
            'all' => 'ダウンロード',
            'video' => '動画付きでダウンロード',
            'no_video' => '動画無しでダウンロード',
            'direct' => 'osu!directで開く',
        ],
    ],

    'show' => [
        'discussion' => 'ディスカッション',

        'details' => [
            'favourite' => 'ビートマップセットをお気に入りに追加する',
            'logged-out' => 'ビートマップをダウンロードするにはログインが必要です！',
            'mapped_by' => '作者 :mapper',
            'unfavourite' => 'ビートマップをお気に入りから外す',
            'updated_timeago' => '最終更新 :timeago',

            'download' => [
                '_' => 'ダウンロード',
                'direct' => 'osu!direct',
                'no-video' => '動画なし',
                'video' => '動画あり',
            ],

            'login_required' => [
                'bottom' => 'より多くの機能にアクセスする',
                'top' => 'ログイン',
            ],
        ],

        'details_date' => [
            'approved' => 'approved :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'qualified :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => '投稿 :timeago',
            'updated' => '最終更新 :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'お気に入りのビートマップが多すぎます！お気に入りを外してから再試行してください。',
        ],

        'hype' => [
            'action' => 'もしこのビートマップが良かった場合、Hypeすることでビートマップのステータスが<strong>Ranked</strong>状態になります。',

            'current' => [
                '_' => 'このビートマップは現在:statusです。',

                'status' => [
                    'pending' => 'Pending',
                    'qualified' => 'Qualified',
                    'wip' => '作業中',
                ],
            ],

            'disqualify' => [
                '_' => 'このビートマップで問題が見つかった場合は、Disqualifyにしてください。:link',
            ],

            'report' => [
                '_' => 'ビートマップに問題を見つけた場合、:link からチームに報告してください。',
                'button' => '問題を報告する',
                'link' => 'ここ',
            ],
        ],

        'info' => [
            'description' => '概要',
            'genre' => 'ジャンル',
            'language' => '言語',
            'no_scores' => 'データはまだ計算中です・・・',
            'points-of-failure' => '失敗地点',
            'source' => 'ソース',
            'success-rate' => 'クリア率',
            'tags' => 'タグ',
        ],

        'scoreboard' => [
            'achieved' => '達成日 :when',
            'country' => '国別ランキング',
            'friend' => 'フレンドランキング',
            'global' => '世界ランキング',
            'supporter-link' => '<a href=":link">ここ</a>をクリックする事でosu!サポーターの詳細が見れます。',
            'supporter-only' => 'フレンドランキングと国別ランキングを利用するにはosu!サポータータグが必要です！',
            'title' => 'スコアボード',

            'headers' => [
                'accuracy' => '精度',
                'combo' => '最大コンボ',
                'miss' => 'ミス',
                'mods' => 'Mods',
                'player' => 'プレイヤー',
                'pp' => 'pp',
                'rank' => '順位',
                'score_total' => '合計スコア',
                'score' => 'スコア',
                'time' => '時間',
            ],

            'no_scores' => [
                'country' => 'あなたの国のプレイヤーで記録を作った人はまだいません！',
                'friend' => 'あなたのフレンドで記録を作った人はまだいません！',
                'global' => 'まだ記録はありません。一番乗りを目指そう！',
                'loading' => 'スコアの読み込み中・・・',
                'unranked' => 'Unrankedのビートマップです。',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'あなたのベスト',
            ],
        ],

        'stats' => [
            'cs' => 'サークルサイズ',
            'cs-mania' => 'キー数',
            'drain' => 'HPの厳しさ',
            'accuracy' => '精度',
            'ar' => 'アプローチ速度',
            'stars' => '難易度（★）',
            'total_length' => '長さ',
            'bpm' => 'BPM',
            'count_circles' => 'サークルの数',
            'count_sliders' => 'スライダーの数',
            'user-rating' => 'ユーザーの評価',
            'rating-spread' => '評価分布',
            'nominations' => 'ノミネーション',
            'playcount' => 'プレイ数',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],
];
