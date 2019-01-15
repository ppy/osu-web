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
    'match' => [
        'beatmap-deleted' => '削除済み譜面',
        'difference' => ':difference点差',
        'failed' => 'FAILED',
        'header' => 'マルチ部屋',
        'in-progress' => '（試合進行中）',
        'in_progress_spinner_label' => '試合進行中',
        'loading-events' => 'イベント読み込み中・・・',
        'winner' => ':teamの勝利',

        'events' => [
            'player-left' => ':userが退室しました',
            'player-joined' => ':userが入室しました',
            'player-kicked' => ':userが部屋から追放されました',
            'match-created' => ':userが部屋を作成しました',
            'match-disbanded' => '部屋が解散しました',
            'host-changed' => ':userがホストになりました',

            'player-left-no-user' => 'プレイヤーが退室しました',
            'player-joined-no-user' => 'プレイヤーが入室しました',
            'player-kicked-no-user' => 'プレイヤーが追放されました',
            'match-created-no-user' => '部屋が作成されました',
            'match-disbanded-no-user' => '部屋が解散されました',
            'host-changed-no-user' => 'ホストが変更されました',
        ],

        'score' => [
            'stats' => [
                'accuracy' => '精度(Accuracy)',
                'combo' => 'コンボ',
                'score' => 'スコア',
            ],
        ],

        'team-types' => [
            'head-to-head' => '個人戦',
            'tag-coop' => '協力モード',
            'team-vs' => 'チーム戦',
            'tag-team-vs' => 'タッグチーム戦',
        ],

        'teams' => [
            'blue' => 'Blueチーム',
            'red' => 'Redチーム',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => '最高スコア',
            'accuracy' => '最高精度',
            'combo' => '最高コンボ',
            'scorev2' => 'スコアV2',
        ],
    ],
];
