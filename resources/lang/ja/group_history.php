<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'グループの履歴が見つかりませんでした！',
    'view' => 'グループの履歴を表示',

    'event' => [
        'actor' => '',

        'message' => [
            'group_add' => ':group を作成しました。',
            'group_remove' => ':group を削除しました。',
            'group_rename' => ':previous_group を :group に名前変更しました。',
            'user_add' => ':user が :group に追加されました。',
            'user_add_with_playmodes' => ':user が :group の :rulesets に追加されました。',
            'user_add_playmodes' => ':user の :rulesets が :group メンバーシップに追加されました。',
            'user_remove' => ':user が :group から削除されました。',
            'user_remove_playmodes' => ':user の :rulesets が :group メンバーシップから削除されました。',
            'user_set_default' => ':user のデフォルトグループを :group に設定しました。',
        ],
    ],

    'form' => [
        'group' => 'グループ
',
        'group_all' => 'すべてのグループ',
        'max_date' => 'まで',
        'min_date' => 'から',
        'user' => 'ユーザー',
        'user_prompt' => 'ユーザー名 又は ID',
    ],

    'staff_log' => [
        '_' => '過去のグループの履歴については :wiki_articles を参照してください。',
        'wiki_articles' => 'スタッフによるWikiの記事の更新ログ',
    ],
];
