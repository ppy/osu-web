<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы должны войти для редактирования.',
            'system_generated' => 'Системное сообщение не может быть отредактировано.',
            'wrong_user' => 'Вы должны быть автором данной публикации для редактирования.',
        ],
    ],

    'events' => [
        'empty' => 'Ничего не происходит... пока что.',
    ],

    'index' => [
        'deleted_beatmap' => 'удалено',
        'none_found' => 'Не найдено обсуждений, совпадающих с данными критериями поиска.',
        'title' => 'Обсуждение карты',

        'form' => [
            '_' => 'Поиск',
            'deleted' => 'Включая удаленные обсуждения',
            'mode' => 'Режим карты',
            'only_unresolved' => 'Показать только нерешённые обсуждения',
            'types' => 'Типы сообщений',
            'username' => 'Имя пользователя',

            'beatmapset_status' => [
                '_' => 'Статус карты',
                'all' => 'Все',
                'disqualified' => 'Дисквалифицирована',
                'never_qualified' => 'Никогда не квалифицирована',
                'qualified' => 'Квалифицирована',
                'ranked' => 'Рейтинговая',
            ],

            'user' => [
                'label' => 'Пользователь',
                'overview' => 'Просмотр активности',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Дата создания',
        'deleted_at' => 'Дата удаления',
        'message_type' => 'Тип',
        'permalink' => 'Прямая ссылка',
    ],

    'nearby_posts' => [
        'confirm' => 'Ни один из постов не решает мою проблему',
        'notice' => 'Есть ответы между :timestamp (:existing_timestamps). Проверьте их перед тем как отвечать.',
        'unsaved' => ':count в этом отзыве',
    ],

    'owner_editor' => [
        'button' => 'Владелец сложности',
        'reset_confirm' => 'Сбросить владельца сложности?',
        'user' => 'Владелец',
        'version' => 'Сложность',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Войдите, чтобы ответить',
            'user' => 'Ответить',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блоков использовано',
        'go_to_parent' => 'Посмотреть отзыв',
        'go_to_child' => 'Посмотреть обсуждение',
        'validation' => [
            'block_too_large' => 'каждый блок может содержать до :limit символов',
            'external_references' => 'отзыв содержит ссылки на проблемы, не отноcящиеся к этому отзыву',
            'invalid_block_type' => 'недопустимый тип блока',
            'invalid_document' => 'недопустимый отзыв',
            'invalid_discussion_type' => 'неверный тип обсуждения',
            'minimum_issues' => 'отзыв должен содержать как минимум :count проблему|отзыв должен содержать как минимум :count проблемы|отзыв должен содержать как минимум :count проблем',
            'missing_text' => 'в блоке отсутствует текст',
            'too_many_blocks' => 'отзывы могут содержать только :count параграф/проблему|отзывы могут содержать только до :count параграфов/проблем',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Помечено решённым пользователем :user',
            'false' => 'Открыто заново пользователем :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'общее',
        'general_all' => 'общее (все)',
    ],

    'user_filter' => [
        'everyone' => 'Все',
        'label' => 'Сортировать по пользователям',
    ],
];
