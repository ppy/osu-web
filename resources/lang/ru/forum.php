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

    'covers' => [
        'create' => [
            '_' => 'Установить обложку',
            'button' => 'Загрузить изображение',
            'info' => 'Размер изображения должно быть :dimensions. Для загрузки Вы также можете бросить изображение сюда.',
        ],

        'destroy' => [
            '_' => 'Удалить обложку',
            'confirm' => 'Вы уверены что хотите удалить обложку?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Новый ответ в теме ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Нет тем!',
        ],
    ],

    'pinned_topics' => 'Закреплённые Посты',
    'post' => [
        'confirm_destroy' => 'Удалить данную тему?',
        'confirm_restore' => 'Восстановить данную тему?',
        'edited' => 'Последний раз отредактировал :user в :when, всего изменено :count раз.',
        'posted_at' => 'опубликовано в :when',
        'actions' => [
            'destroy' => 'Удалить пост',
            'restore' => 'Восстановить пост',
            'edit' => 'Редактировать пост',
        ],
    ],
    'search' => [
        'go_to_post' => 'Перейти к посту',
        'post_number_input' => 'введите номер поста',
        'total_posts' => 'в сумме :posts_count постов',
    ],
    'subforums' => 'Подфорумы',
    'title' => 'osu!сообщество'
];
