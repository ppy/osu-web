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
        'identify' => 'Идентифицировать вас и читать общедоступные данные.',

        'friends' => [
            'read' => 'Посмотрите, на кого вы подписаны.',
        ],

        'public' => 'Читайте публиные данные от своего имени.',
    ],
];
