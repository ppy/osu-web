<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'limitation_notice' => 'ВНИМАНИЕ: Ваше сообщение смогут прочитать только в <a href=":lazer_link">osu!lazer</a>, или через эту систему ЛС на сайте.<br/>Если вы неуверены, отправьте сообщение через <a href=":oldpm_link">старую систему на форуме</a>.',
    'talking_in' => 'чат в :channel',
    'talking_with' => 'чат с :name',
    'title_compact' => 'сообщения',
    'title' => 'Сообщения',
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
