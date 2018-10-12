<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'discussion-posts' => [
        'store' => [
            'error' => 'Не удалось сохранить публикацию',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Не удалось обновить ответ',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'разрешить кудосу',
        'delete' => 'удалить',
        'deleted' => 'Удалено :editor в :delete_time',
        'deny_kudosu' => 'запретить кудосу',
        'edit' => 'изменить',
        'edited' => 'Последний раз изменён :editor в :update_time',
        'kudosu_denied' => 'Отказано в получении кудосу.',
        'message_placeholder_deleted_beatmap' => 'Эта сложность была удалена и отзываться о ней нельзя.',
        'message_type_select' => 'Выбрать тип комментария',
        'reply_notice' => 'Нажмите Enter для ответа.',
        'reply_placeholder' => 'Введите тут ответ',
        'require-login' => 'Войди для публикации или ответа',
        'resolved' => 'Решено',
        'restore' => 'восстановить',
        'title' => 'Отзывы',

        'collapse' => [
            'all-collapse' => 'Скрыть всё',
            'all-expand' => 'Показать всё',
        ],

        'empty' => [
            'empty' => 'Нет отзывов!',
            'hidden' => 'Ни один отзыв не соответствует указанному фильтру.',
        ],

        'message_hint' => [
            'in_general' => 'Этот пост пойдет в общую ветку отзывов. Чтобы изменить эту карту, начните своё сообщение с временной отметкой (к примеру 00:12:345).',
            'in_timeline' => 'Для изменения нескольких отметок, опубликуйте несколько отметок (одна публикация на отметку).',
        ],

        'message_placeholder' => [
            'general' => 'Введите здесь, чтобы запостить в Общий (:version)',
            'generalAll' => 'Введите здесь, чтобы запостить в Общий (Все сложности)',
            'timeline' => 'Введите здесь, чтобы запостить в временную шкалу (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалифицировать',
            'hype' => 'Хайпануть!',
            'mapper_note' => 'Заметка',
            'nomination_reset' => 'Сбросить номинацию',
            'praise' => 'Хвала',
            'problem' => 'Проблема',
            'suggestion' => 'Запрос',
        ],

        'mode' => [
            'events' => 'История',
            'general' => 'Общее :scope',
            'timeline' => 'График',
            'scopes' => [
                'general' => 'эта сложность',
                'generalAll' => 'все сложности',
            ],
        ],

        'new' => [
            'timestamp' => 'Временная отметка',
            'timestamp_missing' => 'нажмите ctrl-c в редакторе чтобы скопировать временную отметку!',
            'title' => 'Новый отзыв',
        ],

        'show' => [
            'title' => ':title сделанный :mapper',
        ],

        'sort' => [
            '_' => 'Отсортировано по:',
            'created_at' => 'дате создания',
            'timeline' => 'графику',
            'updated_at' => 'дате обновления',
        ],

        'stats' => [
            'deleted' => 'Удалено',
            'mapper_notes' => 'Заметки',
            'mine' => 'Мои',
            'pending' => 'Ожидающий',
            'praises' => 'Похвалы',
            'resolved' => 'Решено',
            'total' => 'Все',
        ],

        'status-messages' => [
            'approved' => 'Эта карта была одобрена :date!',
            'graveyard' => "Эта карта не обновлялась с :date и похоже, что автор её забросил...",
            'loved' => 'Эта карта была признана "любимой" :date!',
            'ranked' => 'Эта карта была ранкнута :date!',
            'wip' => 'Заметьте: Эта карта была помечена создателем как незавершённая.',
        ],

    ],

    'hype' => [
        'button' => 'Хайпануть карту!',
        'button_done' => 'Уже хайпанута!',
        'confirm' => "Вы уверены? Это действие отберёт один из :n хайпов и не может быть отменено.",
        'explanation' => 'Это сделает карту доступной для номинирования!',
        'explanation_guest' => 'Войдите в аккаунт, чтобы сделать карту доступной для номинирования!',
        'new_time' => "Вы получите другой хайп :new_time.",
        'remaining' => 'У вас осталось :remaining хайпа.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Прогресс хайпа',
        'title' => 'Хайпаните',
    ],

    'feedback' => [
        'button' => 'Оставить отзыв',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Причина для дисквалификации?',
        'disqualified_at' => 'дисквалифицирован :time_ago (:reason).',
        'disqualified_no_reason' => 'причина не указана',
        'disqualify' => 'Дисквалифицировать',
        'incorrect_state' => 'Не удалось выполнить данную задачу, попробуйте перезагрузить страницу.',
        'love' => 'Любимое',
        'love_confirm' => 'Отметить карту как любимую?',
        'nominate' => 'Номинировать',
        'nominate_confirm' => 'Номинировать эту карту?',
        'nominated_by' => 'номинирована :users',
        'qualified' => 'Если больше нет проблем, то карта получит ранкнутый статус примерно :date.',
        'qualified_soon' => 'Если больше нет проблем, то карта получит ранкнутый статус очень скоро.',
        'required_text' => 'Номинации: :current/:required',
        'reset_message_deleted' => 'удалено',
        'title' => 'Статус номинации',
        'unresolved_issues' => 'Вы должны решить все проблемы.',

        'reset_at' => [
            'nomination_reset' => ':user сбросил прогресс номинаций :time_ago из-за новой проблемы :discussion (:message).',
            'disqualify' => ':user дисквалифицировал :time_ago из-за новой проблемы :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Вы уверены? Сообщение о новой проблеме сбросит статус номинации.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'начните вводить ключевые слова ...',
            'login_required' => 'Войдите, чтобы искать.',
            'options' => 'Больше настроек поиска',
            'supporter_filter' => 'Фильтрация по :filters требует наличия активной подписки osu!supporter',
            'not-found' => 'нет результатов',
            'not-found-quote' => '... увы, ничего не найдено.',
            'filters' => [
                'general' => 'Общее',
                'mode' => 'Режим игры',
                'status' => 'Категории',
                'genre' => 'Жанр',
                'language' => 'Язык',
                'extra' => 'Дополнительно',
                'rank' => 'Рейтинг',
                'played' => 'Сыграно',
            ],
            'sorting' => [
                'title' => 'название',
                'artist' => 'исполнитель',
                'difficulty' => 'сложность',
                'updated' => 'обновлено',
                'ranked' => 'рейтинговые',
                'rating' => 'рейтинг',
                'plays' => 'количество игр',
                'relevance' => 'релевантность',
                'nominations' => 'номинации',
            ],
            'supporter_filter_quote' => [
                '_' => 'Фильтрация по :filters требует :link',
                'link_text' => 'тэг osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'рекомендуемая сложность',
        'converts' => 'показывать конвертированные карты',
    ],
    'mode' => [
        'any' => 'Все',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Все',
        'ranked-approved' => 'Рейтинговые и одобренные',
        'approved' => 'Одобренные',
        'qualified' => 'Квалифицированные',
        'loved' => 'Любимые',
        'faves' => 'Избранные',
        'pending' => 'Ожидающие и в процессе разработки',
        'graveyard' => 'Заброшенные',
        'my-maps' => 'Мои карты',
    ],
    'genre' => [
        'any' => 'Все',
        'unspecified' => 'Не определён',
        'video-game' => 'Видео игры',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Другой',
        'novelty' => 'Новый',
        'hip-hop' => 'Хип-хоп',
        'electronic' => 'Электроника',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
    ],
    'language' => [
        'any' => 'Все',
        'english' => 'Английский',
        'chinese' => 'Китайский',
        'french' => 'Французский',
        'german' => 'Немецкий',
        'italian' => 'Итальянский',
        'japanese' => 'Японский',
        'korean' => 'Корейский',
        'spanish' => 'Испанский',
        'swedish' => 'Швецкий',
        'instrumental' => 'Инструментальный',
        'other' => 'Другой',
    ],
    'played' => [
        'any' => 'Все',
        'played' => 'Сыграно',
        'unplayed' => 'Не сыграно',
    ],
    'extra' => [
        'video' => 'Есть видео',
        'storyboard' => 'Есть сториборд',
    ],
    'rank' => [
        'any' => 'Все',
        'XH' => 'Серебряный SS',
        'X' => 'SS',
        'SH' => 'Серебряный S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
