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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Восстановить',
            'regenerating' => 'Восстановление...',
            'remove' => 'Удалить',
            'removing' => 'Удаление...',
            'title' => 'Обложки наборов карт',
        ],
        'show' => [
            'covers' => 'Управление обложками набора карт',
            'discussion' => [
                '_' => 'Моддинг v2',
                'activate' => 'включить',
                'activate_confirm' => 'включить моддинг v2 для этой карты?',
                'active' => 'включить',
                'inactive' => 'выключить',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Удалить',

                'forum-name' => 'Форум #:id: :name',

                'no-cover' => 'Нет обложки',

                'submit' => [
                    'save' => 'Сохранить',
                    'update' => 'Обновить',
                ],

                'title' => 'Список форумов',

                'type-title' => [
                    'default-topic' => 'Стандартная обложка темы',
                    'main' => 'Обложка форума',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Просмотр логов',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'Наборы карт',
                'forum' => 'Форум',
                'general' => 'Главная',
                'store' => 'Магазин',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Список заказов',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'В данный момент пользователь ограничен.',
            'message' => '(это могут видеть только админы)',
        ],
    ],

];
