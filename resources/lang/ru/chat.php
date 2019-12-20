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
    'limitation_notice' => 'ВНИМАНИЕ: Ваше сообщение смогут прочитать только в <a href=":lazer_link">osu!lazer</a>, или через эту систему ЛС на сайте.<br/>Если вы неуверены, отправьте сообщение через <a href=":oldpm_link">старую систему на форуме</a>.',
    'talking_in' => 'чат в :channel',
    'talking_with' => 'чат с :name',
    'title_compact' => 'сообщения',

    'cannot_send' => [
        'channel' => 'Вы не можете написать в данный момент. Это может быть обусловлено одной из следующих причин:',
        'user' => 'Вы не можете написать в данный момент. Это может быть обусловлено одной из следующих причин:',
        'reasons' => [
            'blocked' => 'Вы в чёрном списке собеседника',
            'channel_moderated' => 'Этот канал модерируется',
            'friends_only' => 'Получатель принимает сообщения только от друзей',
            'restricted' => 'У вас рестриктед',
            'target_restricted' => 'У получателя рестриктед',
        ],
    ],
    'input' => [
        'disabled' => 'нельзя отправить сообщение...',
        'placeholder' => 'введите сообщения...',
        'send' => 'Отправить',
    ],
    'no-conversations' => [
        'howto' => "Начните разговор из карточки или страницы пользователя.",
        'lazer' => 'Общие каналы к которым вы присоединились через <a href=":link">osu!lazer</a> также видны здесь.',
        'pm_limitations' => 'Ваше сообщение смогут прочитать только в <a href=":link">osu!lazer</a>, или через эту систему ЛС на сайте.',
        'title' => 'диалоги пусты...',
    ],
];
