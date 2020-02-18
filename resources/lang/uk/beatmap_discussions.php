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
    'authorizations' => [
        'update' => [
            'null_user' => 'Ви повинні увійти для редагування.',
            'system_generated' => 'Системне повідомлення не може бути змінено.',
            'wrong_user' => 'Ви повинні бути автором даної публікації для редагування.',
        ],
    ],

    'events' => [
        'empty' => 'Нічого не відбувається... поки що.',
    ],

    'index' => [
        'deleted_beatmap' => 'видалено',
        'title' => 'Обговорення карти',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Включаючи видалені обговорення',
            'only_unresolved' => 'Показувати тільки невирішені обговорення',
            'types' => 'Типи повідомлень',
            'username' => 'Ім\'я користувача',

            'beatmapset_status' => [
                '_' => 'Статус карти',
                'all' => 'Усі',
                'disqualified' => 'Дискваліфікований',
                'never_qualified' => 'Жодного разу не кваліфікований',
                'qualified' => 'Кваліфікований',
                'ranked' => 'Ранкнутий',
            ],

            'user' => [
                'label' => 'Користувач',
                'overview' => 'Перегляд активності',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата публікації',
        'deleted_at' => 'Дата видалення',
        'message_type' => 'Тип',
        'permalink' => 'Постійне посилання',
    ],

    'nearby_posts' => [
        'confirm' => 'Жоден з постів не вирішує про мою проблему',
        'notice' => 'Є повідомлення між :timestamp (:existing_timestamps). Перевірте їх перед публікацією.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Увійдіть, щоб відповісти',
            'user' => 'Відповісти',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Побачити відгук',
        'go_to_child' => 'Побачити обговорення',
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
            'true' => 'Позначено вирішеним користувачем :user',
            'false' => 'Повторно відкрито користувачем :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'загальні',
        'general_all' => 'загальні (усі)',
    ],

    'user_filter' => [
        'everyone' => 'Усі',
        'label' => 'Сортувати по користувачах',
    ],
];
