<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Нельзя отправить пустое сообщение.',
            'limit_exceeded' => 'Вы отправляете сообщения слишком быстро, пожалуйста, подождите немного перед повторной попыткой.',
            'too_long' => 'Сообщение, которое вы пытаетесь отправить, слишком длинное.',
        ],
    ],

    'scopes' => [
        'bot' => 'Действовать как чат бот.',
        'identify' => 'Идентифицировать вас и читать общедоступные данные.',

        'chat' => [
            'write' => 'Отправить сообщения от Вашего имени.',
        ],

        'forum' => [
            'write' => 'Создавайте и редактируйте темы и посты на форуме от своего имени.',
        ],

        'friends' => [
            'read' => 'Видеть список ваших друзей.',
        ],

        'public' => 'Читать публичные данные от вашего имени.',
    ],
];
