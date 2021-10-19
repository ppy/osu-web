<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Влез в профила си, за редактиране.',
            'system_generated' => 'Системно-генериран пост не може да бъде редактиран.',
            'wrong_user' => 'Трябва да сте собственик на публикацията, за да редактирате.',
        ],
    ],

    'events' => [
        'empty' => 'Нищо не се е случило... още.',
    ],

    'index' => [
        'deleted_beatmap' => 'изтрито',
        'none_found' => 'Няма намерена дискусия, която отговаря на критерия за търсене.',
        'title' => 'Бийтмап Дискусии',

        'form' => [
            '_' => 'Търсене',
            'deleted' => 'Включи изтрити дискусии',
            'mode' => ' Вид на Бийтмап',
            'only_unresolved' => 'Покажи само нерешени дискусии',
            'types' => 'Тип съобщения',
            'username' => 'Потребителско име',

            'beatmapset_status' => [
                '_' => 'Статус на Бийтмап',
                'all' => 'Всички',
                'disqualified' => 'Дисквалифициран',
                'never_qualified' => 'Никога квалифициран',
                'qualified' => 'Квалифициран',
                'ranked' => 'Класиран',
            ],

            'user' => [
                'label' => 'Потребител',
                'overview' => 'Преглед на активността',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата на публикуване',
        'deleted_at' => 'Дата на изтриване',
        'message_type' => 'Вид',
        'permalink' => 'Връзка',
    ],

    'nearby_posts' => [
        'confirm' => 'Нито един от постовете ме интересуват',
        'notice' => 'Съществуват публикации за :timestamp (:existing_timestamps). Моля, проверете ги преди да публикувате.',
        'unsaved' => ':count в това ревю',
    ],

    'owner_editor' => [
        'button' => 'Собственик на трудност',
        'reset_confirm' => 'Занули собственика на тази трудност?',
        'user' => 'Собственик',
        'version' => 'Трудност',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Влез в профила си, за Отговор',
            'user' => 'Отговори',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блокирания',
        'go_to_parent' => 'Виж ревю',
        'go_to_child' => 'Виж дискусия',
        'validation' => [
            'block_too_large' => 'всеки блок може да има до :limit знака',
            'external_references' => 'ревюто съдържа препратки до проблеми, които не принадлежат на това ревю',
            'invalid_block_type' => 'невалиден тип блок',
            'invalid_document' => 'невалидно ревю',
            'invalid_discussion_type' => 'невалиден вид дискусия',
            'minimum_issues' => 'ревюто трябва да съдържа минимум :count проблем|ревюто трябва да съдържа минимум :count проблема',
            'missing_text' => 'липсва текст в блока',
            'too_many_blocks' => 'ревютата може да съдържат само :count параграф/проблем|ревютата може да съдържат само :count параграфа/проблема ',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Отбелязан като решен от :user',
            'false' => 'Отново отворен от :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'общо',
        'general_all' => 'общо (всички)',
    ],

    'user_filter' => [
        'everyone' => 'Всеки',
        'label' => 'Подреди по потребител',
    ],
];
