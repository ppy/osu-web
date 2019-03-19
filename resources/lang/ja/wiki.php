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
    'show' => [
        'fallback_translation' => '要求されたページはまだ選択された言語（:language）に翻訳されていません。英語版を表示します。',
        'languages' => '言語',
        'missing' => '要求されたページ”:keyword”は見つかりませんでした。',
        'missing_title' => 'Not Found',
        'missing_translation' => '要求されたページはまだ現在選択している言語には翻訳されていません。',
        'search' => '既存のページで:linkを検索する',
        'toc' => '目次',

        'edit' => [
            'link' => 'GitHubで表示する',
            'refresh' => '更新する',
        ],

        'translation' => [
            'legal' => 'この翻訳は一時的に提供されています。:defaultはこの文章の原文です。',
            'outdated' => 'このページには古い翻訳情報が含まれています。最新情報を確認するには:defaultを参照してください。（可能であれば翻訳にご協力ください）',

            'default' => '英語版',
        ],
    ],
];
