<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'З метою безпеки, ми відправили на вашу пошту :mail лист з кодом підтвердження. Введіть отриманий код.',
        'title' => 'Підтвердження акаунта',
        'verifying' => 'Перевірка...',
        'issuing' => 'Відправка іншого листа...',

        'info' => [
            'check_spam' => "Перевірте папку спам, якщо ви не можете знайти лист.",
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
        'reissued' => 'Відправлено лист з іншим кодом.',
        'unknown' => 'Невідома помилка, відправлено новий лист.',
    ],
];
