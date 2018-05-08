<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'header' => [
            'subtitle' => '公認トーナメントのリストです。',
            'title' => 'コミュニティトーナメント',
        ],
        'none_running' => '現在開催中のトーナメントはないみたいです。また今度確認してみましょう！',
        'registration_period' => '参加登録期間： :start から :end',
    ],
    'show' => [
        'button' => [
            'register' => '登録申請する！',
            'cancel' => '登録をキャンセル',
        ],
        'entered' => 'このトーナメントへの参加登録は完了しています。<br><br>チームへの割り振りが完了しているとは限らないので注意。<br><br>トーナメントの詳細は開催日が近づくとメールに送られます。アカウントに登録されているEメールアドレスが有効であることを確認するのをお勧めします',
        'login_to_register' => '詳細を閲覧するには:loginが必要です',
        'not_yet_entered' => 'このトーナメントには参加登録していません。',
        'rank_too_low' => 'このトーナメントの参加登録に必要なランク条件を満たしていません！',
        'registration_ends' => '参加登録期間は:dateに終了します',
    ],
    'tournament_period' => ':start から :end',
];
