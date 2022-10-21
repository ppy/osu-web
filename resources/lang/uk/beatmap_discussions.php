<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Ви повинні ввійти для редагування.',
            'system_generated' => 'Системне повідомлення не може бути змінено.',
            'wrong_user' => 'Ви повинні бути автором даної публікації для редагування.',
        ],
    ],

    'events' => [
        'empty' => 'Нічого не відбулось... поки що.',
    ],

    'index' => [
        'deleted_beatmap' => 'видалено',
        'none_found' => 'Не знайдено жодної дискусії, що відповідає критеріям пошуку.',
        'title' => 'Обговорення мапи',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Включаючи видалені обговорення',
            'mode' => 'Режим мапи',
            'only_unresolved' => 'Показувати тільки невирішені дискусії',
            'types' => 'Типи повідомлень',
            'username' => 'Ім\'я користувача',

            'beatmapset_status' => [
                '_' => 'Статус мапи',
                'all' => 'Всі',
                'disqualified' => 'Дискваліфікований',
                'never_qualified' => 'Жодного разу не кваліфікований',
                'qualified' => 'Кваліфікований',
                'ranked' => 'Рейтинговий',
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
        'confirm' => 'Жоден з постів не розв\'язує мою проблему',
        'notice' => 'Вже є дискусії біля :timestamp (:existing_timestamps). Перевірте їх перед публікацією.',
        'unsaved' => ':count в цьому відгуку',
    ],

    'owner_editor' => [
        'button' => 'Власник складності',
        'reset_confirm' => 'Скинути власника для цієї складності?',
        'user' => 'Власник',
        'version' => 'Складність',
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
            'external_references' => 'відгук містить посилання на проблеми, що не відносяться до цього відгуку',
            'invalid_block_type' => 'недопустимий тип блоку',
            'invalid_document' => 'недопустимий відгук',
            'invalid_discussion_type' => 'неприпустимий тип дискусії ',
            'minimum_issues' => 'відгук повинен містити принаймні :count проблему | відгук повинен містити принаймні :count проблеми | відгук повинен містити принаймні :count проблем
',
            'missing_text' => 'в блоці відсутній текст',
            'too_many_blocks' => 'відгуки можуть містити лише :count параграф/проблему|відгуки можуть містити лише :count параграфи/проблеми|відгуки можуть містити лише :count параграфів/проблем',
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
        'general_all' => 'загальні (всі)',
    ],

    'user_filter' => [
        'everyone' => 'Всі',
        'label' => 'Сортувати по користувачах',
    ],
];
