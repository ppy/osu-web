<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Вы должны войти для редактирования.',
            'system_generated' => 'Системное сообщение не может быть отредактировано.',
            'wrong_user' => 'Вы должны быть автором данного поста для редактирования.',
        ],
    ],

    'events' => [
        'empty' => 'Ничего не произошло... пока что.',
    ],

    'index' => [
        'deleted_beatmap' => 'удалено',
        'none_found' => 'Не найдено обсуждений, совпадающих с данными критериями поиска.',
        'title' => 'Обсуждение карты',

        'form' => [
            '_' => 'Поиск',
            'deleted' => 'Включая удаленные обсуждения',
            'mode' => 'Режим игры',
            'only_unresolved' => 'Показать только нерешённые обсуждения',
            'show_review_embeds' => 'Показать посты рецензии',
            'types' => 'Виды отзывов',
            'username' => 'Никнейм',

            'beatmapset_status' => [
                '_' => 'Статус карты',
                'all' => 'Все',
                'disqualified' => 'Была дисквалифицирована',
                'never_qualified' => 'Никогда не квалифицировалась',
                'qualified' => 'Квалифицированная',
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
        'confirm' => 'Ни один из отзывов не связан с моим сообщением',
        'notice' => 'На близкий к указанному вами тайм-коду :timestamp — :existing_timestamps уже есть ответ. Прочитайте его, пожалуйста, чтобы не создавать дубликат.',
        'unsaved' => ':count в этом отзыве',
    ],

    'owner_editor' => [
        'button' => 'Владелец сложности',
        'reset_confirm' => 'Сбросить владельца для этой сложности?',
        'user' => 'Владелец',
        'version' => 'Сложность',
    ],

    'refresh' => [
        'checking' => 'Проверка...',
        'has_updates' => 'Появились новые ответы. Нажмите для обновления.',
        'no_updates' => 'Нет новых ответов.',
        'updating' => 'Обновление...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Войдите в аккаунт, чтобы ответить',
            'user' => 'Ответить',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блоков использовано',
        'go_to_parent' => 'Перейти к рецензии',
        'go_to_child' => 'Перейти к обсуждению',
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
            'true' => 'Помечено как решённое пользователем :user',
            'false' => 'Возобновлено пользователем :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'общее',
        'general_all' => 'общее (все)',
    ],

    'user_filter' => [
        'everyone' => 'Все',
        'label' => 'По пользователям',
    ],
];
