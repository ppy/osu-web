<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'osu!の注目アーティスト',
    'title' => '注目アーティスト',

    'admin' => [
        'hidden' => 'アーティストは現在非表示にされています',
    ],

    'beatmaps' => [
        '_' => 'ビートマップ',
        'download' => 'ビートマップのテンプレートをダウンロード ',
        'download-na' => 'ビートマップのテンプレートはまだ用意されていません',
    ],

    'index' => [
        'description' => '注目アーティストは私達とコラボレーションしているアーティストで、新しいオリジナル楽曲を提供しています。注目アーティストと提供されたオリジナル楽曲は、楽曲が素晴らしく、ビートマップに適しているとしてosu! teamに選ばれました。注目アーティストの中にはosu!限定の楽曲を提供しているアーティストも存在します。<br><br>ここにある全ての楽曲はタイミングが設定された.oszファイルとして提供されており、正式にosu!とosu!関連コンテンツで使用が許可されています。',
    ],

    'links' => [
        'beatmaps' => 'osu!ビートマップ',
        'osu' => 'osu! プロフィール',
        'site' => '公式ウェブサイト',
    ],

    'songs' => [
        '_' => '楽曲一覧',
        'count' => ':count_delimited 曲',
        'original' => 'osu!オリジナル',
        'original_badge' => 'オリジナル',
    ],

    'tracklist' => [
        'title' => '曲名',
        'length' => '長さ',
        'bpm' => 'bpm',
        'genre' => 'ジャンル',
    ],

    'tracks' => [
        'index' => [
            '_' => 'トラック検索',

            'form' => [
                'advanced' => '高度な検索',
                'album' => 'アルバム',
                'artist' => 'アーティスト',
                'bpm_gte' => '最低BPM',
                'bpm_lte' => '最高BPM',
                'empty' => '条件に当てはまるトラックが見つかりませんでした。',
                'genre' => 'ジャンル',
                'genre_all' => '全て',
                'length_gte' => '最短の再生時間',
                'length_lte' => '最長の再生時間',
            ],
        ],
    ],
];
