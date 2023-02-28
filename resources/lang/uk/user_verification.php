<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'На вашу пошту, був відправлений :mail з кодом підтвердження, в цілях безпеки. Введіть код.',
        'title' => 'Підтвердження облікового запису',
        'verifying' => 'Перевіряємо...',
        'issuing' => 'Відправляння нового коду...',

        'info' => [
            'check_spam' => "Перевірте розділ \"спам\", якщо ви не можете знайти лист.",
            'recover' => "Якщо ви втратили доступ до своєї пошти або забули її, пройдіть :link.",
            'recover_link' => 'процес відновлення електронної пошти тут',
            'reissue' => 'Також, ви можете :reissue_link або :logout_link.',
            'reissue_link' => 'запросити інший код',
            'logout_link' => 'вийти',
        ],
    ],

    'errors' => [
        'expired' => 'Даний код застарів, відправлено новий лист.',
        'incorrect_key' => 'Невірний код.',
        'retries_exceeded' => 'Невірний код підтвердження. Ви вичерпали кількість спроб, відправлено новий лист.',
        'reissued' => 'Лист з кодом підтвердження відправлено повторно.',
        'unknown' => 'Сталась невідома помилка, новий лист з кодом відправлено.',
    ],
];
