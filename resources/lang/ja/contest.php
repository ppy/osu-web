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
    'header' => [
        'small' => 'サークルをクリックする上手さ以外で競おう。',
        'large' => 'コミュニティコンテスト',
    ],
    'voting' => [
        'over' => 'このコンテストの投票期間は終了しました。',
        'login_required' => '投票するにはログインが必要です。',
        'best_of' => [
            'none_played' => "このコンテストに該当する譜面をプレイした事がない様です！",
        ],
    ],
    'entry' => [
        '_' => 'エントリー',
        'login_required' => 'エントリーするにはログインが必要です。',
        'silenced_or_restricted' => '制限中やサイレンス中はコンテストにエントリーすることはできません。',
        'preparation' => 'このコンテストは準備中です。しばらくお待ちください！',
        'over' => 'エントリーありがとうございます！このコンテストの提出は締め切られています。投票期間は間もなく始まります。',
        'limit_reached' => 'あなたはこのコンテストのエントリー上限を超えています。',
        'drop_here' => 'エントリーをここにドロップ！',
        'wrong_type' => [
            'art' => 'このコンテストは.jpgか.png拡張子のファイルしか受け付けていません。',
            'beatmap' => 'このコンテストは.osu拡張子のファイルしか受け付けていません。',
            'music' => 'このコンテストは.mp3拡張子のファイルしか受け付けていません。',
        ],
        'too_big' => 'このコンテストのエントリーの上限は:limitです。',
    ],
    'beatmaps' => [
        'download' => 'エントリーをダウンロード',
    ],
    'vote' => [
        'list' => '投票',
        'count' => ':count票',
    ],
    'dates' => [
        'ended' => '開始日 :date',

        'starts' => [
            '_' => '終了日 :date',
            'soon' => '間もなく™',
        ],
    ],
    'states' => [
        'entry' => 'エントリー受付中',
        'voting' => '投票期間中',
        'results' => '結果発表',
    ],
];
