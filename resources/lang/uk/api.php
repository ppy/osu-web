<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Неможливо надіслати пусте повідомлення.',
            'limit_exceeded' => 'Ви надсилаєте повідомлення надто швидко, будь ласка, трішки зачекайте та спробуйте ще раз.',
            'too_long' => 'Повідомлення яке ви намагаєтеся надіслати занадто довге.',
        ],
    ],

    'scopes' => [
        'bot' => 'Виступати в ролі чатового бота.',
        'identify' => 'Ідентифікувати вас і читати загальнодоступні дані.',

        'chat' => [
            'write' => 'Надсилати повідомлення від вашого імені.',
        ],

        'forum' => [
            'write' => 'Створювати та редагувати теми та дописи на форумі від вашого імені.',
        ],

        'friends' => [
            'read' => 'Подивіться, на кого ви підписані.',
        ],

        'public' => 'Читати публічні дані від вашого імені.',
    ],
];
