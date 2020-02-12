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
    'limitation_notice' => 'ПРИМІТКА: Ваше повідомлення зможуть прочитати тільки в <a href=":lazer_link">osu!lazer</a>, або через цю систему ОП на сайті.<br/>Якщо ви не впевнені, відправте повідомлення через <a href=":oldpm_link">стару систему на форумі</a>.',
    'talking_in' => 'чат в :channel',
    'talking_with' => 'чат з :name',
    'title_compact' => 'чат',

    'cannot_send' => [
        'channel' => 'Ви не можете написати в даний момент. Це може бути обумовлено однією з наступних причин:',
        'user' => 'Ви не можете написати в даний момент. Це може бути обумовлено однією з наступних причин:',
        'reasons' => [
            'blocked' => 'Ви заблоковані співрозмовником',
            'channel_moderated' => 'Цей канал модерується',
            'friends_only' => 'Цей користувач приймає повідомлення тільки від друзів',
            'restricted' => 'Наразі ви обмежені',
            'target_restricted' => 'Одержувач наразі обмежений',
        ],
    ],
    'input' => [
        'disabled' => 'неможливо надіслати повідомлення...',
        'placeholder' => 'введіть текст повідомлення...',
        'send' => 'Відправити',
    ],
    'no-conversations' => [
        'howto' => "Почніть розмову з картки або сторінки користувача.",
        'lazer' => 'Загальні канали до яких ви приєдналися через <a href=":link">osu!lazer</a> також видно тут.',
        'pm_limitations' => 'Ваше повідомлення зможуть прочитати тільки в <a href=":link">osu!lazer</a>, або через цю систему ОП на сайті.',
        'title' => 'немає розмов',
    ],
];
