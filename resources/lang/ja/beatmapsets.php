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
    'availability' => [
        'disabled' => 'この譜面は現在ダウンロード不可能です。',
        'parts-removed' => '権利者の申し立てによりこの譜面は部分的に削除されています。',
        'more-info' => '詳細はこちらです。',
    ],

    'index' => [
        'title' => '譜面リスト',
        'guest_title' => '譜面',
    ],

    'show' => [
        'discussion' => 'ディスカッション',

        'details' => [
            'mapped_by' => '作者 :mapper',
            'submitted' => '投稿日 ',
            'updated' => '最後の更新 ',
            'updated_timeago' => '最終更新時刻: :timeago',
            'ranked' => 'ranked日時 ',
            'approved' => 'approved日時 ',
            'qualified' => 'qualified日時 ',
            'loved' => 'loved日時 ',
            'logged-out' => '譜面をダウンロードするにはログインが必要です！',
            'download' => [
                '_' => 'ダウンロード',
                'video' => '動画あり',
                'no-video' => '動画なし',
                'direct' => 'osu!direct',
            ],
            'favourite' => '譜面をお気に入りに追加する',
            'unfavourite' => '譜面をお気に入りから外す',
            'favourited_count' => '+ そのほか:count人！',
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
        'info' => [
            'description' => '説明文',
            'genre' => 'ジャンル',
            'language' => '言語',
            'no_scores' => 'データはまだ現在計算中です・・・',
            'points-of-failure' => 'Fail地点',
            'source' => 'ソース',
            'success-rate' => 'クリア率',
            'tags' => 'タグ',
            'unranked' => 'Unranked譜面',
        ],
        'scoreboard' => [
            'achieved' => '達成日 :when',
            'country' => '国別ランキング',
            'friend' => 'フレンドランキング',
            'global' => '世界ランキング',
            'supporter-link' => '<a href=":link">ここ</a>をクリックする事でサポーターの詳細が見れます。',
            'supporter-only' => 'フレンドランキングと国別ランキングを利用するにはサポータータグが必要です！',
            'title' => 'スコアボード',

            'headers' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Player',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Total Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'あなたの国からのプレイヤーで記録を作った人はまだいません！',
                'friend' => 'あなたのフレンドで記録を作った人はまだいません!',
                'global' => 'まだ記録はありません。一番乗りを目指そう！',
                'loading' => 'スコアの読み込み中・・・',
                'unranked' => 'Unranked譜面です。',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'Your Best',
            ],
        ],
    ],
];
