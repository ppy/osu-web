<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Влезте в профила си, за да редактирате.',
            'system_generated' => 'Системно-генерираният пост не може да бъде редактиран.',
            'wrong_user' => 'Трябва да сте собственик на тази публикация да редактирате.',
        ],
    ],

    'events' => [
        'empty' => 'Нищо не се е случило... още.',
    ],

    'index' => [
        'deleted_beatmap' => 'изтрито',
        'none_found' => 'Няма открити дискусии, които отговарят на критерия за търсене.',
        'title' => 'Бийтмап Дискусии',

        'form' => [
            '_' => 'Търсене',
            'deleted' => 'Включете изтрити дискусии',
            'mode' => ' Бийтмап вид',
            'only_unresolved' => 'Покажи само нерешените дискусии',
            'types' => 'Тип съобщения',
            'username' => 'Потребителско име',

            'beatmapset_status' => [
                '_' => 'Бийтмап статус',
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
        'permalink' => 'Постоянен линк',
    ],

    'nearby_posts' => [
        'confirm' => 'Нито един от постовете ме интересуват',
        'notice' => 'Има постове около :timestamp (:existing_timestamps). Моля проверете ги преди да публикувате.',
        'unsaved' => ':count в това ревю',
    ],

    'owner_editor' => [
        'button' => 'Собственик на трудността',
        'reset_confirm' => 'Занули собственика на тази трудност?',
        'user' => 'Собственик',
        'version' => 'Трудност',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Влезте в профила си за да Отговорите',
            'user' => 'Отговори',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блокирания',
        'go_to_parent' => 'Виж ревюто',
        'go_to_child' => 'Виж дискусията',
        'validation' => [
            'block_too_large' => 'всеки блок може да има до :limit знака',
            'external_references' => 'ревюто съдържа препратки до проблеми, които не принадлежат на това ревю',
            'invalid_block_type' => 'невалиден тип блок',
            'invalid_document' => 'невалидно ревю',
            'invalid_discussion_type' => 'невалиден вид дискусия',
            'minimum_issues' => 'ревюто трябва да съдържа минимум :count проблем|ревюто трябва да съдържа минимум :count проблема',
            'missing_text' => 'липсва текст в блока',
            'too_many_blocks' => 'ревютата може да съдържат само :count параграфа/проблема|ревютата може да съдържат до :count параграфа/проблема ',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Маркирано като разрешено от :user',
            'false' => 'Подновено от :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'общо',
        'general_all' => 'общо (всички)',
    ],

    'user_filter' => [
        'everyone' => 'Всички',
        'label' => 'Филтрирано от потребителя',
    ],
];
