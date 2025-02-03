<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Ви повинні увійти для редагування.',
            'system_generated' => 'Пост згенерований системою не можна редагувати.',
            'wrong_user' => 'Ви повинні бути автором поста, щоб відредагувати його.',
        ],
    ],

    'events' => [
        'empty' => 'Нічого не відбулось... поки що.',
    ],

    'index' => [
        'deleted_beatmap' => 'видалено',
        'none_found' => 'Не знайдено жодної дискусії, що відповідає критеріям пошуку.',
        'title' => 'Обговорення Мапи',

        'form' => [
            '_' => 'Пошук',
            'deleted' => 'Включаючи видалені обговорення',
            'mode' => 'Режим гри',
            'only_unresolved' => 'Показувати лише невирішені обговорення',
            'show_review_embeds' => 'Показати відгукові пости',
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
        'confirm' => 'Жоден з постів не стосується моєї проблеми',
        'notice' => 'Вже є пости біля :timestamp (:existing_timestamps). Перевірте їх перед публікацією.',
        'unsaved' => ':count в цьому відгуку',
    ],

    'owner_editor' => [
        'button' => 'Власник Складності',
        'reset_confirm' => 'Скинути власника для цієї складності?',
        'user' => 'Власник',
        'version' => 'Складність',
    ],

    'refresh' => [
        'checking' => 'Перевіряємо, чи є нові дописи...',
        'has_updates' => 'Нові дописи в обговоренні, натисніть для оновлення.',
        'no_updates' => 'Немає нових дописів.',
        'updating' => 'Оновлення...',
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
        'go_to_child' => 'Переглянути Обговорення',
        'validation' => [
            'block_too_large' => 'кожен блок може містити лише :limit символів',
            'external_references' => 'відгук містить посилання на проблеми, що не належать цьому відгуку',
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
            'false' => 'Відкрито повторно користувачем :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'загальні',
        'general_all' => 'загальні (всі)',
    ],

    'user_filter' => [
        'everyone' => 'Всі',
        'label' => 'Фільтрувати по користувачах',
    ],
];
