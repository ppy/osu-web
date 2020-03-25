<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы мусіце ўвайсці для рэдагавання.',
            'system_generated' => 'Сістэмныя допісы немагчыма адрэдагаваць.',
            'wrong_user' => 'Вы павінны быць уладальнікам допісу для рэдагавання.',
        ],
    ],

    'events' => [
        'empty' => 'Нічога не адбылося... яшчэ.',
    ],

    'index' => [
        'deleted_beatmap' => 'выдалена',
        'none_found' => '',
        'title' => 'Абмеркаванне бітмап',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Уключаючы выдаленыя абмеркаванні',
            'only_unresolved' => '',
            'types' => 'Тыпы памедамленняў',
            'username' => 'Імя карыстальніка',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Карыстальнік',
                'overview' => 'Агляд актыўнасці',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата размяшчэння',
        'deleted_at' => 'Дата выдалення',
        'message_type' => 'Тып',
        'permalink' => 'Пастаянная спасылка',
    ],

    'nearby_posts' => [
        'confirm' => 'Ні адзін з допісаў не вырашае маю праблему',
        'notice' => 'Існуюць допісы між :timestamp (:existing_timestamps). Праверце іх перш, чым размяшчаць.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Каб адказаць, увайдзіце',
            'user' => 'Адправіць',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Пазначана як рашэнне карыстальнікам :user',
            'false' => 'Адкрыта нанова карыстальнікам :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Усе',
        'label' => 'Фільтр па карыстальнікам',
    ],
];
