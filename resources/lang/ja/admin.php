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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => '生成',
            'regenerating' => '生成中・・・',
            'remove' => '削除',
            'removing' => '削除中・・・',
            'title' => 'ビートマップセットカバー',
        ],
        'show' => [
            'covers' => '譜面のカバーを管理する',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => '適用',
                'activate_confirm' => 'modding v2をこの譜面に適用しますか？',
                'active' => '適用済',
                'inactive' => '未適用',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => '削除',

                'forum-name' => 'フォーラム #:id: :name',

                'no-cover' => 'カバー無し',

                'submit' => [
                    'save' => '保存',
                    'update' => '更新',
                ],

                'title' => 'フォーラムカバーのリスト',

                'type-title' => [
                    'default-topic' => '規定のトピックカバー',
                    'main' => 'フォーラムカバー',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'ログビューワー',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'ビートマップセット',
                'forum' => 'フォーラム',
                'general' => '全般',
                'store' => 'ストア',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => '注文の一覧',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'このユーザーは現在制限中です。',
            'message' => '（アドミンのみにこれが見えます）',
        ],
    ],

];
