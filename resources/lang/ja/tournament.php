<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'none_running' => '現在開催中のトーナメントはありません。また今度確認してみましょう！',
        'registration_period' => '参加登録期間: :start から :end',

        'header' => [
            'title' => 'コミュニティトーナメント',
        ],

        'item' => [
            'registered' => '登録済みプレイヤー',
        ],

        'state' => [
            'current' => '現在行われているトーナメント',
            'previous' => '過去のトーナメント',
        ],
    ],

    'show' => [
        'banner' => 'チームを応援する',
        'entered' => 'このトーナメントへの参加登録は完了しています。<br><br>これによって出場メンバーになれたわけでは <b>ない</b>のでご注意ください。<br><br>トーナメントの詳細は開催日に近づくとメールに送信されます。osu!アカウントに登録されているメールアドレスが有効なメールアドレスであるか確認して下さい！',
        'info_page' => '詳細ページ',
        'login_to_register' => '詳細を見るには:loginして下さい！',
        'not_yet_entered' => 'このトーナメントには参加登録していません。',
        'rank_too_low' => '申し訳ありませんが、このトーナメントのランク要件を満たしていません！',
        'registration_ends' => '参加登録期間は:dateに終了します',

        'button' => [
            'cancel' => '登録をキャンセル',
            'register' => '登録申請する！',
        ],

        'period' => [
            'end' => '終了',
            'start' => '開始',
        ],

        'state' => [
            'before_registration' => 'このトーナメントの参加受付はまだ開始していません。',
            'ended' => 'このトーナメントは終了しました。詳細ページで結果を確認できます。',
            'registration_closed' => 'このトーナメントの参加受付は終了しました。詳細ページで最新の情報を確認してください。',
            'running' => 'このトーナメントは現在進行中です。詳細ページで更なる情報を確認できます。',
        ],
    ],
    'tournament_period' => ':start から :end',
];
