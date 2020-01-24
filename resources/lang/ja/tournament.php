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
