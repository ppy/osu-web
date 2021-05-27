<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Не знайдено жодної дискусії, що відповідають критеріям пошуку.',
        'title' => 'Обговорення карти',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Включаючи видалені обговорення',
            'mode' => 'Режим карт',
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
        'unsaved' => ':count в цьому відгуку',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Увійдіть, щоб відповісти',
            'user' => 'Відповісти',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блоків використано',
        'go_to_parent' => 'Побачити відгук',
        'go_to_child' => 'Побачити обговорення',
        'validation' => [
            'block_too_large' => 'кожен блок може містити лише :limit символів',
            'external_references' => 'відгук містить посилання на проблеми, не отсоящіеся до цього відкликанню',
            'invalid_block_type' => 'недопустимий тип блоку',
            'invalid_document' => 'недопустимий відгук',
            'minimum_issues' => 'відгук повинен містити як мінімум :count проблему | відгук повинен містити як мінімум :count проблеми | відгук повинен містити як мінімум :count проблем
',
            'missing_text' => 'в блоці відсутній текст',
            'too_many_blocks' => 'відгуки можуть містити лише :count параграф/проблему|відгуки можуть містити лише до :count параграфів/проблем',
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
