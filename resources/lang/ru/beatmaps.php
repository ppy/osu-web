<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'message_placeholder' => 'Нажмите сюда для публикации',
        'message_type_select' => 'Выбрать тип комментария',
        'reply_placeholder' => 'Введи тут ответ',
        'require-login' => 'Войди для публикации или ответа',
        'resolved' => 'Решено',
        'restore' => 'восстановить',
        'title' => 'Обсуждения',

        'collapse' => [
            'all-collapse' => 'Скрыть всё',
            'all-expand' => 'Показать всё',
        ],

        'empty' => [
            'empty' => 'Нет обсуждения!',
            'hidden' => 'Ни одно обсуждение не соответствует выбранному фильтру.',
        ],

        'message_hint' => [
            'in_general' => 'Этот пост пойдет в общее обсуждение. Чтобы изменить эту карту, начни своё сообщение с отметкой времени (к примеру 00:12:345).',
            'in_timeline' => 'Для изменения нескольких временных отметок, опубликуй несколько отметок (одна публикация на отметку).',
        ],

        'message_type' => [
            'praise' => 'Хвала',
            'problem' => 'Проблема',
            'suggestion' => 'Запрос',
        ],

        'mode' => [
            'general' => 'Главная',
            'general_all' => 'Главная (все сложности)',
            'timeline' => 'График',
        ],

        'new' => [
            'timestamp' => 'Временная отметка',
            'timestamp_missing' => 'нажмите ctrl-c в режиме редактирования для получения временной отметки и добавь его!',
            'title' => 'Новое обсуждение',
        ],

        'show' => [
            'title' => ':title сделанный :mapper',
        ],

        'stats' => [
            'deleted' => 'Удалено',
            'mine' => 'Мои', // TODO: wut
            'pending' => 'Ожидающий',
            'praises' => 'Похвалы',
            'resolved' => 'Решено',
        ],
    ],

    'nominations' => [
        'disqualification_prompt' => 'Причина для дисквалификации?',
        'disqualified_at' => 'дисквалифицирован :time_ago (:reason).',
        'disqualified_no_reason' => 'причина не указана',
        'disqualify' => 'Дисквалифицировать',
        'incorrect_state' => 'Не удалось выполнить данную задачу, пробовал перезагрузить страницу?',
        'nominate' => 'Номинировать',
        'nominate_confirm' => 'Номинировать эту карту?',
        'qualified' => 'Если больше не будет выявлено каких-либо проблем, карта получит рейтинговый статус примерно в :date.',
        'qualified_soon' => 'Если больше не будет выявлено каких-либо проблем, карта получит рейтинговый статус очень скоро.',
        'required_text' => 'Номинации: :current/:required',
        'title' => 'Статус номинации',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'начинай вводить ключевые слова ...',
            'options' => 'Больше настроек поиска',
            'not-found' => 'нет результатов',
            'not-found-quote' => '... увы, ничего не найдено.',
            'filters' => [
                'mode' => 'Режим игры',
                'status' => 'Статус',
                'genre' => 'Жанр',
                'language' => 'Язык',
                'extra' => 'Дополнительно',
                'rank' => 'Рейтинг',
            ],
        ],
        'mode' => 'Режим игры',
        'status' => 'Статус одобрения',
        'mapped-by' => 'автор :mapper',
        'source' => 'от :source',
        'load-more' => 'Загрузить ещё...',
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
        'loved' => 'Любимые',
        'faves' => 'Избранные',
        'pending' => 'Ожидающие',
        'graveyard' => 'Заброшенные', // TODO: найти перевод лучше
        'my-maps' => 'Мои карты',
    ],
    'genre' => [
        'any' => 'Все',
        'unspecified' => 'Неопределенные',
        'video-game' => 'Видео игры',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Другой',
        'novelty' => 'Новый',
        'hip-hop' => 'Хип-хоп',
        'electronic' => 'Электроника', // TODO: найти перевод лучше
    ],
    'mods' => [ // Кажется, что перевод не нужен
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'No mods',
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
    'extra' => [
        'video' => 'Есть видео',
        'storyboard' => 'Есть сторибоард',
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
