<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'availability' => [
        'disabled' => 'このビートマップは現在ダウンロード不可能です。',
        'parts-removed' => '権利者の申し立てによりこのビートマップは部分的に削除されています。',
        'more-info' => '詳細はこちらです。',
    ],

    'index' => [
        'title' => 'ビートマップリスト',
        'guest_title' => 'ビートマップ',
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
                'button_title' => 'Qualifiedビートマップを無効',
            ],

            'report' => [
                '_' => 'ビートマップに問題を見つけた場合、:link からチームに報告してください。',
                'button' => '問題を報告する',
                'button_title' => 'Qualifiedビートマップの問題を報告。',
                'link' => 'ここ',
            ],
        ],

        'info' => [
            'description' => '概要',
            'genre' => 'ジャンル',
            'language' => '言語',
            'no_scores' => 'データはまだ現在計算中です・・・',
            'points-of-failure' => 'Fail地点',
            'source' => 'ソース',
            'success-rate' => 'クリア率',
            'tags' => 'タグ',
            'unranked' => 'Unrankedビートマップ',
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
            'accuracy' => '判定の厳しさ',
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
